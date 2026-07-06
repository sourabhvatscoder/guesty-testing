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

                <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
                    <h3 class="text-xl font-serif font-bold mb-4">About the space</h3>
                    <div class="prose prose-sm max-w-none text-gray-600 space-y-2 whitespace-pre-line">
                        {{ $property['publicDescription']['summary'] ?? '' }}
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1 lg:sticky lg:top-6">
                <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm space-y-6">
                    <div>
                        <span class="text-2xl font-bold">${{ $property['prices']['basePrice'] ?? 0 }}</span>
                        <span class="text-gray-500 text-sm">/ night</span>
                    </div>

                    <div class="border border-gray-200 rounded-lg divide-y divide-gray-200 overflow-hidden">
                        <div class="grid grid-cols-2 divide-x divide-gray-200">
                            <div class="p-3">
                                <label class="block text-[10px] font-bold uppercase text-gray-500">Check-In</label>
                                <input type="date" id="checkInDate" min="{{ date('Y-m-d') }}" class="w-full text-sm font-medium focus:outline-none mt-0.5 text-gray-700 bg-transparent">
                            </div>
                            <div class="p-3">
                                <label class="block text-[10px] font-bold uppercase text-gray-500">Check-Out</label>
                                <input type="date" id="checkOutDate" min="{{ date('Y-m-d') }}" class="w-full text-sm font-medium focus:outline-none mt-0.5 text-gray-700 bg-transparent">
                            </div>
                        </div>
                        <div class="p-3">
                            <label class="block text-[10px] font-bold uppercase text-gray-500">Guests</label>
                            <select id="guestsCount" class="w-full text-sm font-medium focus:outline-none mt-0.5 text-gray-700 bg-transparent">
                                @for($g = 1; $g <= ($property['accommodates'] ?? 4); $g++)
                                    <option value="{{ $g }}">{{ $g }} {{ $g === 1 ? 'Guest' : 'Guests' }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div id="validationAlert" class="hidden text-xs font-medium p-3 bg-rose-50 text-rose-600 rounded-lg border border-rose-100"></div>

                    <div id="invoiceBreakdown" class="hidden space-y-3 pt-2">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-gray-400">Price Breakdown</h4>
                        <div id="breakdownLines" class="space-y-2 text-sm text-gray-600"></div>
                        <div class="border-t pt-3 flex justify-between font-semibold text-gray-900 text-base">
                            <span>Total</span>
                            <span id="calculatedTotal">$0.00</span>
                        </div>
                    </div>

                    <button id="submitBookingBtn" disabled class="w-full py-3 px-4 bg-gray-900 hover:bg-gray-800 disabled:bg-gray-200 disabled:text-gray-400 disabled:cursor-not-allowed text-white font-medium rounded-lg transition-colors text-center text-sm shadow-sm">
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

    <script>
        const calendarMap = @json($calendarData);
        const propertyId = "{{ $property['_id'] }}";
        const quoteUrl = "{{ route('properties.quote', $property['_id']) }}";
        
        // Pass complete property picture paths down to client array collections
        const galleryImages = @json(array_map(fn($img) => $img['original'], $images));
        let activeImageIndex = 0;

        const checkInInput = document.getElementById('checkInDate');
        const checkOutInput = document.getElementById('checkOutDate');
        const guestsInput = document.getElementById('guestsCount');
        const validationAlert = document.getElementById('validationAlert');
        const invoiceBreakdown = document.getElementById('invoiceBreakdown');
        const breakdownLines = document.getElementById('breakdownLines');
        const calculatedTotal = document.getElementById('calculatedTotal');
        const submitBtn = document.getElementById('submitBookingBtn');

        const lightboxModal = document.getElementById('lightboxModal');
        const lightboxImage = document.getElementById('lightboxImage');
        const lightboxCounter = document.getElementById('lightboxCounter');

        /* --- Lightbox Functionality --- */
        function openLightbox(index) {
            if (!galleryImages || galleryImages.length === 0) return;
            activeImageIndex = index;
            updateLightboxContent();
            lightboxModal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden'); // Prevent background scrolling
        }

        function closeLightbox() {
            lightboxModal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        function navigateLightbox(direction) {
            activeImageIndex += direction;
            if (activeImageIndex >= galleryImages.length) activeImageIndex = 0;
            if (activeImageIndex < 0) activeImageIndex = galleryImages.length - 1;
            updateLightboxContent();
        }

        function updateLightboxContent() {
            lightboxImage.src = galleryImages[activeImageIndex];
            lightboxCounter.textContent = `${activeImageIndex + 1} / ${galleryImages.length}`;
        }

        // Close lightbox if clicking outside the main image canvas area
        lightboxModal.addEventListener('click', function(e) {
            if (e.target === lightboxModal) {
                closeLightbox();
            }
        });

        // Add keyboard escape and arrow keys support
        document.addEventListener('keydown', function(e) {
            if (lightboxModal.classList.contains('hidden')) return;
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowRight') navigateLightbox(1);
            if (e.key === 'ArrowLeft') navigateLightbox(-1);
        });

        /* --- Quote Validation Engine --- */
        function evaluateInputs() {
            const checkIn = checkInInput.value;
            const checkOut = checkOutInput.value;
            
            validationAlert.classList.add('hidden');
            submitBtn.disabled = true;

            if (!checkIn || !checkOut) return;

            if (calendarMap[checkIn] === 'unavailable' || calendarMap[checkOut] === 'unavailable') {
                showError("The selected checkout range contains unavailable date windows.");
                invoiceBreakdown.classList.add('hidden');
                return;
            }

            if (new Date(checkIn) >= new Date(checkOut)) {
                showError("Check-out selection date must fall after the check-in timestamp.");
                invoiceBreakdown.classList.add('hidden');
                return;
            }

            fetchQuoteBreakdown(checkIn, checkOut, guestsInput.value);
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
                row.className = 'flex justify-between items-center text-gray-600';
                row.innerHTML = `
                    <span class="capitalize">${item.title.toLowerCase().replace(/_/g, ' ')}</span>
                    <span class="font-medium">$${parseFloat(item.amount).toFixed(2)}</span>
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

        [checkInInput, checkOutInput, guestsInput].forEach(el => {
            el.addEventListener('change', evaluateInputs);
        });
    </script>
</body>
</html>