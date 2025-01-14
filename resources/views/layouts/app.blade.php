<!DOCTYPE html>
<html lang="en">

<head>
    @include('include.head')
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        @include('include.navbar')
    </nav>
    <!-- END nav -->
    <section id="hero" class="hero-wrap" style="background-image: url('assets/images/bg_1.jpg');"
        data-stellar-background-ratio="0.5">
        @include('include.hero')
    </section>

    <section class="ftco-section ftco-no-pb ftco-no-pt bg-primary">
        <div class="container">
            <div class="row d-flex no-gutters">
                <div class="col-md-3 d-flex align-items-stretch ftco-animate">
                    <div class="media block-6 services services-bg d-block text-center px-4 py-5">
                        <div class="icon d-flex justify-content-center align-items-center"><span
                                class="flaticon-business"></span></div>
                        <div class="media-body py-md-4">
                            <h3>Trusted by Thousands</h3>
                            <p>A small river named Duden flows by their place and supplies it with the necessary
                                regelialia.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-items-stretch ftco-animate">
                    <div class="media block-6 services services-bg services-darken d-block text-center px-4 py-5">
                        <div class="icon d-flex justify-content-center align-items-center"><span
                                class="flaticon-home"></span></div>
                        <div class="media-body py-md-4">
                            <h3>Wide Range of Properties</h3>
                            <p>A small river named Duden flows by their place and supplies it with the necessary
                                regelialia.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-items-stretch ftco-animate">
                    <div class="media block-6 services services-bg services-lighten d-block text-center px-4 py-5">
                        <div class="icon d-flex justify-content-center align-items-center"><span
                                class="flaticon-stats"></span></div>
                        <div class="media-body py-md-4">
                            <h3>Financing Made Easy</h3>
                            <p>A small river named Duden flows by their place and supplies it with the necessary
                                regelialia.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-items-stretch ftco-animate">
                    <div class="media block-6 services services-bg d-block text-center px-4 py-5">
                        <div class="icon d-flex justify-content-center align-items-center"><span
                                class="flaticon-quarantine"></span></div>
                        <div class="media-body py-md-4">
                            <h3>Locked in Pricing</h3>
                            <p>A small river named Duden flows by their place and supplies it with the necessary
                                regelialia.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section" id="booking-section">
        {{-- @yield('content') --}}
        @include('include.booking', ['ruangans' => $ruangans])
    </section>

    <section class="ftco-section services-section bg-darken" id="flow">
        @include('include.flow')
    </section>

    <section class="ftco-section ftco-no-pb ftco-no-pt" id="about">
        @include('include.about')
    </section>

    <section class="ftco-counter img" id="section-counter">
        <div class="container">
            <div class="row pt-md-5">
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18 py-5 mb-4">
                        <div class="text text-border d-flex align-items-center">
                            <strong class="number" data-number="1000">0</strong>
                            <span>Area <br>Population</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18 py-5 mb-4">
                        <div class="text text-border d-flex align-items-center">
                            <strong class="number" data-number="2500">0</strong>
                            <span>Total <br>Properties</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18 py-5 mb-4">
                        <div class="text text-border d-flex align-items-center">
                            <strong class="number" data-number="500">0</strong>
                            <span>Average <br>House</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18 py-5 mb-4">
                        <div class="text d-flex align-items-center">
                            <strong class="number" data-number="67">0</strong>
                            <span>Total <br>Branches</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section testimony-section bg-light" id="testimonials">
        @include('include.testimonials')
    </section>

    <section class="ftco-section ftco-agent" id="team">
        @include('include.team')
    </section>

    <footer class="ftco-footer ftco-section">
        @include('include.footer')
    </footer>



    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen">
        <svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke-miterlimit="10" stroke="#00FF00" /> <!-- Warna hijau -->
        </svg>
    </div>

    @include('include.script')
</body>

</html>
