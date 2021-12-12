<x-app-layout>
    <div class="user-dash">
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
                        Spent
                    </p>

                </div>
            </div>

            <div class="reports">

                <div class="report" onclick="openModal('#orderReport')">
                    Orders
                    Report
                </div>


                <div class="report" onclick="openModal('#paymentReport')">
                    Payment
                    Report
                </div>


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

                    <a href="{{ route('user.order.payment',[$order]) }}">
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
                                {{ ($order->status == 1) ? "Paid" : "Unpaid" }}</div>
                            <div
                                class="item-progress {{ ($order->progress == 0) ? 'text-yellow-600' : '' }} {{ ($order->progress == 1) ? 'text-blue-600' : '' }} {{ ($order->progress == 2) ? 'text-green-500' : '' }}">
                                @if($order->progress == 0)
                                N/A
                                @endif

                                @if($order->progress == 1)
                                In Transit
                                @endif

                                @if($order->progress == 2)
                                Completed
                                @endif</div>
                        </div>
                    </a>
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
                        <div class="item-order">{{ $key + 1 .". ". $pay->order->serial }}</div>
                        <div class="item-transaction">{{ $pay->TransID }}</div>
                        <div class="item-amount">{{ number_format($pay->TransAmount , 0 , "",",")  }} Ksh.</div>
                        <div class="item-date">{{ date('jS M Y', strtotime($pay->created_at)) }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>






    <!-- PAGE MODALS -->
    <x-slot name="modals">

        <!-- ORDER MODAL -->
        <div id="orderReport" class="modal">

            <div id="reportModal" class="modal-content">

                <h1>Order Report</h1>
                <form action="">
                    <div class="input-group">
                        <label for="from">From</label>
                        <input type="date" name="from" id="from" required>
                    </div>
                    <div class="input-group">
                        <label for="to">To</label>
                        <input type="date" name="to" id="to" required>
                    </div>
                    <button class="btn-success" type="submit">Get Report</button>
                </form>

                <span id="closeIcon" onclick="closeModal('#orderReport')" class="cursor-pointer">&times;</span>


            </div>

        </div>


        <!-- PAYMENT MODAL -->
        <div id="paymentReport" class="modal">

            <div id="paymentModal" class="modal-content">
                <h1>Payment Report</h1>

                <form action="">
                    <div class="input-group">
                        <label for="from">From</label>
                        <input type="date" name="from" id="from" required>
                    </div>
                    <div class="input-group">
                        <label for="to">To</label>
                        <input type="date" name="to" id="to" required>
                    </div>
                    <button type="submit" class="btn-success">Get Report</button>
                </form>

                <span id="closeIcon" onclick="closeModal('#paymentReport')" class="cursor-pointer">&times;</span>


            </div>

        </div>

    </x-slot>



    <!-- SCRIPTS -->
    <x-slot name="pagescripts">
        <script>
        const closeModal = (modal) => {

            document.querySelector(modal).style.display = "none";
        }


        const openModal = (modal) => {
            document.querySelector(modal).style.display = "block";
        }
        </script>
    </x-slot>
</x-app-layout>