<x-app-layout>
    <div class="location-page">
        <h1>Location</h1>

        <section class="details">

            <div class="disclaimer">
                Please keep the information below up-to date so to enable us reach you.
            </div>


            <form action="">

                <div class="fields">

                    <div class="input-group">
                        <label for="phone">Mobile Phone Number</label>
                        <input id="phone" class="block mt-1 w-full" type="text"
                            placeholder="Enter your mobile number..." name="phone" value="{{ $user->phone }}"
                            required />
                    </div>

                    <div class="input-group">
                        <label for="county">County</label>
                        <input id="county" class="block mt-1 w-full" type="text"
                            placeholder="Enter your county of residence..." name="county" value="{{ $user->county }}"
                            required />
                    </div>


                    <div class="input-group">
                        <label for="constituency">Constituency</label>
                        <input id="constituency" class="block mt-1 w-full" type="text"
                            placeholder="Enter your constituency name..." name="constituency"
                            value="{{ $user->constituency }}" required />
                    </div>


                    <div class="input-group">
                        <label for="town">Town</label>
                        <input id="town" class="block mt-1 w-full" type="text" placeholder="Enter your town name..."
                            name="town" value="{{ $user->town }}" required />
                    </div>


                    <div class="input-group">
                        <label for="ward">Ward</label>
                        <input id="ward" class="block mt-1 w-full" type="text" placeholder="Enter your ward name..."
                            name="ward" value="{{ $user->ward }}" required />
                    </div>


                    <div class="input-group">
                        <label for="edit-description">Village</label>
                        <input id="village" class="block mt-1 w-full" type="text"
                            placeholder="Enter your village name..." name="village" value="{{ $user->village }}"
                            required />
                    </div>


                    <div class="input-group">
                        <label for="postal_code">Postal Code</label>
                        <input id="postal_code" class="block mt-1 w-full" type="text"
                            placeholder="Enter your postal code..." name="postal_code" value="{{ $user->postal_code }}"
                            required />
                    </div>

                    <div class="input-group">
                        <label for="address">Address</label>
                        <input id="address" class="block mt-1 w-full" type="text" placeholder="Enter your address..."
                            name="address" value="{{ $user->address }}" required />
                    </div>
                </div>


                <div class="buttons">
                    <button class="btn-success" type="submit">Update</button>
                </div>
            </form>


        </section>
    </div>
</x-app-layout>