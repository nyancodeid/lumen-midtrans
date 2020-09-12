@extends('layouts/app')

@section("content")
<section>
    <div class="container max-w-full mx-auto px-6">
        <div class="relative block flex flex-col md:flex-row items-center">
            <div class="w-full lg:w-1/2 sm:my-5 my-8 relative z-10">
                <h1 class="text-center text-4xl text-black font-medium leading-snug tracking-wider">
                    Checkout
                </h1>
                <p class="text-center text-lg text-gray-700 mt-2 px-6">
                    Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.
                </p>
                <div class="h-1 mx-auto bg-indigo-200 w-24 opacity-75 mt-4 rounded"></div>
            </div>

            <div class="w-full lg:w-1/2 sm:my-5 my-8 relative z-10">
                <div class="max-w-full md:max-w-6xl mx-auto my-3 md:px-8">
                    <div class="relative block flex flex-col md:flex-row items-center justify-center">
                        <div class="w-full max-w-md sm:w-full lg:w-2/3 sm:my-5 my-8 relative z-10 bg-white rounded-lg shadow-lg">
                            <div class="text-sm leading-none rounded-t-lg bg-yellow-400 text-black font-semibold uppercase py-4 text-center tracking-wide">
                                Selected Product
                            </div>
                            <div class="block text-left text-sm sm:text-md max-w-sm mx-auto mt-2 text-black px-8 lg:px-6">
                                <h1 class="text-lg font-medium uppercase p-3 pb-0 text-center tracking-wide">
                                    {{ $product["name"] }}
                                </h1>
                                <h2 class="text-sm text-gray-500 text-center pb-6"><span class="text-3xl">{{ $product["price_text"] }}</span> /mo</h2>

                                Stripe offers everything needed to run an online business at scale. Get in touch for details.
                            </div>
                            <div class="flex pl-12 justify-start sm:justify-start mt-3">
                                <ul>
                                    <li class="flex items-center">
                                        <div class="rounded-full p-2 fill-current text-green-700">
                                            <svg class="w-6 h-6 align-middle" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                            </svg>
                                        </div>
                                        <span class="text-gray-700 text-lg ml-3">No setup</span>
                                    </li>
                                    <li class="flex items-center">
                                        <div class="rounded-full p-2 fill-current text-green-700">
                                            <svg class="w-6 h-6 align-middle" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                            </svg>
                                        </div>
                                        <span class="text-gray-700 text-lg ml-3">Hidden fees</span>
                                    </li>
                                    <li class="flex items-center">
                                        <div class="rounded-full p-2 fill-current text-green-700">
                                            <svg class="w-6 h-6 align-middle" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                            </svg>
                                        </div>
                                        <span class="text-gray-700 text-lg ml-3">Original</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="block flex items-center p-8">
                                <button class="mt-3 text-lg font-semibold text-center bg-yellow-500 w-full text-black rounded-lg px-6 py-3 block hover:bg-black hover:text-yellow-500" onclick="onCheckout()">
                                    Checkout: {{ $product["price_text"] }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section("script")
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ $client_key }}"></script>
<script>
function onCheckout () {
    fetch("/tx/create", {
        method: "POST",
        body: JSON.stringify({
            id: "{{ $product_id }}"
        }),
        headers: {
            "Content-Type": "application/json"
        }
    }).then(res => res.json()).then(result => {
        const token = result.token;

        snap.pay(token, {
            onSuccess: function(payResult) {
                console.log("Success", payResult);
                alert("Transaction Success");
            },
            onPending: function(payResult) {
                console.log("Pending", payResult);
                alert("Transaction Pending");
            },
            onError: function(payResult) {
                console.log("Error", payResult);
                alert("Transaction Error");
            },
        })
    }).catch(function() {
        alert("Error Get Token");
    })
}
</script>
@endsection
