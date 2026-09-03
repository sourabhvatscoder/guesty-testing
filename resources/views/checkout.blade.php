<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Checkout</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .input-error { border-color: #ef4444 !important; background-color: #fef2f2 !important; }
    </style>
</head>
<body class="text-gray-900 antialiased py-10 px-4 sm:px-6 lg:px-8">

    <div class="max-w-6xl mx-auto">
        <!-- Minimal Header -->
        <div class="mb-10 pb-6 border-b border-gray-200 flex items-center justify-between">
            <h1 class="text-3xl font-serif font-bold text-gray-900">Secure Checkout</h1>
            <a href="{{ url()->previous() }}" class="text-sm font-medium text-gray-500 hover:text-gray-900">&larr; Back to property</a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 items-start">
            
            <!-- LEFT COLUMN: The Stepper Form -->
            <div class="lg:col-span-2 space-y-8">
                
                @if(isset($upsells) && count($upsells) > 0)
                <!-- ADD TO YOUR STAY (UPSELLS) -->
                <div id="step-upsells-container" class="bg-white border border-gray-100 rounded-2xl p-6 sm:p-8 shadow-sm transition-all duration-300">
                    <h2 class="text-xl font-bold mb-6">Add to your stay</h2>
                    
                    <div class="space-y-4">
                        @foreach($upsells as $upsell)
                        @php 
                            // Extract basic details safely
                            $upsellId = $upsell['_id'] ?? $upsell['id'] ?? uniqid('upsell_');
                            $upsellTitle = $upsell['title'] ?? $upsell['name'] ?? 'Additional Service';
                            $upsellDesc = $upsell['upsell']['description'] ?? '';
                            $upsellPrice = $upsell['price'] ?? 0;
                            $upsellImage = $upsell['upsell']['images'][0]['url'] ?? $upsell['image'] ?? null;
                        @endphp
                        <div class="flex flex-col sm:flex-row gap-4 border border-gray-100 p-4 rounded-xl items-center justify-between" id="upsell-card-{{ $upsellId }}">
                            <div class="flex gap-4 items-center w-full sm:w-auto">
                                @if($upsellImage)
                                <img src="{{ $upsellImage }}" class="w-16 h-16 object-cover rounded-lg">
                                @else
                                <div class="w-16 h-16 bg-gray-50 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                </div>
                                @endif
                                <div>
                                    <h4 class="font-bold text-gray-900">{{ $upsellTitle }}</h4>
                                    @if($upsellDesc)
                                    <p class="text-xs text-gray-500 mt-0.5 line-clamp-2 max-w-sm">{{ $upsellDesc }}</p>
                                    @endif
                                    <p class="text-emerald-600 font-semibold text-sm mt-1">
                                        +${{ number_format((float)$upsellPrice, 2) }}
                                    </p>
                                </div>
                            </div>
                            <button type="button" 
                                class="upsell-toggle-btn px-6 py-2 border border-emerald-600 text-emerald-600 rounded-lg text-sm font-bold hover:bg-emerald-50 transition-colors w-full sm:w-auto hover:text-emerald-700"
                                data-id="{{ $upsellId }}"
                                data-title="{{ $upsellTitle }}"
                                data-price="{{ (float)$upsellPrice }}"
                                onclick="toggleUpsell(this)">
                                Add
                            </button>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- GUEST INFORMATION -->
                <div id="step1-container" class="bg-white border border-gray-100 rounded-2xl p-6 sm:p-8 shadow-sm transition-all duration-300">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold">1. Guest Information</h2>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded hidden" id="step1-success">Completed</span>
                    </div>

                    <div id="step1-form" class="space-y-5">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1.5">First Name</label>
                                <input type="text" id="firstName" class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none transition-colors">
                                <p class="text-xs text-red-500 mt-1 hidden err-msg">First name is required</p>
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1.5">Last Name</label>
                                <input type="text" id="lastName" class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none transition-colors">
                                <p class="text-xs text-red-500 mt-1 hidden err-msg">Last name is required</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1.5">Email Address</label>
                                <input type="email" id="email" class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none transition-colors">
                                <p class="text-xs text-red-500 mt-1 hidden err-msg">Enter a valid email address</p>
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1.5">Phone Number</label>
                                <input type="tel" id="phone" placeholder="+1 (555) 000-0000" class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none transition-colors">
                                <p class="text-xs text-red-500 mt-1 hidden err-msg">Enter a valid phone number</p>
                            </div>
                        </div>
                        
                        <div class="pt-4">
                            <button type="button" onclick="validateStep1()" class="w-full sm:w-auto px-8 py-3.5 bg-gray-900 hover:bg-gray-800 text-white font-semibold rounded-xl transition-all text-sm shadow-md">
                                Next: Payment Details
                            </button>
                        </div>
                    </div>
                </div>

                <!-- STEP 2: PAYMENT INFORMATION -->
                <div id="step2-container" class="bg-white border border-gray-100 rounded-2xl p-6 sm:p-8 shadow-sm opacity-50 pointer-events-none transition-all duration-300">
                    <h2 class="text-xl font-bold mb-6">2. Payment & Billing</h2>
                    
                    <div id="guesty-tokenization-container"></div>
                    <button type="button" onclick="validate()" class="w-full px-8 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl transition-all text-base shadow-lg flex justify-center items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        Pay Now
                    </button>
                </div>
            </div>

            <!-- RIGHT COLUMN: Sticky Order Summary -->
            <div class="lg:col-span-1 lg:sticky lg:top-6">
                <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-xl space-y-6">
                    
                    <!-- Property Preview -->
                    <div class="flex gap-4">
                        <img src="{{ $property['picture']['thumbnail'] ?? 'https://via.placeholder.com/150' }}" class="w-24 h-24 object-cover rounded-xl" alt="Property">
                        <div>
                            <p class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-1">{{ $property['propertyType'] ?? 'Rental' }}</p>
                            <h3 class="text-sm font-bold text-gray-900 leading-tight">{{ $property['title'] ?? 'Property Name' }}</h3>
                        </div>
                    </div>

                    <!-- Stay Details -->
                    <div class="border-t border-b border-gray-100 py-4 space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500 font-medium">Dates</span>
                            <span class="text-gray-900 font-semibold">{{ \Carbon\Carbon::parse($request->check_in)->format('M d') }} - {{ \Carbon\Carbon::parse($request->check_out)->format('M d, Y') }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500 font-medium">Guests</span>
                            <span class="text-gray-900 font-semibold">{{ $request->guests }} Guest(s)</span>
                        </div>
                    </div>

                    <!-- Price Breakdown -->
                    <div class="space-y-3" id="price-details-list">
                        <h4 class="text-xs font-bold uppercase tracking-widest text-gray-400">Price Details</h4>
                        
                        @php
                            $ratePlanNode = $quote['rates']['ratePlans'][0]['ratePlan']['money'] ?? null;
                            $invoiceItems = $ratePlanNode['invoiceItems'] ?? [];
                            $total = ($ratePlanNode['subTotalPrice'] ?? 0) + ($ratePlanNode['totalTaxes'] ?? 0);
                        @endphp

                        @foreach($invoiceItems as $item)
                            <div class="flex justify-between text-sm text-gray-600">
                                <span class="capitalize">{{ str_replace('_', ' ', strtolower($item['title'])) }}</span>
                                <span>${{ number_format($item['amount'], 2) }}</span>
                            </div>
                        @endforeach
                    </div>

                    <!-- Total -->
                    <div class="border-t border-gray-100 pt-4 flex justify-between font-bold text-gray-900 text-lg">
                        <span>Total (USD)</span>
                        <span id="order-total-amount">${{ number_format($total, 2) }}</span>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Checkout UI Logic -->
    <script>
        let baseTotal = {{ $total }};
        let addedUpsells = {};
        
        const setError = (id, show) => {
            const el = document.getElementById(id);
            const msg = el.nextElementSibling;
            if (show) {
                el.classList.add('input-error');
                msg.classList.remove('hidden');
            } else {
                el.classList.remove('input-error');
                msg.classList.add('hidden');
            }
        };

        const isValidEmail = (email) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        const isValidPhone = (phone) => phone.replace(/[^0-9]/g,"").length >= 10;

        window.validateStep1 = function() {
            let isValid = true;
            
            const fName = document.getElementById('firstName').value.trim();
            const lName = document.getElementById('lastName').value.trim();
            const email = document.getElementById('email').value.trim();
            const phone = document.getElementById('phone').value.trim();

            if (!fName) { setError('firstName', true); isValid = false; } else setError('firstName', false);
            if (!lName) { setError('lastName', true); isValid = false; } else setError('lastName', false);
            if (!isValidEmail(email)) { setError('email', true); isValid = false; } else setError('email', false);
            if (!isValidPhone(phone)) { setError('phone', true); isValid = false; } else setError('phone', false);

            if (isValid) {
                document.getElementById('step1-form').classList.add('hidden');
                document.getElementById('step1-success').classList.remove('hidden');
                
                const step2 = document.getElementById('step2-container');
                step2.classList.remove('opacity-50', 'pointer-events-none');
                step2.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        };
        
        window.toggleUpsell = async function(btn) {
            const id = btn.getAttribute('data-id');
            const title = btn.getAttribute('data-title');
            const quoteId = "{{ $quote['_id'] }}";
            
            // Toggle local state
            if (addedUpsells[id]) {
                delete addedUpsells[id];
            } else {
                addedUpsells[id] = true;
            }

            // Update button UI to loading
            const originalText = btn.textContent;
            btn.textContent = 'Updating...';
            btn.disabled = true;

            try {
                const response = await fetch(`/quotes/${quoteId}/upsells`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        additionalFeeIds: Object.keys(addedUpsells)
                    })
                });

                if (!response.ok) {
                    throw new Error('Failed to update upsells');
                }

                const updatedQuote = await response.json();
                
                // Update button style based on new state
                if (addedUpsells[id]) {
                    btn.textContent = 'Added';
                    btn.classList.remove('text-emerald-600', 'bg-transparent');
                    btn.classList.add('bg-emerald-600', 'text-white');
                } else {
                    btn.textContent = 'Add';
                    btn.classList.remove('bg-emerald-600', 'text-white');
                    btn.classList.add('text-emerald-600', 'bg-transparent');
                }

                // Update Price Breakdown UI from updatedQuote
                const ratePlanNode = updatedQuote?.rates?.ratePlans?.[0]?.ratePlan?.money;
                if (ratePlanNode) {
                    const invoiceItems = ratePlanNode.invoiceItems || [];
                    const subTotal = ratePlanNode.subTotalPrice || 0;
                    const taxes = ratePlanNode.totalTaxes || 0;
                    const newTotal = subTotal + taxes;

                    // Re-render invoice items list
                    const summaryList = document.getElementById('price-details-list');
                    summaryList.innerHTML = '<h4 class="text-xs font-bold uppercase tracking-widest text-gray-400">Price Details</h4>';
                    
                    invoiceItems.forEach(item => {
                        const titleStr = item.title.toLowerCase().replace(/_/g, ' ');
                        const amountStr = item.amount.toFixed(2);
                        summaryList.innerHTML += `
                            <div class="flex justify-between text-sm text-gray-600 capitalize">
                                <span>${titleStr}</span>
                                <span>$${amountStr}</span>
                            </div>
                        `;
                    });

                    // Update Total
                    document.getElementById('order-total-amount').textContent = '$' + newTotal.toFixed(2);
                    window.checkoutTotalAmount = newTotal;
                }

            } catch (error) {
                console.error(error);
                alert('Could not update upsells. Please try again.');
                // Revert local state
                if (addedUpsells[id]) {
                    delete addedUpsells[id];
                    btn.textContent = 'Add';
                } else {
                    addedUpsells[id] = true;
                    btn.textContent = 'Added';
                }
            } finally {
                btn.disabled = false;
            }
        };
        
        window.checkoutTotalAmount = baseTotal;
    </script>

    <!-- Javascript Validation Engine & Guesty SDK Integration -->
    <script type="module">
        
        import { loadScript } from 'https://cdn.jsdelivr.net/npm/@guestyorg/tokenization-js@latest/+esm';

        try {
            const guestyTokenization = await loadScript({ version: 'v2' });
            console.log("Guesty Tokenization JS SDK loaded successfully:", guestyTokenization);
            await guestyTokenization.render({
                containerId: "guesty-tokenization-container",
                providerId: "64e62e61f4eb00004905a7c7"
            });
        } catch (error) {
            console.error("Error with Guesty Tokenization SDK:", error);
        }

        window.validate = function() {
            guestyTokenization.validate();
            var payload = {
                amount: window.checkoutTotalAmount,
                currency: "{{ $quote['rates']['ratePlans'][0]['ratePlan']['money']['currency'] ?? 'USD' }}",
                listingId: "{{ $request->listing_id }}",
                quoteId: "{{ $quote['_id'] }}",
                guest: {
                    firstName: document.getElementById('firstName').value.trim() || 'test',
                    lastName: document.getElementById('lastName').value.trim() || 'test',
                    email: document.getElementById('email').value.trim() || 'test@example.com',
                    phone: document.getElementById('phone').value.trim() || '1234567890'
                }
            };
            var paymentResponse = guestyTokenization.submit(payload);
            console.log("Payment Response:", paymentResponse);
        }
    </script>
</body>
</html>