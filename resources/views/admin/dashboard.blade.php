<x-app-layout>
    <div class="dashview">
        <header>
            <h1>Wecome, {{ Auth::user()->name }}.</h1>

            <p>{{ date('h:i a, jS M Y' , strtotime(now())) }}</p>
        </header>

        <div class="reports-overview">

            <div class="dash-overview">
                <div class="dash-item">

                    <p class="amount">
                        {{ $ordersCount }}
                    </p>


                    <p class="label">
                        Orders
                    </p>

                </div>

                <div class="dash-item">

                    <p class="amount">
                        {{ number_format($paymentsSum , 0 , "",",")  }} Ksh.
                    </p>


                    <p class="label">
                        Received
                    </p>

                </div>
            </div>

            <div class="reports">

                <a href="{{ route('admin.report.order') }}">
                    <div class="report">
                        Orders<br>
                        Report
                    </div>

                </a>

                <a href="{{ route('admin.report.payment') }}">

                    <div class="report">
                        Payment<br>
                        Report
                    </div>

                </a>

            </div>
        </div>

        <div class="activity">
            <div class="last-orders">
                <h3>Latest Orders</h3>

                <div class="orderhead">
                    <div class="item-serial">Serial</div>
                    <div class="item-waste">Waste</div>
                    <div class="item-total">Total</div>
                    <div class="item-status">Status</div>
                    <div class="item-progress">Progress</div>
                </div>

                <div class="shortlist">
                    @foreach($latestOrders as $key => $order)
                    <div class="orderitem">
                        <div class="item-serial">{{ $key+1 .". ".$order->serial }}</div>
                        <div class="item-waste">
                            @if(strlen($order->waste->title) > 15)
                            {{ substr($order->waste->title,0,15) . "..." }}
                            @else
                            {{ $order->waste->title}}
                            @endif
                        </div>
                        <div class="item-total">{{ number_format($order->cost , 0 , "",",")  }} Ksh.</div>
                        <div class="item-status {{ ($order->status == 1) ? 'text-green-500' : 'text-yellow-600' }}">
                            {{ $order->statusMsg }}</div>
                        <div
                            class="item-progress {{ ($order->progress == 0) ? 'text-yellow-600' : '' }} {{ ($order->progress == 1) ? 'text-blue-600' : '' }} {{ ($order->progress == 2) ? 'text-green-500' : '' }}">
                            {{ $order->progressMsg }}
                        </div>
                    </div>

                    @endforeach
                </div>
            </div>

            <div class="last-payments">
                <h3>Latest Payments</h3>

                <div class="payhead">
                    <div class="item-order">Order</div>
                    <div class="item-transaction">Transaction</div>
                    <div class="item-amount">Amount</div>
                    <div class="item-date">Date</div>
                </div>

                <div class="shortlist">
                    @foreach($latestPayments as $key => $pay)
                    <div class="payitem">
                        <div class="item-order">{{ $key + 1 .". ". $pay->transaction->order->serial }}</div>
                        <div class="item-transaction">{{ $pay->TransactionCode }}</div>
                        <div class="item-amount">{{ number_format($pay->transaction->Amount , 0 , "",",")  }} Ksh.</div>
                        <div class="item-date">{{ date('jS M Y', strtotime($pay->created_at)) }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>