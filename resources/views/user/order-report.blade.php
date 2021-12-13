<x-app-layout>
    <div class="report-page">
        <header>
            <h1>{{ $reportType }}</h1>

            <div class="options">
                <a class="bg-brand-7" href="{{ route('user.order.report') }}">All</a>
                <a class="bg-brand-7" href="{{ route('user.order.report', ['status' => 0]) }}">Unpaid</a>
                <a class="bg-brand-7" href="{{ route('user.order.report', ['status' => 1]) }}">Paid</a>


                <button class="btn-success" onclick="openModal('#orderReport')">Set Creteria</button>

                <a href="/" class="bg-blue-600 btn-pdf">Get PDF</a>
            </div>
        </header>



        <x-order-report-view :reportType="$reportType" :orders="$orders" />


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