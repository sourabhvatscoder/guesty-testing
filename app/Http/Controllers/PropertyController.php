<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PropertyController extends Controller
{
    public function home()
    {
        // Fetch data from the Guesty API with a limit of 3
        $response = Http::withToken(env('GUESTY_API_TOKEN'))
            ->acceptJson()
            ->get('https://booking.guesty.com/api/listings?limit=3'); 

        // Extract the data array (fallback to empty array if it fails)
        $properties = $response->json('results') ?? []; 

        return view('home', compact('properties'));
    }

    public function index(Request $request)
    {
        // Start building query parameters for Guesty API
        $queryParams = ['limit' => 50];

        if ($request->filled('city')) {
            $queryParams['city'] = $request->city;
        }
        if ($request->filled('country')) {
            $queryParams['country'] = $request->country;
        }
        if ($request->filled('minOccupancy')) {
            $queryParams['minOccupancy'] = $request->minOccupancy;
        }
        if ($request->filled('checkIn')) {
            $queryParams['checkIn'] = $request->checkIn;
        }
        if ($request->filled('checkOut')) {
            $queryParams['checkOut'] = $request->checkOut;
        }

        // Fetch data from the Guesty API with filters
        $response = Http::withToken(env('GUESTY_API_TOKEN'))
            ->acceptJson()
            ->get('https://booking.guesty.com/api/listings', $queryParams); 

        // Extract the data array (fallback to empty array if it fails)
        $properties = $response->json('results') ?? []; 

        return view('properties', compact('properties'));
    }

    public function show($id)
    {
        // Hit the public single listing API
        $response = Http::withToken(env('GUESTY_API_TOKEN'))
            ->acceptJson()
            ->get("https://booking.guesty.com/api/listings/{$id}");
        // Handle 404 if the property doesn't exist
        if ($response->failed()) {
            abort(404, 'Property not found.');
        }

        $property = $response->json();

        // Compute dynamic Date bounds (Today through End of Next Month)
        $today = Carbon::today();
        $endOfNextMonth = Carbon::today()->addMonth()->endOfMonth();

        $fromStr = $today->format('Y-m-d');
        $toStr = $endOfNextMonth->format('Y-m-d');

        // Fetch Availability Calendar
        $calendarResponse = Http::withToken(env('GUESTY_API_TOKEN'))
            ->acceptJson()
            ->get("https://booking.guesty.com/api/listings/{$id}/calendar", [
            'from' => $fromStr,
            'to' => $toStr
        ]);

        // Key the statuses by their date string 'YYYY-MM-DD' for rapid O(1) loop checks in Blade
        $calendarData = [];
        if ($calendarResponse->successful()) {
            foreach ($calendarResponse->json() as $dayData) {
                $calendarData[$dayData['date']] = $dayData['status'] ?? 'unavailable';
            }
        }

        // Generate Carbon instances representing the months we want to show
        $monthsToRender = [
            $today->copy()->startOfMonth(),               // Current Month
            $today->copy()->addMonth()->startOfMonth()    // Next Month
        ];

        return view('property-show', compact('property', 'calendarData', 'monthsToRender'));
    }

    public function getQuote(Request $request, $id)
    {
        $validated = $request->validate([
            'checkInDate'  => 'required|date_format:Y-m-d|after_or_equal:today',
            'checkOutDate' => 'required|date_format:Y-m-d|after:checkInDate',
            'guestsCount'  => 'required|integer|min:1',
        ]);

        $response = Http::withToken(env('GUESTY_API_TOKEN'))
            ->acceptJson()
            ->post('https://booking.guesty.com/api/reservations/quotes', [
                'listingId'            => $id,
                'checkInDateLocalized'  => $validated['checkInDate'],
                'checkOutDateLocalized' => $validated['checkOutDate'],
                'guestsCount'          => (int)$validated['guestsCount']
            ]);

        if ($response->failed()) {
            return response()->json(['error' => 'Selected dates conflict with existing bookings.'], 422);
        }

        return response()->json($response->json());
    }

    public function checkout(Request $request)
    {
        // Require the essential booking parameters from the URL
        $request->validate([
            'listing_id' => 'required|string',
            'check_in'   => 'required|date',
            'check_out'  => 'required|date|after:check_in',
            'guests'     => 'required|integer|min:1'
        ]);

        $id = $request->listing_id;

        $response = Http::withToken(env('GUESTY_API_TOKEN'))
            ->acceptJson()
            ->get("https://booking.guesty.com/api/listings/{$id}");
        if ($response->failed()) {
            abort(404, 'Property not found.');
        }

        $property = $response->json();

        $response = Http::withToken(env('GUESTY_API_TOKEN'))
            ->acceptJson()
            ->post('https://booking.guesty.com/api/reservations/quotes', [
                'listingId'            => $id,
                'checkInDateLocalized'  => $request->check_in,
                'checkOutDateLocalized' => $request->check_out,
                'guestsCount'          => (int)$request->guests
            ]);
        if ($response->failed()) {
            return redirect()->back()->with('error', 'Dates are no longer available.');
        }

        $quote = $response->json();
        $inquiryId = $quote['rates']['ratePlans'][0]['inquiryId'] ?? null;
        $upsells = [];
        if ($inquiryId) {
            $upsellResponse = Http::withToken(env('GUESTY_API_TOKEN'))
                ->acceptJson()
                ->get("https://booking.guesty.com/api/reservations/upsell/{$inquiryId}/{$id}/fee");
                
            if ($upsellResponse->successful()) {
                $upsells = $upsellResponse->json();
            }
        }

        return view('checkout', compact('property', 'quote', 'request', 'upsells'));
    }

        public function updateQuoteUpsells(Request $request, $quoteId)
    {
        $validated = $request->validate([
            'additionalFeeIds' => 'array',
            'additionalFeeIds.*' => 'string'
        ]);

        $upsellResponse = Http::withToken(env('GUESTY_API_TOKEN'))
            ->acceptJson()
            ->post("https://booking.guesty.com/api/reservations/upsell/{$quoteId}", [
                'additionalFeeIds' => $validated['additionalFeeIds'] ?? []
            ]);

        if ($upsellResponse->failed()) {
            return response()->json(['error' => 'Failed to update upsells.'], 422);
        }

        $quoteResponse = Http::withToken(env('GUESTY_API_TOKEN'))
            ->acceptJson()
            ->get("https://booking.guesty.com/api/reservations/quotes/{$quoteId}");

        if ($quoteResponse->failed()) {
            return response()->json(['error' => 'Failed to fetch updated quote.'], 422);
        }

        return response()->json($quoteResponse->json());
    }

    public function getActivities(Request $request)
    {
        return view('activities',);
    }

    public function getResortMap(Request $request)
    {
        return view('resort-map',);
    }
}