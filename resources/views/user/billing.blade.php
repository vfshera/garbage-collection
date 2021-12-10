<x-app-layout>
    <div class="billing-page">


        <header>
            <h1>Billing</h1>

        </header>


        <section class="billing-wrapper">

            <div class="billing-header">
                <div class="serial">
                    ORDER
                </div>

                <div class="customer">
                    CUSTOMER
                </div>

                <div class="transaction">
                    TRANSACTION
                </div>
                <div class="amount">
                    AMOUNT
                </div>

                <div class="date">
                    DATE
                </div>
            </div>

            <div class="bills">

                @foreach($orders as $order)
                <div class="bill">
                    <div class="serial">
                        {{ $order->serial }}
                    </div>

                    <div class="customer">
                        CUSTOMER
                    </div>

                    <div class="transaction">
                        {{ $order->payment->TransID }}

                    </div>

                    <div class="amount">
                        {{ number_format($order->cost , 0 , "",",") }} Ksh.
                    </div>

                    <div class="date">
                        {{ date('H:i \- jS M Y', strtotime($order->payment->created_at)) }}
                    </div>
                </div>

                @endforeach
            </div>

        </section>


    </div>
</x-app-layout>