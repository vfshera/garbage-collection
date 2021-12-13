<x-app-layout>
    <div class="report-page">
        <header>
            <h1>{{ $reportType }}</h1>

            <div class="options">
                <a href="{{ route('user.order.report') }}">All</a>
                <a href="{{ route('user.order.report', ['status' => 0]) }}">Unpaid</a>
                <a href="{{ route('user.order.report', ['status' => 1]) }}">Paid</a>


                <button class="btn-success" onclick="openModal('#orderReport')">Set Creteria</button>
            </div>
        </header>



        <div class="report-wrapper">



            <div class="report">
                <div class="reporthead">
                    <h1>{{ $reportType }}</h1>


                    <h2>{{ Auth::user()->name }}</h2>

                    <span>{{ date('H:i - jS M Y' , strtotime(now())) }}</span>

                </div>

                <div class="report-items">


                    @foreach($orders as $order)
                    <div class="report-item">

                        <div class="report-item-serial">ID : {{ $order->serial}}</div>

                        <div class="report-data">
                            <div class="details">
                                <div class="detail">
                                    <p class="label">Waste</p>
                                    <p class="value"> {{ $order->waste->title }} </p>
                                </div>

                                <div class="detail">
                                    <p class="label">Weight</p>
                                    <p class="value"> {{ number_format($order->weight, 0 , "",",")  }} KG(s)</p>
                                </div>


                                <div class="detail">
                                    <p class="label">Cost</p>
                                    <p class="value">{{ number_format($order->cost , 0 , "",",")  }} Ksh.</p>
                                </div>
                            </div>

                            <div class="details">
                                <div class="detail">
                                    <p class="label">Pickup Date</p>
                                    <p class="value">{{ date('jS M Y' , strtotime($order->pickup )) }}</p>
                                </div>

                                <div class="detail">
                                    <p class="label">Status</p>
                                    <p class="value">{{ ($order->status == 1) ? "Paid" : "Unpaid" }}</p>
                                </div>


                                <div class="detail">
                                    <p class="label">Progress</p>
                                    <p class="value">
                                        @if($order->progress == 0)
                                        N/A
                                        @endif

                                        @if($order->progress == 1)
                                        In Transit
                                        @endif

                                        @if($order->progress == 2)
                                        Completed
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="details">
                                <div class="detail">
                                    <p class="label">Order Date</p>
                                    <p class="value">{{ date('jS M Y' , strtotime($order->created_at)) }}</p>
                                </div>

                                <div class="detail">
                                    <p class="label">Transaction ID</p>
                                    <p class="value">{{ ($order->payment) ? $order->payment->TransID : "N/A" }}</p>
                                </div>


                                <div class="detail">
                                    <p class="label">Payment Date</p>
                                    <p class="value">
                                        {{ ($order->payment) ? date('H:i - jS M Y' , strtotime($order->payment->created_at)) : "N/A" }}
                                    </p>
                                </div>
                            </div>
                        </div>

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
                <form action="{{ route('user.order.report') }}" method="POST">

                    @csrf
                    <div class="input-group">
                        <label for="from">From</label>
                        <input type="date" name="from" placeholder="Start Date" id="from">
                    </div>
                    <div class="input-group">
                        <label for="to">To</label>
                        <input type="date" name="to" max="{{ date('Y-m-d' , strtotime(now())) }}" value=""
                            placeholder="End Date" id="to">
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

                <form action="" method="POST">

                    @csrf
                    <div class="input-group">
                        <label for="from">From</label>
                        <input type="date" name="from" id="from">
                    </div>
                    <div class="input-group">
                        <label for="to">To</label>
                        <input type="date" name="to" max="{{ date('Y-m-d' , strtotime(now())) }}" value="" id="to">
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