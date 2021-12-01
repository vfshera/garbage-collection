<x-app-layout>

    <div class="waste-page">
        <header>
            <h1>Types of Waste</h1>
            <button id="newWaste">New Waste</button>
        </header>

        <section class="wastes">

            <div class="wastes-header">

                <div class="title">
                    TITLE
                </div>

                <div class="cost">
                    COST
                </div>

                <div class="action">%</div>

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

                    <div class="action">%</div>
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

        <div class="modal">

            <div id="wasteModal" class="modal-content">
                <h2>Add New Type Of Waste</h2>
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
                            step="0.1" name="cost" :value="old('cost')" required />
                    </div>
                    <div class="input-group">
                        <label for="description">Description</label>
                        <textarea id="description" class="block mt-1 w-full" type="text" name="description"
                            :value="old('description')" placeholder="Describe the type of waste..." required></textarea>
                    </div>


                    <div class="buttons">
                        <button class="btn-success" type="submit">Add</button>
                        <button id="closeModal" class="btn-cancel">Cancel</button>
                    </div>
                </form>
            </div>

        </div>

    </x-slot>

    <x-slot name="pagescripts">
        <script>
        var modal = document.querySelector(".modal");

        var closeBtn = document.querySelector("#closeModal");


        var openBtn = document.getElementById("newWaste");


        openBtn.onclick = function() {
            modal.style.display = "block";
        }


        closeBtn.onclick = function() {
            modal.style.display = "none";
        }
        </script>
    </x-slot>


</x-app-layout>