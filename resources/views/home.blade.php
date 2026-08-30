@extends('layouts.app')
@section('title', 'Home - Swiss Vacation Houses')
@section('content')
    <main>
        <!-- 1. HERO SECTION -->
        <section class="relative h-[85vh] min-h-[600px] flex items-center justify-center">
            <!-- Background Image with Overlay -->
            <div class="absolute inset-0 z-0">
                <!-- Replace with your actual best resort photo -->
                <img src="https://assets.guesty.com/image/upload/v1783042609/production/64b00434b78496e69c8f5da9/uizfld2zxchfj09g2abl.jpg" alt="Resort View" class="w-full h-full object-cover" />
                <div class="absolute inset-0 bg-gray-900/40 mix-blend-multiply"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 via-gray-900/20 to-transparent"></div>
            </div>

            <!-- Hero Content -->
            <div class="relative z-10 text-center px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto mt-16">
                <span class="block text-white/90 text-sm md:text-base font-semibold tracking-[0.2em] uppercase mb-4 animate-fade-in-up">
                    Welcome to Clermont, Florida
                </span>
                <h1 class="text-4xl sm:text-5xl md:text-7xl font-serif font-bold text-white leading-tight mb-6 drop-shadow-lg">
                    Find Your Dream <br/><span class="italic font-light">Getaway.</span>
                </h1>
                <p class="mt-4 text-lg sm:text-xl text-gray-100 mb-10 font-light leading-relaxed max-w-2xl mx-auto drop-shadow-md">
                    Best Vacation Rentals with Waterski, Golf, Private lakes, and Resort amenities on site.
                </p>
                
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
                        <input type="hidden" name="city" id="searchCity">
                        <input type="hidden" name="country" id="searchCountry">
                        <input type="hidden" name="checkIn" id="searchCheckIn">
                        <input type="hidden" name="checkOut" id="searchCheckOut">
                        <input type="hidden" name="minOccupancy" id="searchGuests" value="">
                    </form>
                </div>
            </div>
        </section>

        <div class="max-w-7xl mx-auto mt-12">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <h1 class="text-4xl font-serif mb-4">Our Properties</h1>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Your destination deserves the perfect launchpad. Swiss Vacation Houses offers a thoughtfully curated collection of stays. Experience unparalleled amenities, exceptional dining, and authentic local charm. Whether you are seeking five-star luxury or an exceptional value, discover your perfect home away from home today.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($properties as $property)
                    <a href="{{ route('properties.show', $property['_id']) }}" class="group bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden flex flex-col border border-gray-100">
                        
                        <div class="relative h-56 w-full">
                            <img 
                                src="{{ $property['picture']['regular'] ?? 'https://via.placeholder.com/600x400?text=No+Image' }}" 
                                alt="{{ $property['title'] ?? 'Property' }}" 
                                class="object-cover h-full w-full group-hover:scale-105 transition-transform duration-300"
                            >
                        </div>

                        <div class="p-6 flex-grow flex flex-col">
                            <h3 class="text-lg font-semibold truncate mb-1">
                                {{ $property['title'] ?? 'Untitled Property' }}
                            </h3>
                            
                            <p class="text-sm text-gray-500 truncate mb-4">
                                {{ $property['publicDescription']['summary'] ?? 'Welcome to this cozy retreat...' }}
                            </p>
                            
                            <p class="text-sm font-semibold mb-3">
                                Starting at ${{ $property['prices']['basePrice'] ?? '0' }} / night
                            </p>

                            <div class="flex items-center text-xs text-gray-500 mb-6">
                                <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span class="truncate">
                                    @if(isset($property['address']))
                                        {{ $property['address']['street'] ?? '' }}, {{ $property['address']['city'] ?? '' }}, {{ $property['address']['state'] ?? '' }}, {{ $property['address']['country'] ?? '' }}
                                    @else
                                        Location not available
                                    @endif
                                </span>
                            </div>

                            <div class="flex-grow"></div>

                            <div class="pt-4 border-t border-gray-100 flex justify-between items-center text-xs text-gray-500">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                    <span>{{ $property['accommodates'] ?? 0 }} guests</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                    <span>{{ $property['beds'] ?? 0 }} beds</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                    <span>{{ $property['bathrooms'] ?? 0 }} baths</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-500">
                        No properties currently available.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- 2. REVIEWS / SOCIAL PROOF SECTION -->
        <section class="py-16 bg-white relative z-20 mt-10 shadow-[0_-10px_40px_rgba(0,0,0,0.1)]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="text-center mb-10">
                    <h2 class="text-2xl font-serif font-bold text-gray-900">Loved by Travelers Worldwide</h2>
                    <div class="flex items-center justify-center gap-1 mt-3 text-emerald-500">
                        <!-- 5 Stars -->
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </div>
                    <p class="text-sm text-gray-500 mt-2 font-medium">4.9/5 Average Rating</p>
                </div>

                <!-- Review Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Review 1 -->
                    <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100">
                        <p class="text-gray-600 text-sm italic mb-4 leading-relaxed">"The perfect family getaway! Having the golf course and private lake right outside our door was unbelievable. The villa was spotless and fully equipped."</p>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 font-bold font-serif">SM</div>
                            <div>
                                <h4 class="text-sm font-bold text-gray-900">Sarah Mitchell</h4>
                                <p class="text-xs text-gray-500">Stayed in Villa 42</p>
                            </div>
                        </div>
                    </div>
                    <!-- Review 2 -->
                    <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100">
                        <p class="text-gray-600 text-sm italic mb-4 leading-relaxed">"A waterskiing paradise. We come back every year and it never disappoints. Being 35 mins from Orlando means we get the parks and the peace."</p>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 font-bold font-serif">JD</div>
                            <div>
                                <h4 class="text-sm font-bold text-gray-900">James Davies</h4>
                                <p class="text-xs text-gray-500">Stayed in Sumner Lake</p>
                            </div>
                        </div>
                    </div>
                    <!-- Review 3 -->
                    <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100">
                        <p class="text-gray-600 text-sm italic mb-4 leading-relaxed">"Luxury meets nature. Waking up to the serene views of the resort was exactly what we needed to unwind. Highly recommend the heated infinity pool."</p>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 font-bold font-serif">ER</div>
                            <div>
                                <h4 class="text-sm font-bold text-gray-900">Elena Rodriguez</h4>
                                <p class="text-xs text-gray-500">Stayed in The Grand Villa</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 3. ABOUT US SECTION -->
        <section class="py-20 bg-[#fbfbfb] border-t border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    
                    <!-- Text Content -->
                    <div class="space-y-6">
                        <span class="text-xs font-bold tracking-widest text-emerald-600 uppercase">Our Story</span>
                        <h2 class="text-3xl md:text-4xl font-serif font-bold text-gray-900 leading-tight">
                            Your Piece of Paradise <br/> in Central Florida
                        </h2>
                        <div class="space-y-4 text-gray-600 leading-relaxed text-sm md:text-base">
                            <p>
                                Set on 450 beautiful acres, our resort is a world-renowned destination designed for both relaxation and adventure. Whether you are a keen water-sports enthusiast, an avid golfer, or simply looking for a beautiful place to escape, we have something tailored just for you.
                            </p>
                            <p>
                                Stay onsite in one of our fully equipped luxury villas, cozy studios, or lakeside rooms. Enjoy an unbeatable location with onsite waterskiing, golf, cycling, and walking trails, while the magic of Disney and Orlando’s world-famous attractions remain only 35 minutes away.
                            </p>
                        </div>
                        <div class="pt-4">
                            <a href="/properties" class="inline-flex items-center text-sm font-bold text-gray-900 hover:text-emerald-600 transition-colors group">
                                Explore all accommodations
                                <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    </div>

                    <!-- Image Collage -->
                    <div class="relative h-[400px] sm:h-[500px]">
                        <!-- Main large image -->
                        <img src="https://assets.guesty.com/image/upload/v1721425959/production/64b00434b78496e69c8f5da9/amyiglch79r26emnhypt.jpg" alt="Resort Activities" class="absolute top-0 right-0 w-4/5 h-4/5 object-cover rounded-2xl shadow-xl z-10" />
                        <!-- Secondary overlapping image -->
                        <img src="https://assets.guesty.com/image/upload/v1783042609/production/64b00434b78496e69c8f5da9/wdjicqfqffopkf6hw5ca.jpg" alt="Luxury Villa Interior" class="absolute bottom-0 left-0 w-3/5 h-2/3 object-cover rounded-2xl shadow-2xl z-20 border-4 border-white" />
                    </div>

                </div>
            </div>
        </section>

    </main>

    @push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @endpush

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let guestCount = 0;
            const destToggle = document.getElementById('destToggle');
            const destDropdown = document.getElementById('destDropdown');
            const guestToggle = document.getElementById('guestToggle');
            const guestDropdown = document.getElementById('guestDropdown');
            const destDisplay = document.getElementById('destDisplay');
            const searchCity = document.getElementById('searchCity');
            const searchCountry = document.getElementById('searchCountry');
            
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
                // Assuming state string like 'Florida, United States', we will extract 'United States'
                // But since we know it's always 'United States', we can just hardcode or parse.
                // The API expects 'United States', which is the part after the comma.
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
            flatpickr("#datePicker", {
                mode: "range",
                minDate: "today",
                dateFormat: "Y-m-d",
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
                }
            });

            // Submit form
            window.submitSearch = function() {
                document.getElementById('searchForm').submit();
            };
        });
    </script>
    @endpush
@endsection