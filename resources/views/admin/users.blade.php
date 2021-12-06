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
                <div class="user">
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
</x-app-layout>