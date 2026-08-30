<!-- Search Form Widget -->
<div class="mt-8 md:mt-12 w-full max-w-4xl mx-auto bg-white rounded-full p-2 md:p-3 flex flex-col md:flex-row items-center justify-between shadow-2xl relative text-left border border-gray-100" id="searchBar">
    
    <!-- Destination -->
    <div class="flex-1 w-full md:w-auto relative group px-6 py-2.5 md:py-3 hover:bg-gray-100 rounded-full cursor-pointer transition-colors" id="destToggle">
        <label class="block text-xs font-extrabold text-gray-800 tracking-wider uppercase mb-0.5">Where</label>
        <div class="text-gray-500 text-sm font-medium flex items-center gap-2">
            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            <span id="destDisplay" class="text-gray-400">Where to?</span>
        </div>
        
        <!-- Dest Dropdown -->
        <div id="destDropdown" class="hidden absolute top-full left-0 mt-4 w-full md:w-80 bg-white rounded-3xl shadow-[0_10px_40px_rgba(0,0,0,0.1)] border border-gray-100 p-4 z-50">
            <div class="space-y-1">
                <button type="button" class="w-full text-left p-3 hover:bg-gray-50 rounded-2xl transition flex items-center gap-4" onclick="selectDest('Clermont', 'Florida, United States')">
                    <div class="bg-gray-100 p-3 rounded-xl text-gray-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                    </div>
                    <div>
                        <div class="font-semibold text-gray-900 text-base">Clermont</div>
                        <div class="text-sm text-gray-500">Florida, United States</div>
                    </div>
                </button>
                <button type="button" class="w-full text-left p-3 hover:bg-gray-50 rounded-2xl transition flex items-center gap-4" onclick="selectDest('Mount Dora', 'Florida, United States')">
                    <div class="bg-gray-100 p-3 rounded-xl text-gray-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                    </div>
                    <div>
                        <div class="font-semibold text-gray-900 text-base">Mount Dora</div>
                        <div class="text-sm text-gray-500">Florida, United States</div>
                    </div>
                </button>
            </div>
        </div>
    </div>
    
    <div class="hidden md:block w-px h-10 bg-gray-200"></div>

    <!-- Dates -->
    <div class="flex-1 w-full md:w-auto relative group px-6 py-2.5 md:py-3 hover:bg-gray-100 rounded-full cursor-pointer transition-colors">
        <label class="block text-xs font-extrabold text-gray-800 tracking-wider uppercase mb-0.5">Dates</label>
        <div class="text-gray-500 text-sm font-medium flex items-center gap-2">
            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <span id="dateDisplay" class="text-gray-400">Add dates</span>
        </div>
        <input type="text" id="datePicker" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full" placeholder="Add dates">
    </div>

    <div class="hidden md:block w-px h-10 bg-gray-200"></div>

    <!-- Guests -->
    <div class="flex-1 w-full md:w-auto relative group px-6 py-2.5 md:py-3 hover:bg-gray-100 rounded-full cursor-pointer transition-colors" id="guestToggle">
        <label class="block text-xs font-extrabold text-gray-800 tracking-wider uppercase mb-0.5">Who</label>
        <div class="text-gray-500 text-sm font-medium flex items-center gap-2">
            <span id="guestDisplay" class="text-gray-400">Add guests</span>
        </div>
        
        <!-- Guest Dropdown -->
        <div id="guestDropdown" class="hidden absolute top-full right-0 md:right-32 mt-4 w-full md:w-80 bg-white rounded-3xl shadow-[0_10px_40px_rgba(0,0,0,0.1)] border border-gray-100 p-6 z-50">
            <div class="flex items-center justify-between">
                <div>
                    <div class="font-semibold text-gray-900 text-base">Guests</div>
                    <div class="text-sm text-gray-500">All ages</div>
                </div>
                <div class="flex items-center gap-4">
                    <button type="button" class="w-9 h-9 rounded-full border border-gray-300 flex items-center justify-center text-gray-500 hover:border-gray-800 hover:text-gray-800 transition disabled:opacity-50 disabled:cursor-not-allowed" onclick="updateGuest(-1)" id="guestMinusBtn" disabled>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                    </button>
                    <span id="guestCount" class="w-4 text-center font-medium text-gray-900 text-lg">0</span>
                    <button type="button" class="w-9 h-9 rounded-full border border-gray-300 flex items-center justify-center text-gray-500 hover:border-gray-800 hover:text-gray-800 transition" onclick="updateGuest(1)">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Button -->
    <div class="w-full md:w-auto px-2 mt-2 md:mt-0 pb-2 md:pb-0">
        <button type="button" class="w-full md:w-auto bg-gray-900 hover:bg-emerald-600 text-white p-3 md:px-8 md:py-4 rounded-full font-bold flex items-center justify-center gap-2 transition-all duration-300 shadow-md hover:shadow-lg" onclick="submitSearch()">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            <span class="md:hidden lg:inline">Search</span>
        </button>
    </div>
    
    <form id="searchForm" action="/properties" method="GET" class="hidden">
        <input type="hidden" name="city" id="searchCity" value="{{ request('city') }}">
        <input type="hidden" name="country" id="searchCountry" value="{{ request('country') }}">
        <input type="hidden" name="checkIn" id="searchCheckIn" value="{{ request('checkIn') }}">
        <input type="hidden" name="checkOut" id="searchCheckOut" value="{{ request('checkOut') }}">
        <input type="hidden" name="minOccupancy" id="searchGuests" value="{{ request('minOccupancy') }}">
    </form>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let guestCount = parseInt('{{ request("minOccupancy", 0) }}', 10);
        if (isNaN(guestCount)) guestCount = 0;
        const destToggle = document.getElementById('destToggle');
        const destDropdown = document.getElementById('destDropdown');
        const guestToggle = document.getElementById('guestToggle');
        const guestDropdown = document.getElementById('guestDropdown');
        const destDisplay = document.getElementById('destDisplay');
        const searchCity = document.getElementById('searchCity');
        const searchCountry = document.getElementById('searchCountry');
        
        // Initialize from URL params if present
        if ('{{ request("city") }}') {
            destDisplay.textContent = '{{ request("city") }}';
            destDisplay.classList.remove('text-gray-400');
            destDisplay.classList.add('text-gray-900');
        }
        
        if (guestCount > 0) {
            document.getElementById('guestCount').textContent = guestCount;
            const display = document.getElementById('guestDisplay');
            display.textContent = guestCount + (guestCount === 1 ? ' Guest' : ' Guests');
            display.classList.remove('text-gray-400');
            display.classList.add('text-gray-900');
            document.getElementById('guestMinusBtn').disabled = false;
        }

        // Dest dropdown toggle
        destToggle.addEventListener('click', function(e) {
            if (e.target.closest('#destDropdown')) return;
            destDropdown.classList.toggle('hidden');
            guestDropdown.classList.add('hidden');
        });

        // Guest dropdown toggle
        guestToggle.addEventListener('click', function(e) {
            if (e.target.closest('#guestDropdown')) return;
            guestDropdown.classList.toggle('hidden');
            destDropdown.classList.add('hidden');
        });

        // Click outside to close dropdowns
        document.addEventListener('click', function(e) {
            if (!e.target.closest('#destToggle')) destDropdown.classList.add('hidden');
            if (!e.target.closest('#guestToggle')) guestDropdown.classList.add('hidden');
        });

        // Dest select
        window.selectDest = function(city, state) {
            destDisplay.textContent = city;
            destDisplay.classList.remove('text-gray-400');
            destDisplay.classList.add('text-gray-900');
            searchCity.value = city;
            const country = state.split(',')[1]?.trim() || 'United States';
            searchCountry.value = country;
            destDropdown.classList.add('hidden');
        };

        // Guests
        window.updateGuest = function(change) {
            guestCount += change;
            if (guestCount < 0) guestCount = 0;
            
            document.getElementById('guestCount').textContent = guestCount;
            document.getElementById('searchGuests').value = guestCount > 0 ? guestCount : '';
            
            const display = document.getElementById('guestDisplay');
            if (guestCount === 0) {
                display.textContent = 'Add guests';
                display.classList.remove('text-gray-900');
                display.classList.add('text-gray-400');
            } else {
                display.textContent = guestCount + (guestCount === 1 ? ' Guest' : ' Guests');
                display.classList.remove('text-gray-400');
                display.classList.add('text-gray-900');
            }
            
            document.getElementById('guestMinusBtn').disabled = (guestCount === 0);
        };

        // Flatpickr for dates
        let defaultDates = [];
        if ('{{ request("checkIn") }}' && '{{ request("checkOut") }}') {
            defaultDates = ['{{ request("checkIn") }}', '{{ request("checkOut") }}'];
        }

        flatpickr("#datePicker", {
            mode: "range",
            minDate: "today",
            dateFormat: "Y-m-d",
            defaultDate: defaultDates,
            showMonths: window.innerWidth >= 768 ? 2 : 1,
            onChange: function(selectedDates, dateStr, instance) {
                const display = document.getElementById('dateDisplay');
                if (selectedDates.length === 2) {
                    const start = selectedDates[0].toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
                    const end = selectedDates[1].toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
                    display.textContent = start + ' - ' + end;
                    display.classList.remove('text-gray-400');
                    display.classList.add('text-gray-900');
                    
                    document.getElementById('searchCheckIn').value = instance.formatDate(selectedDates[0], "Y-m-d");
                    document.getElementById('searchCheckOut').value = instance.formatDate(selectedDates[1], "Y-m-d");
                } else if (selectedDates.length === 1) {
                    display.textContent = selectedDates[0].toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
                    display.classList.remove('text-gray-400');
                    display.classList.add('text-gray-900');
                } else {
                    display.textContent = 'Add dates';
                    display.classList.remove('text-gray-900');
                    display.classList.add('text-gray-400');
                    document.getElementById('searchCheckIn').value = '';
                    document.getElementById('searchCheckOut').value = '';
                }
            },
            onReady: function(selectedDates, dateStr, instance) {
                if (selectedDates.length === 2) {
                    const display = document.getElementById('dateDisplay');
                    const start = selectedDates[0].toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
                    const end = selectedDates[1].toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
                    display.textContent = start + ' - ' + end;
                    display.classList.remove('text-gray-400');
                    display.classList.add('text-gray-900');
                }
            }
        });

        // Submit form
        window.submitSearch = function() {
            document.getElementById('searchForm').submit();
        };
    });
</script>
@endpush
