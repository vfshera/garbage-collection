<x-app-layout>
    <div class="report-page">
        <header>
            <h1>{{ $reportType }}</h1>

            <div class="options">
                <a class="bg-brand-7" href="{{ route('admin.report.order') }}">All</a>
                <a class="bg-brand-7" href="{{ route('admin.report.order-bound', ['status' => 0]) }}">Unpaid</a>
                <a class="bg-brand-7" href="{{ route('admin.report.order-bound', ['status' => 1]) }}">Paid</a>


                <button class="btn-success" onclick="openModal('#orderReport')">Set Creteria</button>





            </div>
        </header>



        @if(isset($orders) && count($orders) > 0)

        <x-order-report-view :reportType="$reportType" :orders="$orders" />

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

        <!-- ORDER MODAL -->
        <div id="orderReport" class="modal">

            <div id="reportModal" class="modal-content">

                <h1>Order Report</h1>
                <form action="{{ route('admin.report.order-bound') }}" method="POST">

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
                    <div class="input-group">
                        <label for="forUser">By User</label>
                        <select name="forUser" id="forUser" value="">
                            <option value="" selected disabled>Choose User</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
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