<!-- Contact Us -->
<section class="contact-us section-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-7 col-12">
                <!-- Contact Form -->
                <div class="contact-form-area m-top-30">
                    <h4>Get In Touch</h4>
                    <form class="form" method="POST" action="{{ route('contact.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <div class="icon"><i class="fa fa-user"></i></div>
                                    <input type="text" name="first_name" placeholder="Full Name *" class="@error('first_name') is-invalid @enderror">
                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- --}}
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <div class="icon"><i class="fa fa-user"></i></div>
                                    <input type="text" name="last_name" placeholder="Last Name *">
                                </div>
                            </div>
                            {{-- --}}
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <div class="icon"><i class="fa fa-envelope"></i></div>
                                    <input type="email" name="email" placeholder="Type your email address *" class="@error('email') is-invalid @enderror">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- --}}
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    {{-- -}}
                                    <div class="icon"><i class="fa fa-tag"></i></div>
                                    <input type="text" name="subject" placeholder="Type Subjects">
                                    {{-- --}}
                                    <select id="subject" name="subject" class="form-control select2" placeholder="Select a subject" style="width: 100%;">
                                        {{-- -}}<option value="publish" selected="selected">----</option>{{-- --}}
                                        {{-- --}}<option value="">---</option>{{-- --}}
                                        <option value="Web Design">Web Design</option>
                                        <option value="E-commerce">E-commerce</option>
                                        <option value="Redesign">Redesign</option>
                                        <option value="Mobile App">Mobile App</option>
                                        <option value="SEO">SEO</option>
                                        <option value="Data Analytic">Data Analytic</option>
                                        <option value="Other">Other</option>
                                    </select>



                                </div>
                            </div>
                            {{-- --}}
                            <div class="col-12">
                                <div class="form-group textarea">
                                    <div class="icon"><i class="fa fa-pencil"></i></div>
                                    <textarea type="textarea" name="message" rows="5">
                                    </textarea>

                                </div>
                            </div>


                            <div class="col-12">
                                <div class="form-group button">
                                    <p>
                                        By submitting this form you agree to our
                                        <a href="{{ route('view.index', 'privacy-cookies-policy') }}"><strong style="color:blue">Privacy Policy</strong></a> and
                                        <a href="{{ route('view.index', 'terms-conditions') }}"><strong style="color:blue">T&Cs</strong>.</a>
                                    </p>

                                    <button type="submit" class="bizwheel-btn theme-2">Send Now</button>
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
                <div class="contact-box-main m-top-30">
                    <div class="contact-title">
                        <h2>Contact with us</h2>
                        <p>
                            To get a free quote on any aspect of websites, mobile app, SEO, online functionality, e-commerce or any question, please fill in our contact form and we will get back to you as soon as possible.

                        </p>
                    </div>
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
                            <p>PENNY MEADOW, ASHTON U-LYNE<br> LANCASHIRE, OL6 6EL</p>
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
                                {{-- -}}<br>contact@pelogroup.net{{-- --}}
                            </p>
                        </div>
                    </div>
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
