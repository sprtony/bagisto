@if (request()->route()->getName() == 'shop.checkout.onepage.index')

    @php
        $public_key = core()->getConfigData('sales.paymentmethods.conektaCheckout.public_key');
    @endphp

    <script type="text/javascript" src="https://pay.conekta.com/v1.0/js/conekta-checkout.min.js"></script>

    <script>
        window.onload = (function() {
            eventBus.$on('after-payment-method-selected', function(payment) {
                console.log(payment.method)
                if (payment.method != 'conektaChekout') {
                    //borrar contenedores
                    $('#conektaIframeContainer').empty();
                    $('#conektaIframeContainer').css('height', 0);
                    return;
                }
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
            });
        });
    </script>
@endif
