<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- include head -->
@include('view_admin.head')
<!-- /include head -->
<body class="hold-transition sidebar-mini layout-fixed">
<!-- Site wrapper -->
<div class="wrapper">

    <!-- include navbar -->
@include('view_admin.navbar')
<!-- /include navbar -->

    <!-- include Main sidebar -->
@include('view_admin.sidebar')
<!-- /include Main sidebar -->



    <!-- Main content -->
    <!-- Section -->

@yield('content_admin')
<!-- /Section -->



<!-- /.content -->
    </div>


    @include('view_admin.footer')
</div>
<!-- ./wrapper -->

<!-- include foot -->
@include('view_admin.foot')
<!-- /include foot -->

<!-- FOOT FOR FORM SUBMISSION ESPECIALLY TEXTAREA -->
<!-- Summernote -->
<script src="{{ asset('t_admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- CodeMirror -->
<script src="{{ asset('t_admin/plugins/codemirror/codemirror.js') }}"></script>
<script src="{{ asset('t_admin/plugins/codemirror/mode/css/css.js') }}"></script>
<script src="{{ asset('t_admin/plugins/codemirror/mode/xml/xml.js') }}"></script>
<script src="{{ asset('t_admin/plugins/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>

<!-- dropzonejs -->
<script src="{{ asset('t_admin/plugins/dropzone/min/dropzone.min.js') }}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{ asset('t_admin/dist/js/demo.js') }}"></script>
<!-- Page specific script -->
<script>
    $(function () {
        // Summernote
        $('#summernote').summernote()

        // CodeMirror
        CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
            mode: "htmlmixed",
            theme: "monokai"
        });
    })
</script>








{{-- --}}
<script type="text/javascript">
   /*
    // Create an instance of the Stripe object
    // Set your publishable API key
    //var stripe = Stripe('');
    var stripe = Stripe('stripe-public-key');
    // Create an instance of elements
    var elements = stripe.elements();

    var style = {
        base: {
            fontWeight: 400,
            fontFamily: 'Roboto, Open Sans, Segoe UI, sans-serif',
            fontSize: '16px',
            lineHeight: '1.4',
            color: '#555',
            backgroundColor: '#fff',
            '::placeholder': {
                color: '#888',
            },
        },
        invalid: {
            color: '#eb1c26',
        }
    };
    //var cardNameElement = elements.create('cardName', {style: style});
    //cardNameElement.mount('#card_name');

    var cardElement = elements.create('cardNumber', {
        style: style
    });
    cardElement.mount('#card_number');

    var exp = elements.create('cardExpiry', {
        'style': style
    });
    exp.mount('#card_expiry');

    var cvc = elements.create('cardCvc', {
        'style': style
    });
    cvc.mount('#card_cvc');

    // Validate input of the card elements
    var resultContainer = document.getElementById('paymentResponse');
    cardElement.addEventListener('change', function(event) {
        if (event.error) {
            resultContainer.innerHTML = '<p>'+event.error.message+'</p>';
        } else {
            resultContainer.innerHTML = '';
        }
    });

    // Get payment form element

    var form = document.getElementById('paymentFrm');

    // Create a token when the form is submitted.
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        createToken();
    });



    // Create single-use token to charge the user

    function createToken() {
        stripe.createToken(cardElement).then(function(result) {
            if (result.error) {
                // Inform the user if there was an error
                resultContainer.innerHTML = '<p>'+result.error.message+'</p>';
            } else {
                // Send the token to your server
                stripeTokenHandler(result.token);
            }
        });
    }


    // Callback to handle the response from stripe

    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
    }

    */
</script>



<script type="text/javascript">
    //const cardHolderName = document.getElementById('card-holder-name');
    //const cardButton = document.getElementById('card-button');
    //
    /*
    const cardHolderName = document.getElementById('first_name');
    const cardButton = document.getElementById('payBtn');

    cardButton.addEventListener('click', async (e) => {
        const { paymentMethod, error } = await stripe.createPaymentMethod(
            'card', cardElement, {
                billing_details: { name: cardHolderName.value }
            }
        );

        if (error) {
            // Display "error.message" to the user...
            resultContainer.innerHTML = '<p>'+error.message+'</p>';
        } else {
            // The card has been verified successfully...
        }
    });
    //*/
</script>




