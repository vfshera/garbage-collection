@extends('layouts.main')

@section('content')
<div class="welcome-page">
    <section class="hero">
        <div class="slides">

            <div class="slide current"
                style="background: url('https://picsum.photos/1920/720.webp?random=1') no-repeat center center/cover">
                <div class="content">
                    <h1>Slider One</h1>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Harum, obcaecati.</p>
                    <button>Learn More</button>
                </div>
            </div>

            <div class="slide"
                style="background: url('https://picsum.photos/1920/720.webp?random=2') no-repeat center center/cover">
                <div class="content">
                    <h1>Slider Two</h1>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Harum, obcaecati.</p>
                    <button>Learn More</button>
                </div>
            </div>

            <div class="slide"
                style="background: url('https://picsum.photos/1920/720.webp?random=3') no-repeat center center/cover">
                <div class="content">
                    <h1>Slider Three</h1>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Harum, obcaecati.</p>
                    <button>Learn More</button>
                </div>
            </div>

        </div>

        <div class="buttons">
            <button id="prev">
                <i class="fas fa-arrow-circle-left"></i>
            </button>

            <button id="next">
                <i class="fas fa-arrow-circle-right"></i>
            </button>
        </div>


    </section>


    <section id="services" class="services  pgc-container">

        <div class="services-options">


            <div class="service">
                <div class="service-image">
                    <img src="{{ url('storage/images/DUMP3.jpg') }}" alt="Residential Waste Image">
                </div>

                <div class="description">
                    <h3>Residential Waste Pickup</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur vitae atque soluta eaque
                        sint!
                        Sapiente?</p>
                    <a href="{{ route('user.orders') }}">Order This Service</a>
                </div>
            </div>


            <div class="service">
                <div class="service-image">
                    <img src="{{ url('storage/images/DUMP2.jpg') }}" alt="Business waste Image">
                </div>

                <div class="description">
                    <h3>Business Waste Pickup</h3>
                    <p> Pariatur vitae atque soluta.Lorem ipsum dolor sit amet, consectetur adipisicing elit. eaque
                        sint!
                        Sapiente?</p>
                    <a href="{{ route('user.orders') }}">Order This Service</a>
                </div>
            </div>

            <div class="service">
                <div class="service-image">
                    <img src="{{ url('storage/images/DUMP1.jpg') }}" alt="Dumpers Image">
                </div>

                <div class="description">
                    <h3>Dumpers</h3>
                    <p> Pariatur vitae atque soluta.Lorem ipsum dolor sit amet, consectetur adipisicing elit. eaque
                        sint!
                        Sapiente?</p>
                    <a href="{{ route('user.orders') }}">Order This Service</a>
                </div>
            </div>

        </div>

    </section>

    <section class="how-to-get-started pgc-container">
        <div class="instructions-wrapper">
            <div class="how-to-sign-up">
                <h3>Join in less than 10 minutes.</h3>
                <a href="{{ route('register') }}">Sign Up</a>
            </div>
            <div class="steps">
                <div class="step">
                    <i class="fas fa-signal"></i>
                    <p>Pay Bill Online</p>
                </div>



                <div class="step">
                    <i class="fas fa-algolia"></i>
                    <p>Paperless Billing</p>
                </div>


                <div class="step">
                    <i class="fas fa-recycle"></i>
                    <p>Automatic Payments</p>
                </div>


                <div class="step">
                    <i class="fas fa-calendar-alt"></i>
                    <p>Pickup Schedule</p>
                </div>


                <div class="step">
                    <i class="fas fa-truck-moving"></i>
                    <p>Request Pickup</p>
                </div>


            </div>
        </div>
    </section>


    <section id="contact" class="contact pgc-container">


        <form action="{{ route('post-question') }}" method="POST">

            @csrf

            <div class="questions-lead">

                <div class="title-box">
                    <h1>Have Questions?</h1>
                    <h2>Find Answers.</h2>
                </div>

                <p>Please provide your topic so we can trach and act on your request/question swiftly.</p>
                <div class="input-group">
                    <label for="topic">Topic</label>
                    <select name="topic" id="topic" value="" required>
                        <option value="" selected disabled>Choose Topic</option>
                        <option value="billing">Billing</option>
                        <option value="request">Request Service</option>
                        <option value="service">Service Question</option>
                        <option value="account">Account</option>
                        <option value="other">Other</option>
                    </select>
                </div>

            </div>

            <div class="form-content">
                <div class="input-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter your name..." required>
                </div>

                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email..." required>
                </div>


                <div class="input-group">
                    <label for="phone">Phone</label>
                    <input type="tel" name="phone" id="phone" placeholder="Enter your phone..." required>
                </div>



                <div class="input-group">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" placeholder="Type your message..." required>
                    </textarea>
                </div>

                <button type="submit">Send</button>
            </div>

        </form>
    </section>

</div>




@push('scripts')
<script>
const slides = document.querySelectorAll('.slide');
const prev = document.querySelector('#prev');
const next = document.querySelector('#next');

const autoScroll = true;
const slideInterval = 10000;


let intervalTimer;





next.addEventListener('click', () => {
    const current = document.querySelector('.current');

    current.classList.remove('current');


    if (current.nextElementSibling) {
        current.nextElementSibling.classList.add('current');
    } else {
        slides[0].classList.add('current')
    }

    setTimeout(() => {
        current.classList.remove('current');

    }, 500);


    if (autoScroll) {

        clearInterval(intervalTimer)
        intervalTimer = setInterval(() => {
            next.click();
        }, slideInterval);
    }
})


prev.addEventListener('click', () => {
    const current = document.querySelector('.current');

    current.classList.remove('current');

    if (current.previousElementSibling) {
        current.previousElementSibling.classList.add('current');
    } else {
        slides[slides.length - 1].classList.add('current')
    }

    setTimeout(() => {
        current.classList.remove('current');
    }, 500);



    if (autoScroll) {

        clearInterval(intervalTimer)
        intervalTimer = setInterval(() => {
            prev.click();
        }, slideInterval);
    }

})



if (autoScroll) {
    intervalTimer = setInterval(() => {
        next.click();
    }, slideInterval);
}
</script>
@endpush

@endsection