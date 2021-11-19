<section class="navbar pgc-container">

   <div class="brand">{{ env('APP_NAME')}}</div>
    

   <nav>

   <div class="navigation">

   
    <li>
       <a href="{{ url('/home') }}" class="nav-link">Home</a>
    </li>    
    
    <li>
                <a href="{{ url('/home') }}" class="nav-link">Business</a>
</li>
                <li>
                <a href="{{ url('/home') }}" class="nav-link">Coverage</a>
</li>


   </div>

   @if (Route::has('login'))
        <div class="auth-routes">
            @auth
                <li>
                <a href="{{ url('/home') }}" class="nav-link">Home</a>
</li>
       
            @else
            <li>
                <a href="{{ route('login') }}" class="nav-link">Log in</a>
                </li>

                @if (Route::has('register'))
                <li>
                    <a href="{{ route('register') }}" class="nav-link">Register</a>
                    </li>
                @endif
            @endauth
        </div>
    @endif

   </nav>



</section>