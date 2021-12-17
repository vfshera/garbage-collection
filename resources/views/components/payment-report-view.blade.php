<div class="report-wrapper">



    <div class="report">
        <div class="reporthead">
            <h1>Payment Report</h1>


            <h2>{{ Auth::user()->name }}</h2>

            <span>{{ date('H:i - jS M Y' , strtotime(now())) }}</span>

        </div>

        <div class="report-items">

            @foreach($payments as $pay)
            <div class="report-item">

                <div class="report-item-serial">
                    <span>
                        TRANS ID : {{ $pay->TransID}}
                    </span>
                    <span>
                        @admin
                        CUSTOMER : {{ strtoupper($pay->order->user->name) }}
                        @endadmin
                    </span>
                </div>

                <div class="report-data">
                    <div class="details">

                        <div class="detail">
                            <p class="label">Amount</p>
                            <p class="value"> {{ number_format($pay->TransAmount, 0 , "",",")  }} KG(s)</p>
                        </div>


                        <div class="detail">
                            <p class="label">Payment Date</p>
                            <p class="value">
                                {{ date('H:i - jS M Y' , strtotime($pay->created_at))  }}
                            </p>
                        </div>


                        <div class="detail">
                            <p class="label">Holders Name</p>
                            <p class="value">
                                {{ $pay->FirstName." ".$pay->MiddleName  }}
                            </p>
                        </div>


                    </div>



                    <div class="details">
                        <div class="detail">
                            <p class="label">Waste</p>
                            <p class="value">{{ $pay->order->waste->title }}</p>
                        </div>

                        <div class="detail">
                            <p class="label">Order ID</p>
                            <p class="value">{{ $pay->order->serial }}</p>
                        </div>


                        <div class="detail">
                            <p class="label">Order Date</p>
                            <p class="value">
                                {{  date('H:i - jS M Y' , strtotime($pay->order->created_at))  }}
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            @endforeach
        </div>



    </div>



</div>