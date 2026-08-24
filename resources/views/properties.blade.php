<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Properties</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .font-serif { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="text-gray-800 antialiased py-4 px-4 sm:px-6 lg:px-8 lg:py-8">
    <header class="sticky top-0 bg-white/80 backdrop-blur-md border-b border-gray-100 z-50 transition-all duration-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <div class="flex-shrink-0">
                    <a href="/" class="font-serif text-2xl font-bold tracking-tight text-gray-900 hover:opacity-90 transition-opacity">
                        Swiss<span class="text-gray-400 font-light"> Vacation Houses</span>
                    </a>
                </div>

                <nav class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-sm font-medium text-gray-900 border-b-2 border-gray-900 pb-1 pt-0.5 transition-all">
                        Home
                    </a>
                    <a href="/" class="text-sm font-medium text-gray-500 hover:text-gray-900 border-b-2 border-transparent hover:border-gray-200 pb-1 pt-0.5 transition-all">
                        Accommodations
                    </a>
                    <a href="/resort-map" class="text-sm font-medium text-gray-500 hover:text-gray-900 border-b-2 border-transparent hover:border-gray-200 pb-1 pt-0.5 transition-all">
                        Resort Map
                    </a>
                    <a href="/contact" class="text-sm font-medium text-gray-500 hover:text-gray-900 border-b-2 border-transparent hover:border-gray-200 pb-1 pt-0.5 transition-all">
                        Contact
                    </a>
                </nav>

                <div class="hidden md:flex items-center">
                    <a href="/" class="inline-flex items-center justify-center px-4 py-2 text-xs font-semibold uppercase tracking-wider text-white bg-gray-900 hover:bg-gray-800 rounded-lg transition-colors shadow-sm">
                        Book Now
                    </a>
                </div>

                <div class="flex md:hidden">
                    <button type="button" id="mobileMenuToggle" class="inline-flex items-center justify-center p-2 rounded-lg text-gray-500 hover:text-gray-900 hover:bg-gray-50 focus:outline-none transition-colors">
                        <svg id="hamburgerIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg id="closeIcon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

            </div>
        </div>

        <div id="mobileMenu" class="hidden md:hidden border-b border-gray-100 bg-white/95 backdrop-blur-md animate-in fade-in slide-in-from-top-4 duration-200">
            <div class="px-4 pt-2 pb-6 space-y-3 shadow-inner">
                <a href="/" class="block px-3 py-2.5 text-base font-semibold text-gray-900 bg-gray-50 rounded-xl">
                    Home
                </a>
                <a href="/" class="block px-3 py-2.5 text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-xl transition-colors">
                    Accommodations
                </a>
                <a href="/resort-map" class="block px-3 py-2.5 text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-xl transition-colors">
                    Resort Map
                </a>
                <a href="/contact" class="block px-3 py-2.5 text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-xl transition-colors">
                    Contact
                </a>
                <div class="pt-4 px-3">
                    <a href="/" class="block w-full py-3 px-4 bg-gray-900 hover:bg-gray-800 text-white font-semibold text-center rounded-xl text-sm shadow-sm transition-colors">
                        Book Now
                    </a>
                </div>
            </div>
        </div>
    </header>
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
</body>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const mobileMenu = document.getElementById('mobileMenu');
        const hamburgerIcon = document.getElementById('hamburgerIcon');
        const closeIcon = document.getElementById('closeIcon');

        mobileMenuToggle.addEventListener('click', () => {
            const isHidden = mobileMenu.classList.toggle('hidden');
            
            // Toggle vector icon indicators
            if (isHidden) {
                hamburgerIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            } else {
                hamburgerIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
            }
        });

        // Close drawer if screen resizes past mobile thresholds dynamically
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                mobileMenu.classList.add('hidden');
                hamburgerIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            }
        });
    });
</script>
</html>