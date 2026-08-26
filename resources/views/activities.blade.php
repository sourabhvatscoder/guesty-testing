<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activities | StayEase</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .font-serif { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="text-gray-900 antialiased">

    <!-- [Your Navigation Header Goes Here] -->

    <main class="py-12 sm:py-20">
        
        <!-- Page Header -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16 text-center">
            <span class="block text-emerald-600 text-sm font-bold tracking-[0.2em] uppercase mb-3">Explore The Area</span>
            <h1 class="text-4xl md:text-5xl font-serif font-bold text-gray-900">Resort Activities & Attractions</h1>
            <p class="mt-4 text-gray-500 max-w-2xl mx-auto">Make the most of your vacation whether you are staying on the resort or venturing out into Orlando's world-famous entertainment districts.</p>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">

            <!-- 1. WATERSKI SECTION (Text Right) -->
            <section class="relative rounded-2xl overflow-hidden h-[500px] shadow-xl group">
                <!-- Background Image (Using placeholder, replace with your actual image) -->
                <img src="https://images.unsplash.com/photo-1520208422220-d12a3c588e6c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" alt="Waterskiing" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
                
                <!-- Gradient Overlay for readability -->
                <div class="absolute inset-0 bg-gradient-to-t md:bg-gradient-to-r from-gray-900/80 md:from-transparent md:via-gray-900/60 to-gray-900/90"></div>
                
                <!-- Content -->
                <div class="absolute inset-0 flex flex-col justify-center md:justify-end md:items-end p-8 md:p-16">
                    <div class="max-w-xl text-left md:text-right">
                        <h2 class="text-3xl md:text-4xl font-serif font-bold text-white mb-4">Waterski</h2>
                        <p class="text-gray-200 text-sm md:text-base leading-relaxed mb-8 font-light">
                            SWISS WATERSKI RESORT is one of the world's premier waterski schools, home to World Championship events and led by experienced professional coaches. Whether you're a complete beginner or an elite competitor, their personalized coaching focuses on technique, confidence, and lasting improvement. Guests ski behind the latest Nautique boats on world-class slalom lakes while enjoying a welcoming atmosphere where skiers of every level share the water and their passion for the sport.
                        </p>
                        <a href="#" class="inline-block px-6 py-3 border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:text-gray-900 transition-colors duration-300">
                            Swiss Waterski Resort
                        </a>
                    </div>
                </div>
            </section>

            <!-- 2. GOLF SECTION (Text Left) -->
            <section class="relative rounded-2xl overflow-hidden h-[500px] shadow-xl group">
                <img src="https://images.unsplash.com/photo-1587174486073-ae5e5cff23aa?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" alt="Golf Course" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
                
                <div class="absolute inset-0 bg-gradient-to-t md:bg-gradient-to-l from-gray-900/80 md:from-transparent md:via-gray-900/60 to-gray-900/90"></div>
                
                <div class="absolute inset-0 flex flex-col justify-center p-8 md:p-16">
                    <div class="max-w-xl text-left">
                        <h2 class="text-3xl md:text-4xl font-serif font-bold text-white mb-4">Golf</h2>
                        <p class="text-gray-200 text-sm md:text-base leading-relaxed mb-8 font-light">
                            SWISS FAIRWAYS Golf Course offers a one-of-a-kind golfing experience with a redesigned 9-hole layout that plays like a full 18 using multiple tee boxes. Set across rolling hills uncommon in Florida, this par-70 course combines scenic beauty with a fun and challenging round for every golfer.
                        </p>
                        <a href="#" class="inline-block px-6 py-3 border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:text-gray-900 transition-colors duration-300">
                            Swiss Fairways
                        </a>
                    </div>
                </div>
            </section>

            <!-- 3. THINGS TO DO SECTION (Text Right) -->
            <section class="relative rounded-2xl overflow-hidden h-[500px] shadow-xl group">
                <img src="https://images.unsplash.com/photo-1536294576359-543163351d40?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" alt="Disney Castle" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
                
                <div class="absolute inset-0 bg-gradient-to-t md:bg-gradient-to-r from-gray-900/80 md:from-transparent md:via-gray-900/60 to-gray-900/90"></div>
                
                <div class="absolute inset-0 flex flex-col justify-center md:justify-end md:items-end p-8 md:p-16">
                    <div class="max-w-xl text-left md:text-right">
                        <h2 class="text-3xl md:text-4xl font-serif font-bold text-white mb-4">Things To Do</h2>
                        <p class="text-gray-200 text-sm md:text-base leading-relaxed mb-8 font-light">
                            Don't ski? Or traveling with someone who doesn't? Or just want to make the most of your vacation? Whether on or off the resort, you'll find plenty of activities to keep everyone entertained.
                        </p>
                        <a href="#" class="inline-block px-6 py-3 border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:text-gray-900 transition-colors duration-300">
                            Walt Disney World
                        </a>
                    </div>
                </div>
            </section>

            <!-- 4. MORE THINGS TO DO (Grid) -->
            <section class="pt-12 border-t border-gray-200">
                <h2 class="text-3xl font-serif font-bold text-gray-900 mb-8 text-center md:text-left">More Things to Do!</h2>
                
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6">
                    
                    <!-- Grid Item 1 -->
                    <div class="relative aspect-square rounded-xl overflow-hidden shadow-md group cursor-pointer">
                        <img src="https://images.unsplash.com/photo-1517976487492-5750f3195933?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Space Center" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gray-900/20 group-hover:bg-gray-900/50 transition-colors duration-300"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                            <h3 class="text-white font-bold text-sm sm:text-lg drop-shadow-md">Kennedy Space Center</h3>
                        </div>
                    </div>

                    <!-- Grid Item 2 -->
                    <div class="relative aspect-square rounded-xl overflow-hidden shadow-md group cursor-pointer">
                        <!-- Use actual alligator/gatorland photo here -->
                        <img src="https://images.unsplash.com/photo-1596702644265-27a175dfb3cd?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Gatorland" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gray-900/20 group-hover:bg-gray-900/50 transition-colors duration-300"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                            <h3 class="text-white font-bold text-sm sm:text-lg drop-shadow-md">Gatorland</h3>
                        </div>
                    </div>

                    <!-- Grid Item 3 -->
                    <div class="relative aspect-square rounded-xl overflow-hidden shadow-md group cursor-pointer">
                        <img src="https://images.unsplash.com/photo-1550184658-ff6132a71714?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="SeaWorld" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gray-900/20 group-hover:bg-gray-900/50 transition-colors duration-300"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                            <h3 class="text-white font-bold text-sm sm:text-lg drop-shadow-md">SeaWorld Orlando</h3>
                        </div>
                    </div>

                    <!-- Grid Item 4 -->
                    <div class="relative aspect-square rounded-xl overflow-hidden shadow-md group cursor-pointer">
                        <img src="https://images.unsplash.com/photo-1574971719266-93166878b275?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Icon Park" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gray-900/20 group-hover:bg-gray-900/50 transition-colors duration-300"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                            <h3 class="text-white font-bold text-sm sm:text-lg drop-shadow-md">ICON Park</h3>
                        </div>
                    </div>

                    <!-- Grid Item 5 -->
                    <div class="relative aspect-square rounded-xl overflow-hidden shadow-md group cursor-pointer">
                        <img src="https://images.unsplash.com/photo-1616422285623-149b5c3258a5?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Epcot" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gray-900/20 group-hover:bg-gray-900/50 transition-colors duration-300"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                            <h3 class="text-white font-bold text-sm sm:text-lg drop-shadow-md">EPCOT</h3>
                        </div>
                    </div>

                    <!-- Grid Item 6 -->
                    <div class="relative aspect-square rounded-xl overflow-hidden shadow-md group cursor-pointer">
                        <img src="https://images.unsplash.com/photo-1605330335028-09559c394c8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Universal Studios" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gray-900/20 group-hover:bg-gray-900/50 transition-colors duration-300"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                            <h3 class="text-white font-bold text-sm sm:text-lg drop-shadow-md">Universal Studios</h3>
                        </div>
                    </div>

                </div>
            </section>

        </div>
    </main>

    <!-- [Your Footer Goes Here] -->

</body>
</html>