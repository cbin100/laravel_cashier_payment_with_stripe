<!-- Contact Us -->
<section class="contact-us section-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-7 col-12">
                <!-- Contact Form -->
                <div class="contact-form-area m-top-30">
                    <h4>Last step, type your Debit/Credit card details</h4>
                    <p>Order:  <b> {{ $productPrintName }}</b>  {{ $productPrintCurrency.''.number_format($productPrintPrice, 0) }} </p>
                    <form class="form" method="POST" id="payment-form" action="{{ route('createOrder', [$slug]) }}">
                        @csrf
                        @method('POST')
                        <div class="row">
                            {{-- -}}<div class="col-lg-6 col-md-6 col-12"> {{-- --}}
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="icon"><i class="fa fa-user"></i></div>
                                    <input id="card-holder-name" type="text" name="cardHolderName" class="form-control form-control-lg" placeholder="Full Name on the card *" value="{{ old('cardHolderName') }}" class="@error('cardHolderName') is-invalid @enderror">
                                    @error('cardHolderName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                {{-- -}} </div> {{-- --}}
                            {{-- --}}
                            </div>

                            {{-- -}}<div class="col-lg-6 col-md-6 col-12"> {{-- --}}
                            <div class="col-12">
                                <div class="form-group">
                                <!-- Stripe Elements Placeholder -->
                                    <div id="card-element" class="form-control form-control-lg"></div>
                                    {{-- STRIPE elements placeholder --}}
                                </div>
                            {{-- --}}
                            </div>
                            <div class="col-12">
                            {{-- PRINT THE STRIPE ERROR MESSAGES --}}
                                <div id="paymentResponse" style="color: red;"> </div>
                                <p id="card-error" role="alert" style="color: red;"></p>
                            {{-- /PRINT THE STRIPE ERROR MESSAGES --}}
                                {{-- --}}
                                <p class="result-message a">
                                    {{-- Payment succeeded, see the result in your --}}
                                    <a href="" target="_blank">{{--Stripe dashboard.--}}</a>
                                    {{--Refresh the page to pay again.--}}
                                    {{-- --}}
                                </p>
                                {{-- --}}
                            </div>
                            {{-- --}}

                            {{-- -}}
                            <div class="col-12">
                                <div class="form-group textarea">
                                    <div class="icon"><i class="fa fa-pencil"></i></div>
                                    <textarea type="textarea" name="message" rows="5">
                                    </textarea>
                                </div>
                            </div>
                            {{-- --}}

                            <div class="col-12">
                                <div class="form-group button">
                                    <p>
                                        By submitting this form you agree to our
                                        <a href="{{ route('view.index', 'privacy-cookies-policy') }}"><strong style="color:blue">Privacy Policy</strong></a> and
                                        <a href="{{ route('view.index', 'terms-conditions') }}"><strong style="color:blue">T&Cs</strong>.</a>
                                    </p>
                                    {{-- -}}
                                    <button type="submit" class="bizwheel-btn theme-2">Save and Continue</button>
                                    <button type="submit" class="bizwheel-btn theme-1">Pay Now</button>
                                    {{-- --}}
                                    {{-- --}}
                                    <button id="submit" data-secret="{{-- $intent->client_secret --}}">
                                        <div class="spinner hidden" id="spinner"></div>
                                        <span id="button-text" class="bizwheel-btn theme-1">Pay now</span>
                                    </button>
                                    {{-- --}}

                                </div>

                                            <!-- HERE THE DIV FOR NOTIFICATION MESSAGE -->
                                            @if ($message = Session::get('success'))
                                                <div class="alert alert-success">
                                                    <p>{{ $message }}</p>
                                                </div>
                                            @endif

                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif

                                            @if ($message = Session::get('unauthorised'))
                                                <div class="alert alert-danger alert-dismissible">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                                                    <p>{{ $message }}</p>
                                                </div>
                                            @endif

                                        </div>



                                    </div>


                                </form>
                            </div>
                            <!--/ End contact Form -->
                        </div>





                        <div class="col-lg-5 col-md-5 col-12">
                            <br class="contact-box-main m-top-30">
                                <p class="contact-title">
                                    {{-- -}}<h2>Order: {{ $productPrintName.' '.$productPrintCurrency.''.number_format($productPrintPrice, 0) }}</h2>{{-- --}}
                            Dear <b> customer {{-- $peloCustomer->name --}},</b>
                        </br>
                            You are about to pay {{ $productPrintCurrency.''.number_format($productPrintPrice, 0) }} {{ $_SESSION['productPrintPrice'] }} to
                            <b> Pelo Group Limited </b> for the product/service <b>{{ $productPrintName }}</b>.
                        </p>

                    <p>
                        Pelo Group Limited is registered in England and Wales under company number 13268133 and with our registered office at 79 Penny Meadow, Ashton Under-Lyne, OL6 6EL, United Kingdom.
                    </p>
                    <p>
                        <b>As one-off payment, we won't save your debit/credit card details.</b>
                        Once we receive your payment, we will contact you as soon as possible (within 24 hours). Your ordered product/service will be available as soon as we get all requirements (logo, images, texts, etc.)
                    </p>

                    </br>
                    <p>
                        <b>Not found the right package for you?</b>
                        For any tailored package, please <a href="{{ route('contact') }}"> <b style="color: blue">get in touch here</b>. </a>

                        </p>


                    {{-- -}}
                    <!-- Single Contact -->
                    <div class="single-contact-box">
                        <div class="c-icon"><i class="fa fa-clock-o"></i></div>
                        <div class="c-text">
                            <h4>Opening Hour</h4>
                            <p>Monday - Saturday<br>09AM - 6PM (everyday)</p>
                        </div>
                    </div>
                    <!--/ End Single Contact -->
                    <!-- Single Contact -->
                    <div class="single-contact-box">
                        <div class="c-icon"><i class="fa fa-phone"></i></div>
                        <div class="c-text">
                            <h4>Call Us Now</h4>
                            <p>Tel: +44 7466 355319<br> WhatsApp: +44 7466 355319</p>
                        </div>
                    </div>
                    <div class="single-contact-box">
                        <div class="c-icon"><i class="fa fa-map-marker"></i></div>
                        <div class="c-text">
                            <h4>Business location</h4>
                            <p>79 PENNY MEADOW, ASHTON U-LYNE<br> LANCASHIRE, OL6 6EL</p>
                        </div>
                    </div>

                    <!--/ End Single Contact -->
                    <!-- Single Contact -->
                    <div class="single-contact-box">
                        <div class="c-icon"><i class="fa fa-envelope-o"></i></div>
                        <div class="c-text">
                            <h4>Email Us</h4>
                            <p>
                                info@pelogroup.net
                            </p>
                        </div>
                    </div>
                    {{-- --}}


                    <!--/ End Single Contact -->
                    {{-- -}}
                    <div class="button">
                        <a href="{{ route('view.index', 'our-portfolio') }}" class="bizwheel-btn theme-1">Our Works<i class="fa fa-angle-right"></i></a>
                    </div>
                    {{-- --}}
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End Contact Us -->
