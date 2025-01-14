<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 heading-section text-center ftco-animate mb-5">
            <span class="subheading">Our Excellent Room</span>
            <h2 class="mb-2">Booking Now</h2>
        </div>
    </div>
    <div class="row ftco-animate">
        <div class="col-md-12">
            <div class="carousel-properties owl-carousel">
                @foreach ($ruangans as $room)
                    <div class="item">
                        <div class="property-wrap ftco-animate">
                            <a href="{{ route('booking', ['id' => $room->id]) }}" class="img"
                                style="background-image: url('{{ asset('storage/' . $room->photo) }}');">
                                <div class="rent-sale">
                                    <span class="sale">Sale</span>
                                </div>
                                <p class="price"><span class="orig-price">Rp
                                        {{ number_format($room->price_per_hour, 0, ',', '.') }}/jam</span></p>
                            </a>
                            <div class="text">
                                <ul class="property_list">
                                    <li><span class="flaticon-bed"></span>3</li>
                                    <li><span class="flaticon-bathtub"></span>2</li>
                                    <li><span class="flaticon-floor-plan"></span>1,878 sqft</li>
                                </ul>
                                <h3><a href="{{ route('booking', ['id' => $room->id]) }}">{{ $room->name }}</a></h3>
                                <span class="location">{{ $room->category }}</span>
                                <a href="{{ route('booking', ['id' => $room->id]) }}" class="d-flex align-items-center justify-content-center btn-custom">
                                    <span class="fa fa-link"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
