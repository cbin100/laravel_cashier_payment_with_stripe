<!-- Faqs -->
<section class="faqs section-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-7 col-12">
                <div class="faqs-main m-top-30">

                    {{-- -}}<div class="row">{{-- --}}
                        <div class="col-12">
                            <div id="accordion" role="tablist">
                                <!-- Single Faq -->
                                @foreach($postmetas as $postmeta)
                                <div class="single-faq">
                                    <div class="faq-heading" role="tab" id="faq{{ ++$i }}">
                                        <h4 class="faq-title">
                                            <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                <i class="fa fa-pencil"></i>{{ $postmeta->post_title }}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="faq{{ ++$i-1 }}" data-parent="#accordion">
                                        <div class="faq-body">

                                            {{ $postmeta->post_title }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                                <!--/ End Single Faq -->
                                <!-- Single Faq -->
                                <div class="single-faq">
                                    <div class="faq-heading" role="tab" id="faq2">
                                        <h4 class="faq-title">
                                            <a class="collapsed" data-toggle="collapse"  href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                <i class="fa fa-pencil"></i> Can you give me 50% discount as 1st purchase?
                                                {{ $test_slug }}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="faq2" data-parent="#accordion">
                                        <div class="faq-body">
                                            <p>Proin dui purus, facilisis quis euismod quis, euismod eu augue. Etiam vel dui arcu. Cras varius mi ut eros pharetra, id aliquam metus venenatis. Donec sollicitudin tincidunt semper. Integer ultrices luctus ultricies. Curabitur quis sem eget ipsum vulputate pulvinar. Curabitur ullamco</p>
                                        </div>
                                    </div>
                                </div>
                                <!--/ End Single Faq -->
                                <!-- Single Faq -->
                                <div class="single-faq">
                                    <div class="faq-heading" role="tab" id="faq3">
                                        <h4 class="faq-title">
                                            <a class="collapsed" data-toggle="collapse"  href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                                <i class="fa fa-pencil"></i>How Do i Start making Money from Home??
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="faq3" data-parent="#accordion">
                                        <div class="faq-body">
                                            <p>Proin dui purus, facilisis quis euismod quis, euismod eu augue. Etiam vel dui arcu. Cras varius mi ut eros pharetra, id aliquam metus venenatis. Donec sollicitudin tincidunt semper. Integer ultrices luctus ultricies. Curabitur quis sem eget ipsum vulputate pulvinar. Curabitur ullamco</p>
                                        </div>
                                    </div>
                                </div>
                                <!--/ End Single Faq -->
                                <!-- Single Faq -->
                                <div class="single-faq">
                                    <div class="faq-heading" role="tab" id="faq4">
                                        <h4 class="faq-title">
                                            <a class="collapsed" data-toggle="collapse"  href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                                <i class="fa fa-pencil"></i>Can i use unlimited website from a single licence?
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="faq4" data-parent="#accordion">
                                        <div class="faq-body">
                                            <p>Proin dui purus, facilisis quis euismod quis, euismod eu augue. Etiam vel dui arcu. Cras varius mi ut eros pharetra, id aliquam metus venenatis. Donec sollicitudin tincidunt semper. Integer ultrices luctus ultricies. Curabitur quis sem eget ipsum vulputate pulvinar. Curabitur ullamco</p>
                                        </div>
                                    </div>
                                </div>
                                <!--/ End Single Faq -->
                                <!-- Single Faq -->
                                <div class="single-faq">
                                    <div class="faq-heading" role="tab" id="faq5">
                                        <h4 class="faq-title">
                                            <a class="collapsed" data-toggle="collapse"  href="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                                <i class="fa fa-pencil"></i>Have any replace or refund policy?
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseFive" class="collapse" role="tabpanel" aria-labelledby="faq5" data-parent="#accordion">
                                        <div class="faq-body">
                                            <p>Proin dui purus, facilisis quis euismod quis, euismod eu augue. Etiam vel dui arcu. Cras varius mi ut eros pharetra, id aliquam metus venenatis. Donec sollicitudin tincidunt semper. Integer ultrices luctus ultricies. Curabitur quis sem eget ipsum vulputate pulvinar. Curabitur ullamco</p>
                                        </div>
                                    </div>
                                </div>
                                <!--/ End Single Faq -->
                            </div>
                        </div>

                    {{-- -}}</div> {{-- --}}

                </div>
            </div>
{{-- -}}
            <div class="col-lg-5 col-md-5 col-12">
                <!-- Contact Form -->
                <div class="contact-form-area faq-form m-top-30">
                    <h4>Get In Touch</h4>
                    <form class="form" action="#" method="post">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="icon"><i class="fa fa-user"></i></div>
                                    <input type="text" name="user-name" placeholder="Full name">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="icon"><i class="fa fa-envelope"></i></div>
                                    <input type="email" name="email" placeholder="Type email">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="icon"><i class="fa fa-tag"></i></div>
                                    <input type="text" name="subject" placeholder="Type subject">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group textarea">
                                    <div class="icon"><i class="fa fa-pencil"></i></div>
                                    <textarea type="textarea" placeholder="Your message" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group button">
                                    <button type="submit" class="bizwheel-btn theme-2">Send Now</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!--/ End contact Form -->
            </div>
            {{-- --}}

        </div>
    </div>
</section>
<!--/ End Faqs -->
