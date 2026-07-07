<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property['title'] ?? 'Property Details' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .font-serif { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="text-gray-900 antialiased py-10 px-4 sm:px-6 lg:px-8">

    <div class="max-w-6xl mx-auto">
        
        <div class="mb-6">
            <h1 class="text-3xl font-serif font-bold text-gray-900">
                {{ $property['title'] ?? 'Untitled Property' }} 
                <span class="text-gray-400 font-normal px-2">|</span>
                {{ $property['tags'][0] ?? $property['propertyType'] ?? 'Vacation Rental' }}
            </h1>
            
            <div class="flex items-center mt-2 text-sm text-gray-700 font-medium">
                <svg class="w-4 h-4 mr-1.5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                </svg>
                {{ $property['address']['full'] ?? 'Address not available' }}
            </div>
        </div>

        @php
            $images = $property['pictures'] ?? [];
            $mainImage = $images[0]['original'] ?? 'https://via.placeholder.com/800x600';
            $sideImages = array_slice($images, 1, 4);
            $totalImages = count($images);
        @endphp

        <div class="flex flex-col md:flex-row gap-2 h-[400px] md:h-[500px] rounded-xl overflow-hidden mt-6 relative">
            
            <div class="w-full md:w-1/2 h-1/2 md:h-full cursor-pointer overflow-hidden" onclick="openLightbox(0)">
                <img src="{{ $mainImage }}" alt="Main Property View" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
            </div>

            <div class="w-full md:w-1/2 h-1/2 md:h-full grid grid-cols-2 gap-2">
                @foreach($sideImages as $index => $image)
                    <div class="relative w-full h-full cursor-pointer overflow-hidden">
                        <img src="{{ $image['original'] }}" alt="Property View {{ $index + 2 }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300" onclick="openLightbox({{ $index + 1 }})">
                        
                        @if($loop->last && $totalImages > 5)
                            <button onclick="openLightbox(0)" class="absolute bottom-4 right-4 bg-gray-900/70 hover:bg-gray-900/90 text-white text-sm font-semibold px-4 py-2 rounded-lg border border-white/20 backdrop-blur-sm transition-colors z-10">
                                Show All Photos
                            </button>
                        @endif
                    </div>
                @endforeach
                
                @for($i = count($sideImages); $i < 4; $i++)
                    <div class="bg-gray-200 w-full h-full"></div>
                @endfor
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 mt-12 items-start">
            
            <div class="lg:col-span-2 space-y-12">
                <div class="pb-8 border-b border-gray-200">
                    <h2 class="text-2xl font-serif font-bold mb-3 text-gray-900">
                        {{ $property['roomType'] ?? 'Entire property' }} 
                        @if(isset($property['propertyType']))
                            ({{ $property['propertyType'] }})
                        @endif
                    </h2>
                    
                    <div class="flex flex-wrap items-center gap-2 sm:gap-3 text-gray-600 text-sm sm:text-base">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            <span>{{ $property['accommodates'] ?? 0 }} guests</span>
                        </div>
                        <span class="text-gray-300 text-xs">•</span>
                        
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            <span>{{ $property['bedrooms'] ?? 0 }} bedrooms</span>
                        </div>
                        <span class="text-gray-300 text-xs">•</span>
                        
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            <span>{{ $property['beds'] ?? 0 }} beds</span>
                        </div>
                        <span class="text-gray-300 text-xs">•</span>
                        
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                            <span>{{ $property['bathrooms'] ?? 0 }} baths</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
                    <h3 class="text-xl font-serif font-bold mb-4">About the space</h3>
                    <div class="prose prose-sm max-w-none text-gray-600 space-y-2 whitespace-pre-line">
                        {{ $property['publicDescription']['summary'] ?? '' }}
                    </div>
                </div>

                <!-- Amenities Section -->
                @php
                    $allAmenities = $property['amenities'] ?? [];
                    $topAmenities = array_slice($allAmenities, 0, 9);
                    $totalAmenities = count($allAmenities);
                @endphp
                
                <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
                    <h3 class="text-xl font-serif font-bold mb-6">What this place offers</h3>
                    
                    @if(!empty($allAmenities))
                        <!-- Preview Grid (Top 9 Amenities) -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-y-4 gap-x-6">
                            @foreach($topAmenities as $amenity)
                                <div class="flex items-center text-gray-700 text-sm">
                                    <svg class="w-5 h-5 mr-3 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    <span class="truncate" title="{{ $amenity }}">{{ $amenity }}</span>
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- Show All Button -->
                        @if($totalAmenities > 9)
                            <button onclick="openAmenitiesModal()" class="mt-8 px-6 py-2.5 bg-white border border-gray-900 text-gray-900 rounded-lg hover:bg-gray-50 transition-colors font-semibold text-sm w-full sm:w-auto">
                                Show all {{ $totalAmenities }} amenities
                            </button>
                        @endif
                    @else
                        <p class="text-gray-500 text-sm">No amenities listed for this property.</p>
                    @endif
                </div>

                <!-- Availability Section -->
                <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
                    <h2 class="text-2xl font-serif font-bold mb-2">Availability</h2>
                    <p class="text-gray-500 text-sm mb-6">View operating cycles and blackout thresholds below.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @foreach($monthsToRender as $month)
                            <div>
                                <h3 class="text-sm font-semibold text-gray-700 mb-3 text-center">
                                    {{ $month->format('F Y') }}
                                </h3>

                                <div class="grid grid-cols-7 text-center text-xs font-medium text-gray-400 mb-2 border-b pb-1">
                                    <div>Su</div><div>Mo</div><div>Tu</div><div>We</div><div>Th</div><div>Fr</div><div>Sa</div>
                                </div>

                                <div class="grid grid-cols-7 text-center text-xs gap-y-1">
                                    @for($i = 0; $i < $month->dayOfWeek; $i++)
                                        <div class="py-2"></div>
                                    @endfor

                                    @for($day = 1; $day <= $month->daysInMonth; $day++)
                                        @php
                                            $currentLoopDate = $month->copy()->day($day);
                                            $dateStr = $currentLoopDate->format('Y-m-d');
                                            $isPast = $currentLoopDate->isBefore(\Carbon\Carbon::today());
                                            $status = (!$isPast && isset($calendarData[$dateStr])) ? $calendarData[$dateStr] : 'unavailable';
                                            $isAvailable = ($status === 'available');
                                        @endphp

                                        <div class="py-2 flex items-center justify-center">
                                            @if($isPast)
                                                <span class="text-gray-200 line-through cursor-not-allowed">{{ $day }}</span>
                                            @elseif($isAvailable)
                                                <span class="w-7 h-7 flex items-center justify-center font-medium text-gray-800 rounded-full bg-emerald-50/40 text-emerald-700 border border-emerald-100/40">
                                                    {{ $day }}
                                                </span>
                                            @else
                                                <span class="relative w-7 h-7 flex items-center justify-center text-gray-300 select-none bg-gray-50 rounded-full">
                                                    {{ $day }}
                                                    <span class="absolute text-gray-200 font-light text-sm">/</span>
                                                </span>
                                            @endif
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1 lg:sticky lg:top-6">
                <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-xl space-y-6 relative">
                    <div>
                        <span class="text-2xl font-extrabold tracking-tight">${{ $property['prices']['basePrice'] ?? 0 }}</span>
                        <span class="text-gray-500 text-sm">/ night</span>
                    </div>

                    <div class="relative">
                        <div id="pickerTrigger" class="border border-gray-300 rounded-xl grid grid-cols-2 divide-x divide-gray-300 overflow-hidden cursor-pointer hover:border-gray-400 focus-within:ring-2 focus-within:ring-gray-900 transition-all">
                            <div class="p-3.5 select-none">
                                <label class="block text-[10px] font-bold uppercase tracking-wider text-gray-400">Check-In</label>
                                <div id="checkInDisplay" class="text-sm font-medium text-gray-400 mt-0.5">Add date</div>
                            </div>
                            <div class="p-3.5 select-none">
                                <label class="block text-[10px] font-bold uppercase tracking-wider text-gray-400">Check-Out</label>
                                <div id="checkOutDisplay" class="text-sm font-medium text-gray-400 mt-0.5">Add date</div>
                            </div>
                        </div>

                        <input type="hidden" id="checkInDate" name="check_in_date">
                        <input type="hidden" id="checkOutDate" name="check_out_date">

                        <div id="calendarDropdown" class="hidden absolute right-0 lg:-right-4 mt-2 w-[320px] sm:w-[600px] bg-white border border-gray-100 rounded-2xl shadow-2xl p-4 sm:p-6 z-40 space-y-6 animate-in fade-in slide-in-from-top-2 duration-200">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                                @foreach($monthsToRender as $monthIndex => $month)
                                    <div>
                                        <h4 class="text-sm font-bold text-gray-800 mb-4 text-center select-none">
                                            {{ $month->format('F Y') }}
                                        </h4>
                                        <div class="grid grid-cols-7 text-center text-[11px] font-bold text-gray-400 mb-2 pb-1 border-b border-gray-50 uppercase tracking-wider">
                                            <div>Su</div><div>Mo</div><div>Tu</div><div>We</div><div>Th</div><div>Fr</div><div>Sa</div>
                                        </div>
                                        <div class="grid grid-cols-7 text-center text-xs gap-y-1">
                                            @for($i = 0; $i < $month->dayOfWeek; $i++)
                                                <div class="py-1.5"></div>
                                            @endfor

                                            @for($day = 1; $day <= $month->daysInMonth; $day++)
                                                @php
                                                    $currentLoopDate = $month->copy()->day($day);
                                                    $dateStr = $currentLoopDate->format('Y-m-d');
                                                    $isPast = $currentLoopDate->isBefore(\Carbon\Carbon::today());
                                                    $status = (!$isPast && isset($calendarData[$dateStr])) ? $calendarData[$dateStr] : 'unavailable';
                                                    $isAvailable = ($status === 'available');
                                                @endphp

                                                <div class="py-0.5 relative group">
                                                    @if($isPast || !$isAvailable)
                                                        <button type="button" disabled class="w-full aspect-square flex items-center justify-center font-medium text-gray-300 line-through bg-gray-50/50 rounded-full cursor-not-allowed select-none text-[11px]">
                                                            {{ $day }}
                                                        </button>
                                                    @else
                                                        <button type="button" 
                                                                data-date="{{ $dateStr }}"
                                                                class="picker-day-btn w-full aspect-square flex items-center justify-center font-semibold text-gray-700 rounded-full hover:bg-gray-900 hover:text-white transition-all text-[11px] relative z-10">
                                                            {{ $day }}
                                                        </button>
                                                    @endif
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            <div class="flex justify-between items-center pt-4 border-t border-gray-100 text-xs text-gray-400 select-none">
                                <div>Select check-in date first</div>
                                <button type="button" id="clearDatesBtn" class="text-gray-600 font-semibold underline hover:text-gray-900 transition-colors">Clear dates</button>
                            </div>
                        </div>
                    </div>

                    <div class="border border-gray-300 rounded-xl p-3.5 focus-within:ring-2 focus-within:ring-gray-900 transition-all">
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-gray-400">Guests</label>
                        <select id="guestsCount" class="w-full text-sm font-semibold focus:outline-none mt-1 text-gray-800 bg-transparent cursor-pointer">
                            @for($g = 1; $g <= ($property['accommodates'] ?? 4); $g++)
                                <option value="{{ $g }}">{{ $g }} {{ $g === 1 ? 'Guest' : 'Guests' }}</option>
                            @endfor
                        </select>
                    </div>

                    <div id="validationAlert" class="hidden text-xs font-semibold p-3.5 bg-rose-50 text-rose-600 rounded-xl border border-rose-100 animate-pulse"></div>

                    <div id="invoiceBreakdown" class="hidden space-y-4 pt-2 border-t border-gray-100">
                        <h4 class="text-xs font-bold uppercase tracking-widest text-gray-400">Price Breakdown</h4>
                        <div id="breakdownLines" class="space-y-2.5 text-sm font-medium text-gray-600"></div>
                        <div class="border-t border-gray-100 pt-4 flex justify-between font-bold text-gray-900 text-base">
                            <span>Total</span>
                            <span id="calculatedTotal">$0.00</span>
                        </div>
                    </div>

                    <button id="submitBookingBtn" disabled class="w-full py-3.5 px-4 bg-gray-900 hover:bg-gray-800 disabled:bg-gray-100 disabled:text-gray-400 disabled:cursor-not-allowed text-white font-semibold rounded-xl transition-all text-center text-sm shadow-md">
                        Check Availability
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="lightboxModal" class="hidden fixed inset-0 bg-gray-950/95 z-50 flex items-center justify-center select-none backdrop-blur-sm">
        <button onclick="closeLightbox()" class="absolute top-6 right-6 text-white hover:text-gray-300 p-2 z-50 focus:outline-none">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>

        <button onclick="navigateLightbox(-1)" class="absolute left-4 md:left-8 text-white hover:text-gray-300 p-2 z-50 focus:outline-none bg-gray-900/40 rounded-full border border-white/10">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        </button>

        <div class="max-w-5xl max-h-[80vh] px-4 flex flex-col items-center">
            <img id="lightboxImage" src="" alt="Property Visual View" class="max-w-full max-h-[75vh] object-contain rounded shadow-2xl">
            <p id="lightboxCounter" class="text-xs text-gray-400 mt-4 tracking-wider font-medium"></p>
        </div>

        <button onclick="navigateLightbox(1)" class="absolute right-4 md:right-8 text-white hover:text-gray-300 p-2 z-50 focus:outline-none bg-gray-900/40 rounded-full border border-white/10">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </button>
    </div>

    <!-- Amenities Modal -->
    <div id="amenitiesModal" class="hidden fixed inset-0 bg-gray-950/50 z-50 flex items-center justify-center backdrop-blur-sm p-4 sm:p-6 transition-opacity">
        <!-- Modal Container -->
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[85vh] flex flex-col overflow-hidden relative animate-in fade-in zoom-in-95 duration-200">
            
            <!-- Sticky Header -->
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-white z-10">
                <h3 class="text-xl font-serif font-bold text-gray-900">What this place offers</h3>
                <button onclick="closeAmenitiesModal()" class="text-gray-500 hover:text-gray-900 p-2 -mr-2 rounded-full hover:bg-gray-100 transition-colors focus:outline-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <!-- Scrollable List -->
            <div class="p-6 overflow-y-auto overscroll-contain">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-8">
                    @foreach($allAmenities as $amenity)
                        <div class="flex items-start text-gray-700 text-sm pb-4 border-b border-gray-50 last:border-0 sm:border-0">
                            <svg class="w-5 h-5 mr-3 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span class="leading-relaxed">{{ $amenity }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        const calendarMap = @json($calendarData);
        const propertyId = "{{ $property['_id'] }}";
        const quoteUrl = "{{ route('properties.quote', $property['_id']) }}";
        const galleryImages = @json(array_map(fn($img) => $img['original'], $images));
        let activeImageIndex = 0;

        // Custom Date Range State Variables
        let selectedCheckIn = null;
        let selectedCheckOut = null;

        // UI Element Selectors
        const pickerTrigger = document.getElementById('pickerTrigger');
        const calendarDropdown = document.getElementById('calendarDropdown');
        const checkInDisplay = document.getElementById('checkInDisplay');
        const checkOutDisplay = document.getElementById('checkOutDisplay');
        const hiddenCheckIn = document.getElementById('checkInDate');
        const hiddenCheckOut = document.getElementById('checkOutDate');
        const clearDatesBtn = document.getElementById('clearDatesBtn');
        const dayButtons = document.querySelectorAll('.picker-day-btn');

        const guestsInput = document.getElementById('guestsCount');
        const validationAlert = document.getElementById('validationAlert');
        const invoiceBreakdown = document.getElementById('invoiceBreakdown');
        const breakdownLines = document.getElementById('breakdownLines');
        const calculatedTotal = document.getElementById('calculatedTotal');
        const submitBtn = document.getElementById('submitBookingBtn');

        /* --- Lightbox Event Methods --- */
        function openLightbox(index) {
            if (!galleryImages || galleryImages.length === 0) return;
            activeImageIndex = index;
            updateLightboxContent();
            document.getElementById('lightboxModal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }
        function closeLightbox() {
            document.getElementById('lightboxModal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
        function navigateLightbox(direction) {
            activeImageIndex += direction;
            if (activeImageIndex >= galleryImages.length) activeImageIndex = 0;
            if (activeImageIndex < 0) activeImageIndex = galleryImages.length - 1;
            updateLightboxContent();
        }
        function updateLightboxContent() {
            document.getElementById('lightboxImage').src = galleryImages[activeImageIndex];
            document.getElementById('lightboxCounter').textContent = `${activeImageIndex + 1} / ${galleryImages.length}`;
        }

        /* --- Custom Range Picker Logic Engine --- */
        
        // Toggle calendar view
        pickerTrigger.addEventListener('click', (e) => {
            calendarDropdown.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!pickerTrigger.contains(e.target) && !calendarDropdown.contains(e.target)) {
                calendarDropdown.classList.add('hidden');
            }
        });

        // Loop over each selectable visual calendar cell
        dayButtons.forEach(button => {
            button.addEventListener('click', () => {
                const clickedDateStr = button.getAttribute('data-date');

                if (!selectedCheckIn || (selectedCheckIn && selectedCheckOut)) {
                    // Step A: Set or Reset initial check-in point
                    selectedCheckIn = clickedDateStr;
                    selectedCheckOut = null;
                } else if (selectedCheckIn && !selectedCheckOut) {
                    // Step B: Set check-out point
                    if (new Date(clickedDateStr) <= new Date(selectedCheckIn)) {
                        // Flip values if selection falls chronologically backwards
                        selectedCheckIn = clickedDateStr;
                    } else {
                        selectedCheckOut = clickedDateStr;
                        calendarDropdown.classList.add('hidden'); // Auto-close on complete selection
                    }
                }

                updateCalendarUIState();
                evaluateRangeData();
            });
        });

        function updateCalendarUIState() {
            dayButtons.forEach(btn => {
                const dateStr = btn.getAttribute('data-date');
                const btnDate = new Date(dateStr);
                
                // Clear any leftover inline visual configurations
                btn.className = "picker-day-btn w-full aspect-square flex items-center justify-center font-semibold text-gray-700 rounded-full hover:bg-gray-900 hover:text-white transition-all text-[11px] relative z-10";
                btn.parentElement.className = "py-0.5 relative group";

                if (selectedCheckIn && dateStr === selectedCheckIn) {
                    // Style check-in day
                    btn.className += " bg-gray-900 text-white rounded-full";
                } else if (selectedCheckOut && dateStr === selectedCheckOut) {
                    // Style check-out day
                    btn.className += " bg-gray-900 text-white rounded-full";
                } else if (selectedCheckIn && selectedCheckOut && btnDate > new Date(selectedCheckIn) && btnDate < new Date(selectedCheckOut)) {
                    // Style structural gap rows spanning mid-range dates elegantly
                    btn.className += " bg-gray-100 text-gray-900 rounded-none hover:bg-gray-200";
                    btn.parentElement.className += " bg-gray-100";
                }
            });

            // Sync visual string placeholders
            if (selectedCheckIn) {
                checkInDisplay.textContent = formatDateLabel(selectedCheckIn);
                checkInDisplay.classList.remove('text-gray-400');
                checkInDisplay.classList.add('text-gray-800');
                hiddenCheckIn.value = selectedCheckIn;
            } else {
                checkInDisplay.textContent = "Add date";
                checkInDisplay.classList.replace('text-gray-800', 'text-gray-400');
                hiddenCheckIn.value = "";
            }

            if (selectedCheckOut) {
                checkOutDisplay.textContent = formatDateLabel(selectedCheckOut);
                checkOutDisplay.classList.remove('text-gray-400');
                checkOutDisplay.classList.add('text-gray-800');
                hiddenCheckOut.value = selectedCheckOut;
            } else {
                checkOutDisplay.textContent = "Add date";
                checkOutDisplay.classList.replace('text-gray-800', 'text-gray-400');
                hiddenCheckOut.value = "";
            }
        }

        function formatDateLabel(dateString) {
            const parts = dateString.split('-');
            const d = new Date(parts[0], parts[1] - 1, parts[2]);
            return d.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
        }

        clearDatesBtn.addEventListener('click', () => {
            selectedCheckIn = null;
            selectedCheckOut = null;
            updateCalendarUIState();
            evaluateRangeData();
        });

        /* --- Quote Validation Engine --- */
        function evaluateRangeData() {
            validationAlert.classList.add('hidden');
            submitBtn.disabled = true;

            if (!selectedCheckIn || !selectedCheckOut) {
                invoiceBreakdown.classList.add('hidden');
                return;
            }

            // Loop checking through user selections locally to make sure it doesn't overlap bookings
            let parserDate = new Date(selectedCheckIn);
            const endDate = new Date(selectedCheckOut);
            
            while (parserDate < endDate) {
                const stepStr = parserDate.toISOString().split('T')[0];
                if (calendarMap[stepStr] === 'unavailable') {
                    showError("The selected range overlaps with existing bookings.");
                    invoiceBreakdown.classList.add('hidden');
                    return;
                }
                parserDate.setDate(parserDate.getDate() + 1);
            }

            fetchQuoteBreakdown(selectedCheckIn, selectedCheckOut, guestsInput.value);
        }

        function fetchQuoteBreakdown(checkIn, checkOut, guests) {
            fetch(quoteUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    checkInDate: checkIn,
                    checkOutDate: checkOut,
                    guestsCount: guests
                })
            })
            .then(async res => {
                const data = await res.json();
                if (!res.ok) throw new Error(data.error || 'Pricing configuration mismatch.');
                return data;
            })
            .then(data => {
                renderInvoice(data);
            })
            .catch(err => {
                showError(err.message);
                invoiceBreakdown.classList.add('hidden');
            });
        }

        function renderInvoice(payload) {
            const ratePlanNode = payload.rates?.ratePlans?.[0]?.ratePlan?.money;
            if (!ratePlanNode || !ratePlanNode.invoiceItems) {
                showError("Could not retrieve clean line item quote structures.");
                return;
            }

            breakdownLines.innerHTML = '';
            
            ratePlanNode.invoiceItems.forEach(item => {
                const row = document.createElement('div');
                row.className = 'flex justify-between items-center text-gray-600 font-medium';
                row.innerHTML = `
                    <span class="capitalize text-gray-500">${item.title.toLowerCase().replace(/_/g, ' ')}</span>
                    <span class="text-gray-900">$${parseFloat(item.amount).toFixed(2)}</span>
                `;
                breakdownLines.appendChild(row);
            });

            const finalCalculatedSum = ratePlanNode.subTotalPrice + (ratePlanNode.totalTaxes || 0);
            calculatedTotal.textContent = `$${finalCalculatedSum.toFixed(2)}`;
            
            invoiceBreakdown.classList.remove('hidden');
            submitBtn.textContent = 'Reserve Space';
            submitBtn.disabled = false;
        }

        function showError(msg) {
            validationAlert.textContent = msg;
            validationAlert.classList.remove('hidden');
        }

        guestsInput.addEventListener('change', evaluateRangeData);

        /* --- Amenities Modal Logic --- */
        const amenitiesModal = document.getElementById('amenitiesModal');

        function openAmenitiesModal() {
            amenitiesModal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden'); // Prevent background scrolling
        }

        function closeAmenitiesModal() {
            amenitiesModal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // Close modal if user clicks the backdrop area outside the modal card
        amenitiesModal.addEventListener('click', function(e) {
            if (e.target === amenitiesModal) {
                closeAmenitiesModal();
            }
        });
        
        // Ensure Escape key also closes the amenities modal (add this to your existing keydown listener)
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                if (!amenitiesModal.classList.contains('hidden')) closeAmenitiesModal();
                if (!document.getElementById('lightboxModal').classList.contains('hidden')) closeLightbox();
            }
        });
    </script>
</body>
</html>