<script type="text/javascript">
    /*
    // Create an instance of the Stripe object with your publishable API key
    var stripe = Stripe("pk_test_51IWo7BFda2UQUDA674JhTw8pfYryYIRcAalfxz055p4SL7ynpiUXCtgIsNNioFeZfY3l7zP7GbFozCi9cH5gTQyx00XY7gHooY");
    var checkoutButton = document.getElementById("checkout-button");
    checkoutButton.addEventListener("click", function () {
        //fetch("/create-checkout-session.php", {
        fetch("route('create_checkout_session')", {

            method: "POST",
        })
            .then(function (response) {
                return response.json();
            })
            .then(function (session) {
                return stripe.redirectToCheckout({ sessionId: session.id });
            })
            .then(function (result) {
                // If redirectToCheckout fails due to a browser or network
                // error, you should display the localized error message to your
                // customer using error.message.
                if (result.error) {
                    alert(result.error.message);
                }
            })
            .catch(function (error) {
                console.error("Error:", error);
            });
    });

    */

</script>



{{-- -}}
<script type="text/javascript">
    //Payment Methods For Subscriptions
  /*
    var resultContainer = document.getElementById('paymentResponse');

    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');
    const clientSecret = cardButton.dataset.secret;

    cardButton.addEventListener('click', async (e) => {
        const { setupIntent, error } = await stripe.confirmCardSetup(
            clientSecret, {
                payment_method: {
                    card: cardElement,
                    billing_details: { name: cardHolderName.value }
                }
            }
        );

        if (error) {
            // Display "error.message" to the user...
            resultContainer.innerHTML = '<p>'+error.message+'</p>';
        } else {
            // The card has been verified successfully...
            resultContainer.innerHTML = '';
        }
    });
    */
    //*



    // Disable the button until we have Stripe set up on the page
    document.querySelector("button").disabled = true;

    const stripe = Stripe('{{ env('STRIPE_KEY') }}');

    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');


    //Payment Methods For Single Charges
    const resultContainer = document.getElementById('paymentResponse');

    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');


    cardElement.on('change', function(event) {
        // Disable the Pay button if there are no card details in the Element
        document.querySelector("button").disabled = event.empty;
        document.querySelector("#card-error").textContent = event.error ? event.error.message : "";
        if (event.error) {
            //Enable button
            //document.querySelector("button").disabled = true;
            resultContainer.innerHTML = '<p>'+error.message+'</p>';
            // show validation to customer
        }
        else {
            resultContainer.innerHTML = '';
            //document.querySelector("button").disabled = false;
        }
    });

/*
    // Create single-use token to charge the user
    function createToken() {
        stripe.createToken(cardElement).then(function(result) {
            if (result.error) {
                // Inform the user if there was an error
                resultContainer.innerHTML = '<p>'+result.error.message+'</p>';
            } else {
                // Send the token to your server
                stripeTokenHandler(result.token);
            }
        });
    }
*/


    cardButton.addEventListener('click', async (e) => {
        const { paymentMethod, error } = await stripe.createPaymentMethod(
            'card', cardElement, {
                billing_details: { name: cardHolderName.value }
            }
        );
        if (error) {
            // Display "error.message" to the user...
            resultContainer.innerHTML = '<p>'+error.message+'</p>';
        } else {
            // The card has been verified successfully...
            resultContainer.innerHTML = '';
            const payment_id = paymentMethod.id;
            createPayment(payment_id);
        }
    });

    const form = document.getElementById('paymentFrm');
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        // Complete payment when the submit button is clicked
        payWithCard(stripe, card, data.clientSecret);
    });

    // Calls stripe.confirmCardPayment
    // If the card requires authentication Stripe shows a pop-up modal to
    // prompt the user to enter authentication details without leaving your page.
    var payWithCard = function(stripe, card, clientSecret) {
        loading(true);
        stripe
            .confirmCardPayment(clientSecret, {
                payment_method: {
                    card: card
                }
            })
            .then(function(result) {
                if (result.error) {
                    // Show error to your customer
                    showError(result.error.message);
                } else {
                    // The payment succeeded!
                    orderComplete(result.paymentIntent.id);
                }
            });
    };

    // Submit the form with the token ID.
    function createPayment(payment_id) {
        // Insert the token ID into the form so it gets submitted to the server
        const form = document.getElementById('paymentFrm');
        const hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'payment_id'); // the token ID could be named payment_id or stripeToken but must be rendered to through the App
        hiddenInput.setAttribute('value',payment_id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
    }



</script>

{{-- --}}


</body>

</html>
