<x-app-layout>

    <div class="pay-confirm-page">

        <div class="pay-alert">
            <img src="{{ url('storage/images/mpesa.png') }}" alt="mpesa logo">
            <p class="instruction">Check for a popup on your phone and enter your MPESA PIN to confirm the charges.</p>

            <div class="notice">

                <i class="fas fa-spinner"></i>
                <input type="text" id="orderID" value="{{ $order->id }}" hidden>
                <p><span>NB : </span>We will redirect after the payment is confirmed</p>

            </div>
        </div>
    </div>





    <x-slot name="pagescripts">

        <script>
        const orderID = document.querySelector('#orderID').value;

        let interValHandler = 0;



        const checkPay = () => {



            fetch(`/user/order/${orderID}/payment-check`).then(res => res.json()).then(response => {
                if (response.isPaid) {
                    document.location.href = `/user/order/${orderID}/payment`;
                }
            }).catch(err => console
                .log(
                    err))

        }

        interValHandler = setInterval(checkPay, 5000);
        </script>


    </x-slot>


</x-app-layout>