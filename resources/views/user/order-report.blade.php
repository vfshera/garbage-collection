<x-app-layout>
    <div class="report-page">
        <header>
            <h1>{{ $reportType }}</h1>

            <div class="options">
                <a class="bg-brand-7" href="{{ route('user.report.order') }}">All</a>
                <a class="bg-brand-7" href="{{ route('user.report.order', ['status' => 0]) }}">Unpaid</a>
                <a class="bg-brand-7" href="{{ route('user.report.order', ['status' => 1]) }}">Paid</a>


                <button class="btn-success" onclick="openModal('#orderReport')">Set Creteria</button>


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
                <form action="{{ route('user.report.order') }}" method="POST">

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