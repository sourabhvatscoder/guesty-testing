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
                <div id="guesty-tokenization-container"></div>
                <button type="button" onclick="validate()" class="w-full px-8 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl transition-all text-base shadow-lg flex justify-center items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    Pay Now
                </button>
                
                <!-- STEP 1: GUEST INFORMATION -->
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
                    
                    <div class="space-y-6">
                        <!-- Card Details -->
                        <div class="space-y-4">
                            <h3 class="text-sm font-semibold text-gray-900 border-b pb-2">Credit Card Details</h3>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1.5">Name on Card</label>
                                <input type="text" id="cardName" class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:ring-2 focus:ring-gray-900 outline-none transition-colors">
                                <p class="text-xs text-red-500 mt-1 hidden err-msg">Name on card is required</p>
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1.5">Card Number</label>
                                <input type="text" id="cardNumber" maxlength="19" placeholder="0000 0000 0000 0000" class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:ring-2 focus:ring-gray-900 outline-none transition-colors">
                                <p class="text-xs text-red-500 mt-1 hidden err-msg">Enter a valid 16-digit card number</p>
                            </div>
                            <div class="grid grid-cols-3 gap-5">
                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1.5">Exp Month</label>
                                    <input type="text" id="expMonth" maxlength="2" placeholder="MM" class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:ring-2 focus:ring-gray-900 outline-none text-center">
                                    <p class="text-xs text-red-500 mt-1 hidden err-msg">Invalid</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1.5">Exp Year</label>
                                    <input type="text" id="expYear" maxlength="4" placeholder="YYYY" class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:ring-2 focus:ring-gray-900 outline-none text-center">
                                    <p class="text-xs text-red-500 mt-1 hidden err-msg">Invalid</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1.5">CVV</label>
                                    <input type="password" id="cvv" maxlength="4" placeholder="123" class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:ring-2 focus:ring-gray-900 outline-none text-center">
                                    <p class="text-xs text-red-500 mt-1 hidden err-msg">Invalid</p>
                                </div>
                            </div>
                        </div>

                        <!-- Billing Address -->
                        <div class="space-y-4 pt-4">
                            <h3 class="text-sm font-semibold text-gray-900 border-b pb-2">Billing Address</h3>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1.5">Street Address</label>
                                <input type="text" id="address" class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:ring-2 focus:ring-gray-900 outline-none transition-colors">
                                <p class="text-xs text-red-500 mt-1 hidden err-msg">Address is required</p>
                            </div>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-5">
                                <div class="sm:col-span-1">
                                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1.5">City</label>
                                    <input type="text" id="city" class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:ring-2 focus:ring-gray-900 outline-none">
                                    <p class="text-xs text-red-500 mt-1 hidden err-msg">Required</p>
                                </div>
                                <div class="sm:col-span-1">
                                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1.5">Zipcode</label>
                                    <input type="text" id="zipcode" class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:ring-2 focus:ring-gray-900 outline-none">
                                    <p class="text-xs text-red-500 mt-1 hidden err-msg">Required</p>
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1.5">Country</label>
                                    <input type="text" id="country" class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:ring-2 focus:ring-gray-900 outline-none">
                                    <p class="text-xs text-red-500 mt-1 hidden err-msg">Required</p>
                                </div>
                            </div>
                        </div>

                        
                    </div>
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
                    <div class="space-y-3">
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
                        <span>${{ number_format($total, 2) }}</span>
                    </div>

                </div>
            </div>
        </div>
    </div>

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
                amount: Number("{{ $quote['rates']['ratePlans'][0]['ratePlan']['money']['hostPayout'] ?? 0 }}"),
                currency: "{{ $quote['rates']['ratePlans'][0]['ratePlan']['money']['currency'] ?? 'USD' }}",
                listingId: "{{ $request->listing_id }}",
                quoteId: "{{ $quote['_id'] }}",
                guest: {
                    firstName: 'test',
                    lastName: 'test',
                    email: 'test@example.com',
                    phone: '1234567890'
                }
            };
            var paymentResponse = guestyTokenization.submit(payload);
            console.log("Payment Response:", paymentResponse);
        }

        // Renders the Guesty tokenization form in the provided container element. The form is rendered in an iframe to ensure PCI compliance.
        // Returns a Promise that resolves after the iframe is loaded or is rejected if the iframe fails to load.
        // Options 
        // containerId (required) The ID of the container element within which the iframe will be rendered. 
        // providerId (required) The ID of the payment provider for which the form is rendered.
        // onStatusChange (optional) A callback function to be called when the validity of the form changes. Boolean value will be passed as an argument

        // var guestyTokenizationInstance = null;
        // var guestyTokenizationFormContainer = document.getElementById('guesty-tokenization-form-container');
        // var guestyTokenizationFormOptions = {
        //     containerId: 'guesty-tokenization-form-container',
        //     providerId: '64e62e61f4eb00004905a7c7',
        // };

        // loadScript().then(() => {
        //     console.log("Guesty Tokenization SDK loaded successfully.");
        //     guestyTokenizationInstance = guestyTokenization.render(guestyTokenizationFormOptions);
        //     console.log("Guesty Tokenization form initialized:", guestyTokenizationInstance);
        // }).catch((error) => {
        //     console.error("Failed to load Guesty Tokenization SDK:", error);
        // });

        // const listingId = "{{ $request->listing_id }}";
        // const quoteId = "{{ $quote['_id'] }}";
        // const quoteTotalAmount = parseFloat("{{ $total ?? 0 }}");
        // const quoteCurrency = "{{ $quote['rates']['ratePlans'][0]['ratePlan']['money']['currency'] ?? 'USD' }}";
        // const successRedirectUrl = `${window.location.origin}/booking-success`;
        // const failureRedirectUrl = `${window.location.origin}/booking-failed`;

        // console.log("Checkout initialized. Listing ID:", listingId, "Total:", quoteTotalAmount, quoteCurrency);

        // const setError = (id, show) => {
        //     const el = document.getElementById(id);
        //     const msg = el.nextElementSibling;
        //     if (show) {
        //         el.classList.add('input-error');
        //         msg.classList.remove('hidden');
        //     } else {
        //         el.classList.remove('input-error');
        //         msg.classList.add('hidden');
        //     }
        // };

        // const isValidEmail = (email) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        // const isValidPhone = (phone) => phone.replace(/[^0-9]/g,"").length >= 10;
        
        // document.getElementById('cardNumber').addEventListener('input', function (e) {
        //     e.target.value = e.target.value.replace(/[^\d]/g, '').replace(/(.{4})/g, '$1 ').trim();
        // });

        // window.validateStep1 = function() {
        //     console.log("--- Step 1 Validation Started ---");
        //     let isValid = true;
            
        //     const fName = document.getElementById('firstName').value.trim();
        //     const lName = document.getElementById('lastName').value.trim();
        //     const email = document.getElementById('email').value.trim();
        //     const phone = document.getElementById('phone').value.trim();

        //     if (!fName) { setError('firstName', true); isValid = false; } else setError('firstName', false);
        //     if (!lName) { setError('lastName', true); isValid = false; } else setError('lastName', false);
        //     if (!isValidEmail(email)) { setError('email', true); isValid = false; } else setError('email', false);
        //     if (!isValidPhone(phone)) { setError('phone', true); isValid = false; } else setError('phone', false);

        //     if (isValid) {
        //         console.log("Step 1 Validated successfully. Proceeding to Step 2.");
        //         document.getElementById('step1-form').classList.add('hidden');
        //         document.getElementById('step1-success').classList.remove('hidden');
                
        //         const step2 = document.getElementById('step2-container');
        //         step2.classList.remove('opacity-50', 'pointer-events-none');
        //         document.getElementById('cardName').value = `${fName} ${lName}`;
        //         step2.scrollIntoView({ behavior: 'smooth', block: 'start' });
        //     } else {
        //         console.warn("Step 1 Validation failed. Check input fields.");
        //     }
        // };

        // window.validateStep2 = async function() {
        //     console.log("--- Step 2 Validation Started ---");
        //     let isValid = true;
            
        //     const cardName = document.getElementById('cardName').value.trim();
        //     const cardNum = document.getElementById('cardNumber').value.replace(/\s/g, ''); 
        //     const expMonth = document.getElementById('expMonth').value.trim().padStart(2, '0');
        //     const expYear = document.getElementById('expYear').value.trim();
        //     const cvv = document.getElementById('cvv').value.trim();
            
        //     const address = document.getElementById('address').value.trim();
        //     const city = document.getElementById('city').value.trim();
        //     const zip = document.getElementById('zipcode').value.trim();
        //     const country = document.getElementById('country').value.trim();

        //     if (!cardName) { setError('cardName', true); isValid = false; } else setError('cardName', false);
        //     if (cardNum.length < 15 || cardNum.length > 19 || isNaN(cardNum)) { setError('cardNumber', true); isValid = false; } else setError('cardNumber', false);
        //     if (cvv.length < 3 || isNaN(cvv)) { setError('cvv', true); isValid = false; } else setError('cvv', false);
            
        //     const currentYear = new Date().getFullYear();
        //     const currentMonth = new Date().getMonth() + 1;
        //     let validExpiry = true;
            
        //     if (expMonth < 1 || expMonth > 12 || isNaN(expMonth)) validExpiry = false;
        //     if (expYear.length !== 4 || isNaN(expYear) || expYear < currentYear) validExpiry = false;
        //     if (expYear == currentYear && parseInt(expMonth) < currentMonth) validExpiry = false;

        //     if (!validExpiry) {
        //         setError('expMonth', true);
        //         setError('expYear', true);
        //         isValid = false;
        //     } else {
        //         setError('expMonth', false);
        //         setError('expYear', false);
        //     }

        //     if (!address) { setError('address', true); isValid = false; } else setError('address', false);
        //     if (!city) { setError('city', true); isValid = false; } else setError('city', false);
        //     if (!zip) { setError('zipcode', true); isValid = false; } else setError('zipcode', false);
        //     if (!country) { setError('country', true); isValid = false; } else setError('country', false);

        //     if (!isValid) {
        //         console.warn("Step 2 Local Validation failed. Check payment input fields.");
        //         return;
        //     }

        //     const btn = document.querySelector('button[onclick="validateStep2()"]');
        //     const originalBtnText = btn.innerHTML;
        //     btn.innerHTML = `Processing Secure Payment...`;
        //     btn.disabled = true;

        //     const fName = document.getElementById('firstName').value.trim();
        //     const lName = document.getElementById('lastName').value.trim();
        //     const email = document.getElementById('email').value.trim();
        //     const phone = document.getElementById('phone').value.trim();
        //     const tokenizationPayload = {
        //         amount: Number(quoteTotalAmount),
        //         currency: quoteCurrency,
        //         listingId: listingId,
        //         quoteId: quoteId,
        //         guest: {
        //             firstName: fName,
        //             lastName: lName,
        //             email: email,
        //             phone: phone
        //         },
                // card: {
                //     number: cardNum,
                //     exp_month: expMonth,
                //     exp_year: expYear,
                //     cvc: cvv
                // },
                // billing_details: {
                //     name: cardName,
                //     address: {
                //         line1: address,
                //         city: city,
                //         postal_code: zip,
                //         country: country
                //     }
                // },
                // threeDS: {
                //     amount: Number(quoteTotalAmount),
                //     currency: quoteCurrency,
                //     successURL: successRedirectUrl,
                //     failureURL: failureRedirectUrl
                // }
        //     };

        //     console.log("Local validation passed. Payload constructed:", JSON.parse(JSON.stringify(tokenizationPayload).replace(cardNum, '********' + cardNum.slice(-4))));

        //     try {
        //         console.log("Loading Guesty Tokenization SDK v2...");
        //         const guestyTokenization = await loadScript({ version: 'v2' });
        //         console.log("SDK Loaded successfully:", guestyTokenization);

        //         console.log("Executing guestyTokenization.submit()...");
                
        //         // --- FIX: Changed from .tokenize() to .submit() ---
        //         const response = await guestyTokenization.submit(tokenizationPayload);
                
        //         console.log("Tokenization Response SUCCESS:", response);

        //         if (response.threeDS && response.threeDS.authURL) {
        //             console.log("3D Secure Authentication required. Redirecting to:", response.threeDS.authURL);
        //             window.location.href = response.threeDS.authURL;
        //             return;
        //         }

        //         console.log("No 3DS required. Proceeding to backend reservation creation with Token:", response._id);
        //         await createReservation(response._id);

        //     } catch (error) {
        //         // We are now logging the FULL error object to the console
        //         console.error("=== TOKENIZATION FAILED ===");
        //         console.error(error);
                
        //         // Show the specific error message returned by Guesty to the user
        //         let errorMsg = "Payment Error: ";
        //         if (error.message) {
        //             errorMsg += error.message;
        //         } else if (error.details) {
        //             errorMsg += JSON.stringify(error.details);
        //         } else {
        //             errorMsg += JSON.stringify(error);
        //         }
                
        //         alert(errorMsg);
                
        //         btn.innerHTML = originalBtnText;
        //         btn.disabled = false;
        //     }
        // };

        // async function createReservation(ccToken) {
        //     console.log("--- Creating Final Reservation ---");
        //     const fName = document.getElementById('firstName').value;
        //     const lName = document.getElementById('lastName').value;
        //     const email = document.getElementById('email').value;
        //     const phone = document.getElementById('phone').value;
            
        //     const urlParams = new URLSearchParams(window.location.search);
        //     const checkIn = urlParams.get('check_in');
        //     const checkOut = urlParams.get('check_out');
            
        //     const backendPayload = {
        //         listing_id: listingId,
        //         check_in: checkIn,
        //         check_out: checkOut,
        //         guests: urlParams.get('guests'),
        //         ccToken: ccToken,
        //         guest: {
        //             first_name: fName,
        //             last_name: lName,
        //             email: email,
        //             phone: phone
        //         }
        //     };
            
        //     console.log("Submitting to Laravel backend:", backendPayload);

        //     try {
        //         const response = await fetch('/api/v1/reservations', {
        //             method: 'POST',
        //             headers: { 
        //                 'Content-Type': 'application/json',
        //                 'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //             },
        //             body: JSON.stringify(backendPayload)
        //         });

        //         if (response.ok) {
        //             console.log("Backend reservation SUCCESS!");
        //             window.location.href = successRedirectUrl;
        //         } else {
        //             const err = await response.json();
        //             console.error("Backend reservation FAILED:", err);
        //             throw new Error(err.message || 'Error creating reservation on server.');
        //         }
        //     } catch (error) {
        //         console.error("Reservation Error:", error);
        //         alert(error.message);
        //         const btn = document.querySelector('button[onclick="validateStep2()"]');
        //         btn.innerHTML = `Pay Now`;
        //         btn.disabled = false;
        //     }
        // }
    </script>
</body>
</html>