<x-app-layout>
    <div class="report-page">
        <header>
            <h1>Payment Report</h1>

            <div class="options">
                <a class="bg-brand-7" href="{{ route('user.report.payment') }}">All</a>


                <button class="btn-success" onclick="openModal('#paymentReport')">Set Creteria</button>

            </div>
        </header>


        @if(isset($payments) && count($payments) > 0)

        <x-payment-report-view :payments="$payments" />

        @else
        <div class="no-content-wrapper">
            <div class="no-content ">
                No Content For This Report
            </div>
        </div>
        @endif
    </div>






    <!-- PAGE MODALS -->
    <x-slot name="modals">



        <!-- PAYMENT MODAL -->
        <div id="paymentReport" class="modal">

            <div id="paymentModal" class="modal-content">
                <h1>Payment Report</h1>

                <form action="{{ route('user.report.payment-bound') }}" method="POST">

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