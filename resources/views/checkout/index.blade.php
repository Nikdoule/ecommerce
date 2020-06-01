@extends('layouts.app')

@section('extra-script')
<script src="https://js.stripe.com/v3/"></script>
@endsection

@section('checkout')
<div class="col-md-12">
    <h1 class="text-center">payement</h1>
    <div class="row">
        <div class="col-md-6 ml-auto mr-auto">
            <tbody class="rounded shadow-s">
                <tr>
                    <th scope="row" class="border-0">
                        <div class="p-2 shadow-sm p-3 mb-5 bg-white rounded">
                            @foreach (Cart::content() as $cart)
                            <div class="ml-3 d-inline-block align-middle mb-3">
                                <h5 class="mb-0">
                                    <a href="#" class="text-dark d-inline-block align-middle">{{ $cart->model->title }}</a>
                                </h5>
                            <p>{{ $cart->qty }}</p>
                                <span class="text-muted font-weight-normal font-italic d-block">Category: Watches</span>
                            </div>
                            @endforeach
                        </div>
                    </th>
                </tr>
                
            </tbody>
            <form action="{{ route('checkout.store') }}" method="POST" class="my-4" id="payment-form">
                @csrf
                <div id="card-element">
                    <!-- Elements will create input elements here -->
                </div>
                <div id="card-errors" role="alert"></div>
                <button class="btn btn-success mt-4" id="submit">Pay now({{ getPrice( Cart::total()) }})</button>
            </form>
        </div>
    </div>
</div>

@endsection

@section('extra-js')
<script>
    window.onload = () => {

        var stripe = Stripe('pk_test_1RZOdie4yZ9UtpsSb1tY5fl000R9oL6VNi');
        var elements = stripe.elements();
        var style = {
            base: {
                color: "#32325d",
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: "antialiased",
                fontSize: "16px",
                "::placeholder": {
                    color: "#aab7c4"
                }
            },
            invalid: {
                color: "#fa755a",
                iconColor: "#fa755a"
            }
        };
        var card = elements.create("card", {
            style: style
        });
        card.mount("#card-element");
        card.on('change', ({
            error
        }) => {
            const displayError = document.getElementById('card-errors');
            if (error) {
                displayError.textContent = error.message;
            } else {
                displayError.textContent = '';
            }
        });
        var submitButton = document.getElementById('submit');

        submitButton.addEventListener('click', function (ev) {

            ev.preventDefault();

            submitButton.disabled = true;

            stripe.confirmCardPayment("{{ $clientSecret }}", {
                payment_method: {
                    card: card,

                }
            }).then(function (result) {

                if (result.error) {

                    submitButton.disabled = false;
                    // Show error to your customer (e.g., insufficient funds)
                    console.log(result.error.message);
                } else {
                    // The payment has been processed!
                    if (result.paymentIntent.status === 'succeeded') {

                        var token = document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content');

                        var paymentIntent = result.paymentIntent;
                        var form = document.getElementById('payment-form');
                        var url = form.action;
                        var redirect = '/merci'

                        fetch(
                            url, {
                                headers: {
                                    "Content-Type": "application/json",
                                    "Accept": "application/json, text-plain, */*",
                                    "X-Requested-Whith": "XMLHttpRequest",
                                    "X-CSRF-TOKEN": token
                                },
                                method: 'post',
                                body: JSON.stringify({

                                    paymentIntent: paymentIntent

                                })
                            }
                        ).then((data) => {
                            location.href = '/thankyou';
                            console.log(data)

                        }).catch((error) => {

                            console.log(error)
                        })

                        console.log(result.paymentIntent);
                    }
                }
            });
        });
    }

</script>

@endsection
