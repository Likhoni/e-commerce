<!DOCTYPE html>
<html lang="en">

<head>
    <style type="text/css">
        .notify {
            z-index: 1000000;
            margin-top: 5%;
        }

        /* Remove the spinner for Chrome, Safari, Edge, Opera */
        .quantity_selector input[type="number"]::-webkit-inner-spin-button,
        .quantity_selector input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Remove the spinner for Firefox */
        .quantity_selector input[type="number"] {
            -moz-appearance: textfield;
            /* Firefox-specific */
            appearance: textfield;
        }
    </style>

    @notifyCss
    <title>E-Commerce</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Colo Shop Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="{{ url('frontend/styles/bootstrap4/bootstrap.min.css') }}">
    <link href="{{ url('frontend/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/plugins/OwlCarousel2-2.2.1/animate.css') }}">
    <link rel="stylesheet" href="{{ url('frontend/plugins/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/plugins/jquery-ui-1.12.1.custom/jquery-ui.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/styles/single_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/styles/single_responsive.css') }}">
</head>

<body>

    <div class="super_container">

        @include('frontend.partial.header')


        <div class="container single_product_container" style="padding-top: 50px;">

            <div class="row">
                <div class="col-lg-7">
                    <div class="single_product_pics">
                        <div class="row">
                            <div class="col-lg-3 thumbnails_col order-lg-1 order-2">
                                <div class="single_product_thumbnails">
                                    <ul>
                                        <li>
                                            <img style="height: 135px; width: 200px;" src="/images/products/{{ $singleProduct->image}}" alt=""
                                                data-image="/images/products/{{ $singleProduct->image }}">
                                        </li>
                                    </ul>
                                    @foreach ($singleProduct->images->take(3) as $image)
                                    <ul>
                                        <li>
                                            <img style="height: 135px; width: 200px;" src="/images/products/{{ $image->image_url }}" alt=""
                                                data-image="/images/products/{{ $image->image_url }}">
                                        </li>
                                    </ul>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-lg-9 image_col order-lg-2 order-1">
                                <div class="single_product_image">
                                    <div class="single_product_image_background"
                                        style="background-image:url('/images/products/{{ $singleProduct->image}}'); height: 467px; width:450px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="product_details">
                        <div class="product_details_title">
                            <h2>{{$singleProduct->product_name}}</h2>
                        </div>
                        <div class="original_price">৳{{$singleProduct->product_price}}</div>
                        <div class="product_price">৳{{$singleProduct->discount_price}}</div>
                        <ul class="star_rating">
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                        </ul>
                        <div class="product_color">
                            <span>Select Color:</span>
                            <ul>
                                <li style="background: #e54e5d"></li>
                                <li style="background: #252525"></li>
                                <li style="background: #60b3f3"></li>
                            </ul>
                        </div>

                        <!--Quantity Increase Decrease-->
                        <div class="quantity d-flex align-items-center">
                            <span class="me-2">Quantity:</span>
                            <div class="quantity_selector d-flex align-items-center">
                                <button class="btn btn-outline-secondary btn-sm minus me-2" onclick="decreaseQuantity(event)">-</button>
                                <input type="number" id="quantity_value" name="quantity" value="1" min="1" class="form-control form-control-sm text-center me-2" style="width: 50px;" readonly/>
                                <button class="btn btn-outline-secondary btn-sm plus" onclick="increaseQuantity(event)">+</button>
                            </div>
                        </div>

                        <div style="padding-top: 50px;" class="row">
                            <form action="{{ route('frontend.add.to.cart', $singleProduct->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="quantity" id="selected_quantity" value="1">
                                <button type="submit" class="btn btn-danger add_to_cart_button">Add to Cart</button>
                            </form>
                        </div>

                        <!-- <div style="padding-top: 50px;" class="row">
                            <div class="red_button add_to_cart_button"><a href="{{ route('frontend.add.to.cart', $singleProduct->id) }}">add to cart</a></div>
                            <div class="buy_now_button"><a href="#" style="color:white">Buy Now </a></div>
                            <div class="product_favorite d-flex flex-column align-items-center justify-content-center">
                            </div>
                        </div> -->


                    </div>
                </div>
            </div>

        </div>

        <!-- Tabs -->

        <div class="tabs_section_container">

            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="tabs_container">
                            <ul class="tabs d-flex flex-sm-row flex-column align-items-left align-items-md-center justify-content-center">
                                <li class="tab active" data-active-tab="tab_1"><span>Description</span></li>
                                <li class="tab" data-active-tab="tab_2"><span>Additional Information</span></li>
                                <li class="tab" data-active-tab="tab_3"><span>Reviews (2)</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">

                        <!-- Tab Description -->

                        <div id="tab_1" class="tab_container active">
                            <div class="row">
                                <div class="col-lg-5 desc_col">
                                    <div class="tab_title">
                                        <h4>Description</h4>
                                    </div>
                                    <div class="tab_text_block">
                                        <h2>Pocket cotton sweatshirt</h2>
                                        <p>Nam tempus turpis at metus scelerisque placerat nulla deumantos solicitud felis. Pellentesque diam dolor, elementum etos lobortis des mollis ut...</p>
                                    </div>
                                    <div class="tab_image">
                                        <img src="images/desc_1.jpg" alt="">
                                    </div>
                                    <div class="tab_text_block">
                                        <h2>Pocket cotton sweatshirt</h2>
                                        <p>Nam tempus turpis at metus scelerisque placerat nulla deumantos solicitud felis. Pellentesque diam dolor, elementum etos lobortis des mollis ut...</p>
                                    </div>
                                </div>
                                <div class="col-lg-5 offset-lg-2 desc_col">
                                    <div class="tab_image">
                                        <img src="images/desc_2.jpg" alt="">
                                    </div>
                                    <div class="tab_text_block">
                                        <h2>Pocket cotton sweatshirt</h2>
                                        <p>Nam tempus turpis at metus scelerisque placerat nulla deumantos solicitud felis. Pellentesque diam dolor, elementum etos lobortis des mollis ut...</p>
                                    </div>
                                    <div class="tab_image desc_last">
                                        <img src="images/desc_3.jpg" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tab Additional Info -->

                        <div id="tab_2" class="tab_container">
                            <div class="row">
                                <div class="col additional_info_col">
                                    <div class="tab_title additional_info_title">
                                        <h4>Additional Information</h4>
                                    </div>
                                    <p>COLOR:<span>Gold, Red</span></p>
                                    <p>SIZE:<span>L,M,XL</span></p>
                                </div>
                            </div>
                        </div>

                        <!-- Tab Reviews -->

                        <div id="tab_3" class="tab_container">
                            <div class="row">

                                <!-- User Reviews -->

                                <div class="col-lg-6 reviews_col">
                                    <div class="tab_title reviews_title">
                                        <h4>Reviews (2)</h4>
                                    </div>

                                    <!-- User Review -->

                                    <div class="user_review_container d-flex flex-column flex-sm-row">
                                        <div class="user">
                                            <div class="user_pic"></div>
                                            <div class="user_rating">
                                                <ul class="star_rating">
                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                    <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="review">
                                            <div class="review_date">27 Aug 2016</div>
                                            <div class="user_name">Brandon William</div>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                        </div>
                                    </div>

                                    <!-- User Review -->

                                    <div class="user_review_container d-flex flex-column flex-sm-row">
                                        <div class="user">
                                            <div class="user_pic"></div>
                                            <div class="user_rating">
                                                <ul class="star_rating">
                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                    <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="review">
                                            <div class="review_date">27 Aug 2016</div>
                                            <div class="user_name">Brandon William</div>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Add Review -->

                                <div class="col-lg-6 add_review_col">

                                    <div class="add_review">
                                        <form id="review_form" action="post">
                                            <div>
                                                <h1>Add Review</h1>
                                                <input id="review_name" class="form_input input_name" type="text" name="name" placeholder="Name*" required="required" data-error="Name is required.">
                                                <input id="review_email" class="form_input input_email" type="email" name="email" placeholder="Email*" required="required" data-error="Valid email is required.">
                                            </div>
                                            <div>
                                                <h1>Your Rating:</h1>
                                                <ul class="user_star_rating">
                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                    <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                                </ul>
                                                <textarea id="review_message" class="input_review" name="message" placeholder="Your Review" rows="4" required data-error="Please, leave us a review."></textarea>
                                            </div>
                                            <div class="text-left text-sm-right">
                                                <button id="review_submit" type="submit" class="red_button review_submit_btn trans_300" value="Submit">submit</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <!-- Footer -->

        @include('frontend.partial.footer')

    </div>

    <script src="{{ url('frontend/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ url('frontend/styles/bootstrap4/popper.js') }}"></script>
    <script src="{{ url('frontend/styles/bootstrap4/bootstrap.min.js') }}"></script>
    <script src="{{ url('frontend/plugins/Isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{ url('frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
    <script src="{{ url('frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
    <script src="{{ url('frontend/plugins/jquery-ui-1.12.1.custom/jquery-ui.js') }}"></script>
    <script src="{{ url('frontend/js/single_custom.js') }}"></script>

    <script>
        const decreaseQuantity = (e) => {
            e.preventDefault();
            const input = document.getElementById('quantity_value');
            const hiddenInput = document.getElementById('selected_quantity');
            if (input.value > 1) {
                input.value--;
                hiddenInput.value = input.value;
            }
        };

        const increaseQuantity = (e) => {
            e.preventDefault();
            const input = document.getElementById('quantity_value');
            const hiddenInput = document.getElementById('selected_quantity');
            input.value++;
            hiddenInput.value = input.value;
        };
    </script>
    @include('notify::components.notify')
    @notifyJs
</body>

</html>