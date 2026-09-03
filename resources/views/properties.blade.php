@extends('layouts.app')
@section('content')
    <div class="max-w-7xl mx-auto mt-12">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <h1 class="text-4xl font-serif mb-4">Our Properties</h1>
            <p class="text-gray-500 text-sm leading-relaxed">
                Your destination deserves the perfect launchpad. Swiss Vacation Houses offers a thoughtfully curated collection of stays. Experience unparalleled amenities, exceptional dining, and authentic local charm. Whether you are seeking five-star luxury or an exceptional value, discover your perfect home away from home today.
            </p>
        </div>
        
        <div class="mb-12">
            @include('partials.search-bar')
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
                                    {{ $property['address']['city'] ?? '' }}, {{ $property['address']['state'] ?? '' }}, {{ $property['address']['country'] ?? '' }}
                                @else
                                    Location not available
                                @endif
                            </span>
                        </div>

                        <div class="flex-grow"></div>

                        <div class="pt-4 border-t border-gray-100 flex justify-between flex-wrap gap-y-2 items-center text-xs text-gray-500">
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
                            @if(in_array('Pets allowed', $property['amenities'] ?? []))
                            <div class="flex items-center text-emerald-600 font-medium">
                                <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 8.5c1.4 0 2.5-1.1 2.5-2.5S13.4 3.5 12 3.5 9.5 4.6 9.5 6 10.6 8.5 12 8.5zm-4.5 1c-1.4 0-2.5-1.1-2.5-2.5s1.1-2.5 2.5-2.5 2.5 1.1 2.5 2.5-1.1 2.5-2.5 2.5zm9 0c-1.4 0-2.5-1.1-2.5-2.5s1.1-2.5 2.5-2.5 2.5 1.1 2.5 2.5-1.1 2.5-2.5 2.5zM12 10.5c-3 0-6 2.5-6 6v3.5h12V16.5c0-3.5-3-6-6-6z"/>
                                </svg>
                                <span>Pet Friendly</span>
                            </div>
                            @endif
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
@endsection