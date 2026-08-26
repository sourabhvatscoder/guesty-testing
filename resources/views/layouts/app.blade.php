<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Swiss Vacation Houses')</title>
    <meta name="description" content="@yield('meta_description', 'Discover the finest vacation homes in Switzerland. Enjoy luxury, comfort, and breathtaking views. Book your dream getaway today!')">
    <meta name="keywords" content="@yield('meta_keywords', 'Swiss vacation homes, luxury rentals, Swiss Alps, holiday homes, vacation rentals, Switzerland travel')">
    <meta name="author" content="Swiss Vacation Houses">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .font-serif { font-family: 'Playfair Display', serif; }
        html { scroll-behavior: smooth; }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
    @stack('styles')
</head>
<body class="text-gray-800 antialiased">
    <header class="sticky top-0 bg-white/80 backdrop-blur-md border-b border-gray-100 z-50 transition-all duration-200">
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <div class="flex-shrink-0">
                    <a href="/" class="font-serif text-2xl font-bold tracking-tight text-gray-900 hover:opacity-90 transition-opacity">
                        Swiss<span class="text-gray-400 font-light"> Vacation Houses</span>
                    </a>
                </div>

                <nav class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-sm font-medium text-gray-500 hover:text-gray-900 border-b-2 border-transparent hover:border-gray-200 pb-1 pt-0.5 transition-all">
                        Home
                    </a>
                    <a href="/properties" class="text-sm font-medium text-gray-500 hover:text-gray-900 border-b-2 border-transparent hover:border-gray-200 pb-1 pt-0.5 transition-all">
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
                    <a href="/properties" class="inline-flex items-center justify-center px-4 py-2 text-xs font-semibold uppercase tracking-wider text-white bg-gray-900 hover:bg-gray-800 rounded-lg transition-colors shadow-sm">
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

    @yield('content')
    
    <!-- FOOTER SECTION -->
    <footer class="bg-gray-900 text-white pt-16 pb-8 mt-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                
                <!-- Column 1: Brand & Socials -->
                <div class="space-y-6">
                    <a href="/" class="font-serif text-2xl font-bold tracking-tight hover:opacity-90 transition-opacity">
                        Swiss<span class="text-gray-400 font-light"> Vacation Houses</span>
                    </a>
                    <p class="text-gray-400 text-sm leading-relaxed pr-4">
                        Your piece of paradise in Central Florida. Experience world-class waterskiing, luxury villas, and unforgettable family getaways.
                    </p>
                    <!-- Social Icons -->
                    <div class="flex items-center space-x-4 pt-2">
                        <!-- Facebook -->
                        <a href="https://www.facebook.com/SwissVacationHouses/" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-emerald-600 hover:text-white transition-all duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" /></svg>
                        </a>
                        <!-- Instagram -->
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-emerald-600 hover:text-white transition-all duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" /></svg>
                        </a>
                        <!-- Twitter / X -->
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-emerald-600 hover:text-white transition-all duration-300">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Column 2: Quick Links -->
                <div>
                    <h4 class="text-white font-serif font-bold text-lg mb-6">Quick Links</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="/" class="text-gray-400 hover:text-emerald-400 transition-colors inline-block hover:translate-x-1 transform duration-200">Home</a></li>
                        <li><a href="/properties" class="text-gray-400 hover:text-emerald-400 transition-colors inline-block hover:translate-x-1 transform duration-200">Our Accommodations</a></li>
                        <li><a href="/resort-map" class="text-gray-400 hover:text-emerald-400 transition-colors inline-block hover:translate-x-1 transform duration-200">Resort Map</a></li>
                        <li><a href="/about" class="text-gray-400 hover:text-emerald-400 transition-colors inline-block hover:translate-x-1 transform duration-200">About Us</a></li>
                        <li><a href="/contact" class="text-gray-400 hover:text-emerald-400 transition-colors inline-block hover:translate-x-1 transform duration-200">Contact</a></li>
                    </ul>
                </div>

                <!-- Column 3: Contact Info -->
                <div>
                    <h4 class="text-white font-serif font-bold text-lg mb-6">Contact Us</h4>
                    <ul class="space-y-4 text-sm text-gray-400">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-3 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            <a href="tel:+13524292178" class="hover:text-emerald-400 transition-colors">+1 (352) 429-2178</a>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-3 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <a href="mailto:info@swissvacationhouses.com" class="hover:text-emerald-400 transition-colors">info@swissvacationhouses.com</a>
                        </li>
                    </ul>
                </div>

                <!-- Column 4: Location -->
                <div>
                    <h4 class="text-white font-serif font-bold text-lg mb-6">Location</h4>
                    <ul class="space-y-4 text-sm text-gray-400">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-3 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span class="leading-relaxed">
                                13114 Skiing Paradise Blvd, Clermont, FL 34711, USA <br>
                                <br>
                                34711 Clermont <br>
                                Florida United States
                            </span>
                        </li>
                    </ul>
                </div>

            </div>

            <!-- Bottom Bar: Copyright & Legal -->
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center text-xs text-gray-500">
                <p>&copy; {{ date('Y') }} Swiss Vacation Houses. All rights reserved.</p>
                <div class="flex space-x-4 mt-4 md:mt-0">
                    <a href="/privacy" class="hover:text-emerald-400 transition-colors">Privacy Policy</a>
                    <a href="/terms" class="hover:text-emerald-400 transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>
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

        // Active link highlighting based on current URL
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('nav a');
        navLinks.forEach(link => {
            if (link.getAttribute('href') === currentPath) {
                link.classList.add('text-gray-900', 'border-gray-900');
                link.classList.remove('text-gray-500', 'border-transparent');
            }
        });
    });
</script>
@stack('scripts')
</html>