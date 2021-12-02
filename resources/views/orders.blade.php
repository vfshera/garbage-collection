<x-app-layout>

    <div class="orders-page">
        <header>
            <h1>Orders</h1>
            <button id="newOrder" onclick="openModal('#addModal')">New Order</button>
        </header>

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

                <div class="unit-cost">
                    COST / KG
                </div>

                <div class="total-cost">
                    TOTAL
                </div>

                <div class="status">
                    STATUS
                </div>

                <div class="actions">ACTIONS</div>

            </div>

            <div class="orders-list">
                @foreach($orders as $key => $order)

                <div class="order">
                    <div class="serial">
                        {{ strtoupper(dechex(date('U' ,strtotime($order->created_at)))) }}
                    </div>

                    <div class="waste">
                        {{ $order->waste->title}}
                    </div>

                    <div class="weight">
                        {{ $order->weight }} KG(s)

                    </div>

                    <div class="unit-cost">
                        {{ $order->waste->cost }} Ksh.

                    </div>

                    <div class="total-cost">
                        {{ $order->cost }} Ksh.

                    </div>

                    <div class="status">
                        {{ ($order->status == 1) ? "Active" : "Pending" }}

                    </div>

                    <div class="actions">
                        <button class="edit"><i class="fa fa-edit"></i></button>

                        <button class="show"><i class="fa fa-eye"></i></button>


                        <form action="" method="POST">
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
    </div>


    <!-- PAGE MODALS -->
    <x-slot name="modals">

        <div id="viewModal" class="modal">

            <div id="wasteModal" class="modal-content">
                <header>
                    <h2 id="headTitle"></h2>
                    <span id="closeIcon" onclick="closeModal('#viewModal')" class="cursor-pointer">&times;</span>
                </header>

                <div class="info">
                    <p>Cost Per KG : <span id="viewCost"></span></p>

                    <div id="wasteExamples" class="waste-includes">

                    </div>
                </div>

            </div>

        </div>




        <div id="editModal" class="modal">

            <div id="orderModal" class="modal-content">
                <header>
                    <h2>Edit Waste</h2>
                    <span id="closeIcon" onclick="closeModal('#editModal')" class="cursor-pointer">&times;</span>
                </header>

                <form action="{{ route('waste.update')}}" method="POST">
                    @csrf

                    @method('PUT')
                    <input id="id" type="text" name="id" hidden>

                    <div class="input-group">
                        <label for="edit-title">Title</label>
                        <input id="edit-title" class="block mt-1 w-full" type="text" name="title" :value="old('title')"
                            placeholder="Title of waste..." required autofocus />
                    </div>
                    <div class="input-group">
                        <label for="edit-cost" value="{{ __('') }}">Cost / KG</label>
                        <input id="edit-cost" class="block mt-1 w-full" type="number"
                            placeholder="Cost of waste per KG..." step="1" min="10" name="cost" :value="old('cost')"
                            required />
                    </div>
                    <div class="input-group">
                        <label for="edit-description">Description</label>
                        <textarea id="edit-description" rows="5" class="block mt-1 w-full" type="text"
                            name="description" :value="old('description')" placeholder="Describe the type of waste..."
                            required></textarea>
                    </div>


                    <div class="buttons">
                        <button class="btn-success" type="submit">Update</button>
                    </div>
                </form>
            </div>

        </div>

        <div id="addModal" class="modal">

            <div id="orderModal" class="modal-content">
                <header>
                    <h2>Add New Order</h2>
                    <span id="closeIcon" onclick="closeModal('#addModal')" class="cursor-pointer">&times;</span>
                </header>
                <form action="{{ route('order.store')}}" method="POST">
                    @csrf
                    <div class="input-group">
                        <label for="waste_id">Type Of Waste</label>

                        <select name="waste_id" id="waste_id" required>
                            <option value="" disabled selected>Choose Type Of Waste...</option>

                            @foreach($wastes as $waste)
                            <option value="{{ $waste->id }}">{{ $waste->title }}</option>
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
                        <input type="datetime-local" name="pickup" id="pickup" required>
                    </div>


                    <div class="buttons">
                        <button class="btn-success" type="submit">Create Order</button>
                        <button id="closeBtn" onclick="closeModal('#addModal')" class="btn-cancel">Cancel</button>
                    </div>
                </form>
            </div>

        </div>

    </x-slot>

    <x-slot name="pagescripts">
        <script>
        const closeModal = (modal) => {
            console.log('CLOSE');
            document.querySelector(modal).style.display = "none";
        }


        const openModal = (modal) => {
            document.querySelector(modal).style.display = "block";
        }



        // EDIT MODAL
        var id = document.querySelector("#id");
        var title = document.querySelector("#edit-title");
        var cost = document.querySelector("#edit-cost");
        var desc = document.querySelector("#edit-description");


        const edit = (waste, modal) => {
            openModal(modal);

            id.value = waste.id
            title.value = waste.title
            cost.value = waste.cost
            desc.value = waste.description.replace(/(\r\n|\n|\r)/gm, "")

        }

        //VIEW MODAL
        var headTitle = document.querySelector("#headTitle");
        var viewCost = document.querySelector("#viewCost");
        var examplesContainer = document.querySelector("#wasteExamples");

        const view = (waste, modal) => {
            openModal(modal);

            headTitle.innerText = waste.title + " Waste";
            viewCost.innerText = waste.cost + "Ksh."




            const wasteExamples = waste.description.replace(/(\r\n|\n|\r)/gm, "").split(",");

            wasteExamples.forEach(include => {
                const includeExample = document.createElement("div");
                includeExample.classList.add("include-example");


                includeExample.innerText = include.trim().toLowerCase();
                examplesContainer.appendChild(includeExample);
            });



        }







        // CREATE MODAL
        </script>
    </x-slot>


</x-app-layout>