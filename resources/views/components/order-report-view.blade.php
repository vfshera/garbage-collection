<div class="report-wrapper">



    <div class="report">
        <div class="reporthead">
            <h1>{{ $reportType }}</h1>


            <h2> Viewing As {{ Auth::user()->name }}</h2>

            <span>{{ date('H:i - jS M Y' , strtotime(now())) }}</span>

        </div>

        <div class="report-items">


            @foreach($orders as $order)
            <div class="report-item">

                <div class="report-item-serial">
                    <span>
                        ID : {{ $order->serial}}
                    </span>
                    <span class="">
                        @admin
                        CUSTOMER : {{ $order->user->name }}
                        @endadmin
                    </span>
                </div>

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