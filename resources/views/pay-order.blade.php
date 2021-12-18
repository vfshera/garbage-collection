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

                    <p>{{ number_format($order->weight, 0 , "",",")  }} KG(s)</p>


                </div>

                <div class="unit-cost">
                    <label for="">Cost Per KG</label>

                    <p>{{  number_format($order->waste->cost, 0 , "",",") }} Ksh.</p>


                </div>




            </div>

            <div class="order-summary">
                <div class="summary">
                    <label>Total</label>
                    <p>{{ number_format($order->cost , 0 , "",",") }} Ksh.</p>
                </div>

                @if(Auth::user()->phone != "")
                <form id="payingForm"
                    action="{{ $order->progress == 0 ? route('user.order.pay' , ['order' => $order->id ])  : '' }}"
                    method="POST">

                    @csrf
                    <div class="paying-number">

                        <p> {{ $order->progress == 0 ? "Paying with" : "Paid with" }}</p>

                        <img src="{{ url('storage/images/mpesa.png')}}" alt="mpesa local logo">


                    </div>

                    <div class="btn-num">

                        <span id="displayNum">
                            +{{ Auth::user()->phone }}
                        </span>

                        <input type="number" name="altPay" id="altPay" hidden>

                        @if ($order->progress == 0)

                        <button>Pay Now</button>

                        @else

                        <div class="transaction-code">
                            {{ ($order->transaction->payment) ? $order->transaction->payment->TransactionCode : "TRANSACTIONCODE" }}
                        </div>

                        @endif

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









    <!-- PAGE MODALS -->
    <x-slot name="modals">

        @user
        <div id="addNumber" class="modal">

            <div id="altNumModal" class="modal-content">
                <header>
                    <h2>Alternative Number</h2>
                    <span id="closeIcon" onclick="closeModal('#addNumber')" class="cursor-pointer">&times;</span>
                </header>

                <div class="new-num">
                    <div class="input-group">
                        <label for="alt-num">Pay With</label>
                        <input id="alt-num" class="block mt-1 w-full" type="number" placeholder="2547XXXXXXXX" step="1"
                            min="10" name="alt-num" required />
                    </div>

                    <button id="addAltNum" type="button" onclick="useAlt()" class="btn-success">Pay With This
                        Number</button>
                </div>

            </div>

        </div>
        @enduser


    </x-slot>



    <x-slot name="pagescripts">
        <script>
        const closeModal = (modal) => {
            document.querySelector(modal).style.display = "none";
        }

        const changeNum = (e) => {
            document.querySelector('#addNumber').style.display = "block";
        }

        const useAlt = () => {

            const newNum = document.querySelector('#alt-num');
            const disNum = document.querySelector('#displayNum');
            const sentInput = document.querySelector('#altPay');
            const payForm = document.querySelector('#payingForm');

            const numReg = /^254\d{9}$/g;

            if (numReg.test(newNum.value)) {

                disNum.innerText = "+" + newNum.value;
                sentInput.value = newNum.value;

                payForm.submit();

            } else {

                alert("Invalid Phone Number!")

            }
        }
        </script>
    </x-slot>


</x-app-layout>