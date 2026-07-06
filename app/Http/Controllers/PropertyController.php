<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PropertyController extends Controller
{
    public function index()
    {
        // Fetch data from the Guesty API with a limit of 50
        $response = Http::withToken(env('GUESTY_API_TOKEN'))
            ->acceptJson()
            ->get('https://booking.guesty.com/api/listings?limit=50'); 

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
}