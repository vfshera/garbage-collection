<x-app-layout>
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


        <section class="services  pgc-container">

            <div class="services-options">


                <div class="service">
                    <div class="service-image">
                        <img src="'https://picsum.photos/200/200" alt="A">
                    </div>

                    <div class="description">
                        <h3>Residential Waste Pickup</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur vitae atque soluta eaque
                            sint!
                            Sapiente?</p>
                        <a href="">Order Service A</a>
                    </div>
                </div>


                <div class="service">
                    <div class="service-image">
                        <img src="'https://picsum.photos/200/200" alt="B">
                    </div>

                    <div class="description">
                        <h3>Business Waste Pickup</h3>
                        <p> Pariatur vitae atque soluta.Lorem ipsum dolor sit amet, consectetur adipisicing elit. eaque
                            sint!
                            Sapiente?</p>
                        <a href="">Order Service B</a>
                    </div>
                </div>

                <div class="service">
                    <div class="service-image">
                        <img src="'https://picsum.photos/200/200" alt="C">
                    </div>

                    <div class="description">
                        <h3>Dumpers</h3>
                        <p> Pariatur vitae atque soluta.Lorem ipsum dolor sit amet, consectetur adipisicing elit. eaque
                            sint!
                            Sapiente?</p>
                        <a href="">Order Service C</a>
                    </div>
                </div>

            </div>

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

</x-app-layout>