<x-app-layout>

    <div class="pay-for-order-page">
        <header>
            <h1>Order {{ $order->serial }} Payment</h1>
        </header>

        <section class="order-overview">
            <div class="order-details">

                <div class="status">
                    <label>Status</label>

                    <p>{{ ($order->status == 1) ? "Active" : "Pending" }}</p>


                </div>

                <div class="waste">
                    <label>Waste</label>

                    <p>{{ $order->waste->title}}</p>

                </div>

                <div class="weight">
                    <label>Weight</label>

                    <p>{{ $order->weight }} KG(s)</p>


                </div>

                <div class="unit-cost">
                    <label for="">Cost Per KG</label>

                    <p>{{ $order->waste->cost }} Ksh.</p>


                </div>





            </div>

            <div class="order-summary">
                <div class="summary">
                    <label>Total</label>
                    <p>{{ $order->cost }} Ksh.</p>
                </div>

                @if(Auth::user()->phone != "")
                <form action="{{ route('user.order.pay' , ['order' => $order->id ]) }}" method="POST">

                    @csrf
                    <div class="paying-number">
                        <p>Paying with </p>
                        <img src="{{ url('storage/images/mpesa.png') }}" alt="mpesa">
                    </div>

                    <div class="btn-num">
                        <span>
                            +{{ Auth::user()->phone }}
                        </span>
                        <button>Pay Now</button>
                    </div>
                </form>
                @else
                <div class="set-details">
                    <p>Set Your Phone Nuber First</p>
                    <a href="{{ route('user.location') }}">Set Info</a>
                </div>
                @endif

            </div>
        </section>
    </div>
</x-app-layout>