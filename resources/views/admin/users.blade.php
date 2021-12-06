<x-app-layout>
    <div class="users-page">
        <header>
            <h1>Users</h1>
        </header>

        <section class="users">

            <div class="caption">
                <div class="name">
                    NAME
                </div>
                <div class="email">
                    EMAIL
                </div>
                <div class="joined">
                    JOINED
                </div>
            </div>

            <div class="users-list">
                @foreach($users as $key => $normalUser)
                <div class="user" onclick="view({{ $normalUser }},'#viewModal')">
                    <div class="name">
                        {{ $key + 1 }}. {{ $normalUser->name }}
                    </div>
                    <div class="email">
                        {{ $normalUser->email }}

                    </div>
                    <div class="joined">
                        {{ date('H:s \- jS M Y ', strtotime($normalUser->created_at)) }}

                    </div>
                </div>
                @endforeach
            </div>

        </section>

        <div class="pages">
            {{ $users->links() }}
        </div>
    </div>


    <!-- PAGE MODALS -->
    <x-slot name="modals">
        <div id="viewModal" class="modal">

            <div id="userInfoModal" class="modal-content">
                <header>
                    <h2 id="viewHeadTitle"></h2>
                    <span id="closeIcon" onclick="closeModal('#viewModal')" class="cursor-pointer">&times;</span>
                </header>

                <div id="infoContainer" class="info">

                    <div class="info-item">
                        <p id="viewLabel">Email</p>
                        <p id="viewEmail"></p>
                    </div>


                    <div class="info-item">
                        <p id="viewLabel">Phone</p>
                        <p id="viewPhone"></p>
                    </div>


                    <div class="info-item">
                        <p id="viewLabel">Postal</p>
                        <p id="viewPostal"></p>
                    </div>


                    <div class="info-item">
                        <p id="viewLabel">Address</p>
                        <p id="viewAddress"></p>
                    </div>


                    <div class="info-item">
                        <p id="viewLabel">County</p>
                        <p id="viewCounty"></p>
                    </div>


                    <div class="info-item">
                        <p id="viewLabel">Constituency</p>
                        <p id="viewConstituency"></p>
                    </div>


                    <div class="info-item">
                        <p id="viewLabel">Village</p>
                        <p id="viewVillage"></p>
                    </div>


                    <div class="info-item">
                        <p id="viewLabel">Ward</p>
                        <p id="viewWard"></p>
                    </div>


                    <div class="info-item">
                        <p id="viewLabel">Town</p>
                        <p id="viewTown"></p>
                    </div>

                </div>


            </div>

        </div>

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

        const view = (user, modal) => {
            openModal(modal);

            console.log(user);


            viewHeadTitle.innerText = user.name;

            document.querySelector("#viewEmail").innerText = user.email;

            document.querySelector("#viewPhone").innerText = user.phone;

            document.querySelector("#viewPostal").innerText = user.postal_code;

            document.querySelector("#viewAddress").innerText = user.address;

            document.querySelector("#viewCounty").innerText = user.county;

            document.querySelector("#viewConstituency").innerText = user.constituency;

            document.querySelector("#viewVillage").innerText = user.village;

            document.querySelector("#viewWard").innerText = user.ward;

            document.querySelector("#viewTown").innerText = user.town;

        }
        </script>
    </x-slot>

</x-app-layout>