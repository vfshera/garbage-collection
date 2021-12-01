<x-app-layout>

    <div class="waste-page">
        <header>
            <h1>Types of Waste</h1>
            <button id="newWaste" onclick="openModal('#addModal')">New Waste</button>
        </header>

        <section class="wastes">

            <div class="wastes-header">

                <div class="title">
                    TITLE
                </div>

                <div class="cost">
                    COST PER KG
                </div>

                <div class="action">ACTIONS</div>

            </div>

            <div class="wastes-list">
                @foreach($wastes as $key => $waste)

                <div class="waste">
                    <div class="title">
                        {{ $key + 1 }}. {{ $waste->title }}
                    </div>

                    <div class="cost">
                        {{ $waste->cost }} Ksh.

                    </div>

                    <div class="actions">
                        <button onclick="edit({{ $waste }} , '#editModal')" class="edit"><i
                                class="fa fa-edit"></i></button>

                        <button class="show" onclick="view({{ $waste }} , '#viewModal')"><i
                                class="fa fa-eye"></i></button>


                        <form action="{{ route('waste.destroy',['waste' => $waste->id]) }}" method="POST">
                            @csrf

                            @method('DELETE')
                            <button type="submit" class="delete"><i class="fa fa-trash"></i></button>

                        </form>
                    </div>
                </div>

                @endforeach

                <div class="paginator">
                    {{ $wastes->links() }}
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

            <div id="wasteModal" class="modal-content">
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

            <div id="wasteModal" class="modal-content">
                <header>
                    <h2>Add New Type Of Waste</h2>
                    <span id="closeIcon" onclick="closeModal('#addModal')" class="cursor-pointer">&times;</span>
                </header>
                <form action="{{ route('waste.store')}}" method="POST">
                    @csrf
                    <div class="input-group">
                        <label for="title">Title</label>
                        <input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')"
                            placeholder="Title of waste..." required autofocus />
                    </div>
                    <div class="input-group">
                        <label for="cost" value="{{ __('') }}">Cost / KG</label>
                        <input id="cost" class="block mt-1 w-full" type="number" placeholder="Cost of waste per KG..."
                            step="1" min="10" name="cost" :value="old('cost')" required />
                    </div>
                    <div class="input-group">
                        <label for="description">Description</label>
                        <textarea id="description" rows="5" class="block mt-1 w-full" type="text" name="description"
                            :value="old('description')" placeholder="Describe the type of waste..." required></textarea>
                    </div>


                    <div class="buttons">
                        <button class="btn-success" type="submit">Add</button>
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