
<!-- Service Single -->
<section class="service-single section-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-12">
                <!-- Service Image -->
                {{-- --}}<div class="service-img"> {{-- --}}

                    @if(($slug->post_mime_type)=== '')
                        {{-- -}}<img src="{{ url('storage/app/public/'.$slug->guid.'') }}" alt="#">{{-- --}}

                    {{-- -}}<img src="https://via.placeholder.com/750x400" alt="#"> {{-- --}}

                    @else
                    {{-- -}}<img src="{{ url('storage/app/public/'.$slug->guid.'') }}" alt="#">{{-- --}}
                    {{-- --}}<img src="{{ 'data:image/'.$slug->post_mime_type.';base64,'.$slug->post_mine_base64.'' }}" alt="#">{{-- --}}
                    @endif


                {{-- --}}</div>{{--  --}}
                <!-- Service Content -->
                <div class="service-content">
                    <h2>{{ $slug->post_title }}</h2>
                    <p>
                        {{ $slug->post_caption }}
                    </p>
                    {!! $slug->post_content !!}
                    {{-- -}}
                    <div class="row service-space">
                        <div class="col-lg-6 col-md-6 col-12">
                            <!-- Service Feature -->
                            <div class="small-list-feature">
                                <h3>We provide you innovation</h3>
                                <p>Female is firmament made land don't good behold yielding morning hathe seas unto. their earth it fourth moveth rule</p>
                                <ul>
                                    <li><i class="fa fa-check"></i>We provide you creative servicce</li>
                                    <li><i class="fa fa-check"></i>Just awesome trending way</li>
                                    <li><i class="fa fa-check"></i>Just awesome trending way</li>
                                    <li><i class="fa fa-check"></i>Creative service is most important</li>
                                    <li><i class="fa fa-check"></i>99% Server Up-time gurantee</li>
                                    <li><i class="fa fa-check"></i>24/7 live support</li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-12">
                            <!-- Service Img -->
                            <div class="modern-img-feature">
                                <img src="https://via.placeholder.com/600x530" alt="#">
                                <div class="video-play">
                                    <a href="https://www.youtube.com/watch?v=RLlPLqrw8Q4" class="video video-popup mfp-iframe"><i class="fa fa-play"></i></a>
                                </div>
                            </div>
                        </div>

                    </div>
                    {{-- --}}

                </div>
            </div>

            {{-- --}}
            <!-- Insert blade right content here -->
            @include('view_visitor.visitor_view_content_right')
            <!-- /Insert blade right content here -->
            {{-- --}}

        </div>
    </div>
</section>
<!--/ End Services -->
