@if (request()->route()->getName() == 'shop.checkout.onepage.index')

    @php
        
        //datos para paypal smart button
        $clientId = core()->getConfigData('sales.paymentmethods.paypal_smart_button.client_id');
        $acceptedCurrency = core()->getConfigData('sales.paymentmethods.paypal_smart_button.accepted_currencies');
        //datos para conekta checkout
        $public_key = core()->getConfigData('sales.paymentmethods.conektaCheckout.public_key');
        
    @endphp

    <script src="https://www.paypal.com/sdk/js?client-id={{ $clientId }}&currency={{ $acceptedCurrency }}"
        data-partner-attribution-id="Bagisto_Cart"></script>
    <script type="text/javascript" src="https://pay.conekta.com/v1.0/js/conekta-checkout.min.js"></script>

    <style>
        .component-frame.visible {
            z-index: 1 !important;
        }

    </style>

    <script>
        window.onload = (function() {
            eventBus.$on('after-payment-method-selected', function(payment) {
                console.log(payment.method)
                //borrar contenedores
                $('#conektaIframeContainer').empty();
                $('#conektaIframeContainer').css('height', 0);
                $('.paypal-buttons').remove();

                if (payment.method == 'conektaCheckout') {
                    $('#conektaIframeContainer').css('height', 700);

                    window.axios.get("{{ route('conekta.checkout.create') }}")
                        .then(function(response) {

                            let conektaoptions = {
                                targetIFrame: "#conektaIframeContainer",
                                checkoutRequestId: response.data,
                                publicKey: "{{ $public_key }}",
                                options: {},
                                styles: {},
                                onFinalizePayment: function(event) {
                                    console.log(event.charge.status);
                                    window.location.href =
                                        "{{ route('conekta.checkout.success') }}";
                                }
                            }

                            window.ConektaCheckoutComponents.Integration(conektaoptions);
                        });
                } else if (payment.method == 'paypal_smart_button') {
                    let messages = {
                        universalError: "{{ __('paypal::app.error.universal-error') }}",
                        sdkValidationError: "{{ __('paypal::app.error.sdk-validation-error') }}",
                        authorizationError: "{{ __('paypal::app.error.authorization-error') }}"
                    };
                    if (typeof paypal == 'undefined') {
                        options.alertBox(messages.sdkValidationError);
                        return;
                    }

                    let options = {
                        style: {
                            layout: 'vertical',
                            shape: 'rect',
                        },

                        authorizationFailed: false,

                        enableStandardCardFields: false,

                        alertBox: function(message) {
                            window.Swal.fire(
                                'Error!',
                                message,
                                'error'
                            );
                            console.log(message);
                        },

                        createOrder: function(data, actions) {
                            return window.axios.get(
                                    "{{ route('paypal.smart-button.create-order') }}")
                                .then(function(response) {
                                    console.log(response);
                                    return response.data.result;
                                })
                                .then(function(orderData) {
                                    console.log(orderData)
                                    return orderData.id;
                                })
                                .catch(function(error) {
                                    if (error.response.data.error === 'invalid_client') {
                                        options.authorizationFailed = true;
                                        options.alertBox(messages.authorizationError);
                                    }

                                    return error;
                                });
                        },

                        onApprove: function(data, actions) {
                            app.showLoader();
                            window.axios.post(
                                "{{ route('paypal.smart-button.capture-order') }}", {
                                    _token: "{{ csrf_token() }}",
                                    orderData: data
                                })
                                .then(function(response) {
                                    if (response.data.success) {
                                        if (response.data.redirect_url) {
                                            window.location.href = response.data.redirect_url;
                                        } else {
                                            window.location.href =
                                                "{{ route('shop.checkout.success') }}";
                                        }
                                    }

                                    app.hideLoader();
                                })
                                .catch(function(error) {
                                    window.location.href =
                                        "{{ route('shop.checkout.cart.index') }}";
                                })
                        },

                        onError: function(error) {
                            if (!options.authorizationFailed) {
                                options.alertBox(error);
                            }
                        }
                    };
                    paypal.Buttons(options).render('.paypal-button-container');

                } else {
                    $('#conektaIframeContainer').empty();
                    $('#conektaIframeContainer').css('height', 0);
                    $('.paypal-buttons').remove();
                    return
                }
            });
        });

    </script>

@endif
