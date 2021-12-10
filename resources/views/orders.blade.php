<x-app-layout>

    <div class="orders-page">


        <header>
            <h1>Orders</h1>

            <section>

                <div class="filters">
                    <a href="{{ Auth::user()->role === '1' ? route('admin.orders') : route('user.orders') }}">All
                        Orders</a>
                    <a
                        href="{{ Auth::user()->role === '1' ? route('admin.orders', ['status' => 0]) : route('user.orders', ['status' => 0]) }}">Unpaid
                        Orders</a>
                    <a
                        href="{{ Auth::user()->role === '1' ? route('admin.orders' , ['status' => 1]) : route('user.orders' , ['status' => 1]) }}">Paid
                        Orders</a>
                </div>

                @if(Auth::user()->role == 0)
                <button id="newOrder" onclick="openModal('#addModal')">New Order</button>
                @endif

            </section>

        </header>

        @if(count($orders) == 0)
        <div class="no-data">

            @admin
            <p>No Orders Matching The Query!</p>
            @endadmin

            @user
            <p>You Have no Orders Yet!</p>
            <button id="newOrder" onclick="openModal('#addModal')">Create Your First Order!</button>
            @enduser
        </div>
        @else

        <section class="orders">

            <div class="orders-header">

                <div class="serial">
                    SERIAL
                </div>

                <div class="waste">
                    WASTE
                </div>

                <div class="weight">
                    WEIGHT
                </div>


                <div class="total-cost">
                    TOTAL
                </div>



                <div class="status">
                    STATUS
                </div>

                <div class="progress">
                    PROGRESS
                </div>

                <div class="actions">ACTIONS</div>

            </div>

            <div class="orders-list">
                @foreach($orders as $key => $order)

                <div class="order">
                    <div class="serial">
                        {{ $key + 1}}. {{ $order->serial }}
                    </div>

                    <div class="waste">
                        {{ $order->waste->title}}
                    </div>

                    <div class="weight">
                        {{ number_format($order->weight, 0 , "",",")  }} KG(s)

                    </div>


                    <div class="total-cost">
                        {{ number_format($order->cost , 0 , "",",")  }} Ksh.

                    </div>

                    <div class="status {{ ($order->status == 1) ? 'text-green-500' : 'text-yellow-600' }}">

                        {{ ($order->status == 1) ? "Paid" : "Unpaid" }}

                    </div>

                    <div
                        class="progress {{ ($order->progress == 0) ? 'text-yellow-600' : '' }} {{ ($order->progress == 1) ? 'text-blue-600' : '' }} {{ ($order->progress == 2) ? 'text-green-500' : '' }}">
                        @if($order->progress == 0)
                        N/A
                        @endif

                        @if($order->progress == 1)
                        In Transit
                        @endif

                        @if($order->progress == 2)
                        Completed
                        @endif
                    </div>

                    <div class="actions">

                        <button class="show" onclick="view({{ $order }},'#viewModal')"><i
                                class="fa fa-eye"></i></button>


                        <form action="{{ route('user.order.destroy' , [$order]) }}" method="POST">
                            @csrf

                            @method('DELETE')
                            <button type="submit" class="delete"><i class="fa fa-trash"></i></button>

                        </form>
                    </div>
                </div>

                @endforeach

                <div class="paginator">
                    {{ $orders->links() }}
                </div>
            </div>
        </section>
        @endif
    </div>


    <!-- PAGE MODALS -->
    <x-slot name="modals">

        <div id="viewModal" class="modal">

            <div id="orderModal" class="modal-content">
                <header>
                    <h2 id="viewHeadTitle"></h2>
                    <span id="closeIcon" onclick="closeModal('#viewModal')" class="cursor-pointer">&times;</span>
                </header>

                <div id="infoContainer" class="info">

                    @admin
                    <div class="info-item">
                        <p id="viewLabel">Customer</p>
                        <p id="viewCustomer"></p>
                    </div>
                    @endadmin


                    <div class="info-item">
                        <p id="viewLabel">Waste</p>
                        <p id="viewWasteValue"></p>
                    </div>


                    <div class="info-item">
                        <p id="viewLabel">Weight</p>
                        <p id="viewWeightValue"></p>
                    </div>



                    <div class="info-item">
                        <p id="viewLabel">Cost per KG</p>
                        <p id="viewPerKGValue"></p>
                    </div>



                    <div class="info-item">
                        <p id="viewLabel">Total</p>
                        <p id="viewTotalValue"></p>
                    </div>


                    <div class="info-item">
                        <p id="viewLabel">Status</p>
                        <p id="viewStatusValue"></p>
                    </div>


                    <div class="info-item">
                        <p id="viewLabel">Created On</p>
                        <p id="viewCreatedValue"></p>
                    </div>






                </div>
                @user

                <div id="pay-for-order" class="pay-for-order">

                </div>

                @enduser

            </div>

        </div>


        @user
        <div id="addModal" class="modal">

            <div id="orderModal" class="modal-content">
                <header>
                    <h2>Add New Order</h2>
                    <span id="closeIcon" onclick="closeModal('#addModal')" class="cursor-pointer">&times;</span>
                </header>
                <form action="{{ route('user.order.store') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <label for="waste_id">Type Of Waste</label>

                        <select name="waste_id" id="waste_id" required>
                            <option value="" disabled selected>Choose Type Of Waste...</option>

                            @foreach($wastes as $waste)
                            <option value="{{ $waste->id }}">{{ $waste->title }} <span class="ml-2 text-gray-500">@
                                    ({{ $waste->cost }}
                                    Ksh.)</span></option>
                            @endforeach

                        </select>


                    </div>
                    <div class="input-group">
                        <label for="weight">WEIGHT</label>
                        <input id="weight" class="block mt-1 w-full" type="number"
                            placeholder="Weight of waste in KG..." step="1" min="10" name="weight" :value="old('cost')"
                            required />
                    </div>
                    <div class="input-group">
                        <label for="pickup">Pickup Date</label>
                        <input type="date" name="pickup" id="pickup" required>
                    </div>


                    <div class="buttons">
                        <button class="btn-success" type="submit">Create Order</button>
                        <button id="closeBtn" onclick="closeModal('#addModal')" class="btn-cancel">Cancel</button>
                    </div>
                </form>
            </div>

        </div>
        @enduser
    </x-slot>

    <x-slot name="pagescripts">
        <script>
        const closeModal = (modal) => {

            document.querySelector(modal).style.display = "none";
        }


        const openModal = (modal) => {
            document.querySelector(modal).style.display = "block";
        }

        //VIEW MODAL
        var viewHeadTitle = document.querySelector("#viewHeadTitle");
        var infoCont = document.querySelector("#infoContainer");
        const viewWaste = document.querySelector("#viewWasteValue");
        const viewWeight = document.querySelector("#viewWeightValue");
        const viewPerKG = document.querySelector("#viewPerKGValue");
        const viewTotal = document.querySelector("#viewTotalValue");
        const viewStatus = document.querySelector("#viewStatusValue");
        const viewCreated = document.querySelector("#viewCreatedValue");
        const payDiv = document.querySelector("#pay-for-order");

        const view = (order, modal) => {
            openModal(modal);

            console.log(order);

            if (order.user.id) {

                document.querySelector("#viewCustomer").innerText = order.user.name;

            }


            viewHeadTitle.innerText = "Order " + order.serial;

            viewWaste.innerText = order.waste.title;

            viewWeight.innerText = order.weight + "KG(s)";

            viewPerKG.innerText = order.waste.cost + " Ksh.";

            viewTotal.innerText = order.cost + " Ksh.";

            viewStatus.innerText = (order.status == '1') ? "Paid" : "Unpaid";

            viewCreated.innerText = order.created;


            //PAYMENT BTN
            //  check if exists
            if (payDiv) {

                const oldATag = document.querySelector("#payLink");

                if (oldATag) {
                    payDiv.removeChild(oldATag);
                }

                const aTag = document.createElement("a");

                aTag.classList.add("pay-link");
                aTag.id = "payLink";

                aTag.href = `/user/order/${order.id}/payment`;

                aTag.innerText = (order.status == 0) ? "Go To Payment" : "View Payment";

                payDiv.appendChild(aTag);
            }


        }
        </script>
    </x-slot>


</x-app-layout>