@php
    $check_features = DB::table('posts')
        ->join('postmetas', 'posts.id', '=', 'postmetas.post_parent_id')
        //->select(DB::raw('count(*) as user_count, posts.slug, posts.id, posts.post_content'))
        ->where('posts.post_type', 'category')
        ->where('posts.slug',  'like', 'reviews%')
        //->groupBy('posts.slug', 'posts.id', 'posts.post_content')
        ->count();

    if ($check_features> 0) {
    //if (($check_features->user_count)> 0) {
        $mycategories = DB::table('posts')
        ->join('postmetas', 'posts.id', '=', 'postmetas.post_parent_id')
        //->select(DB::raw('count(*) as user_count, posts.slug, posts.id, posts.post_content'))
        ->where('posts.post_type', 'category')
        ->where('posts.slug',  'like', 'reviews%')
        ->select('posts.*')
        ->first();

        $id_category = $mycategories->id;
        //$title_category = $check_features->post_title;
        $content_category = $mycategories->post_content;
@endphp

		<!-- Testimonials -->

@php

     $mymages = DB::table('posts')
               ->where('post_mime_type', 'like', 'jp%')
               ->orWhere('post_mime_type', 'like', 'png')
               ->where('post_mine_base64', '<>', '')
               ->inRandomOrder()
               ->limit(3)
               ->first();
    //$mymage = $mymages->guid;
    $mymage = $mymages->post_mine_base64;
    $image_type = $mymages->post_mime_type;

@endphp


        {{-- }<section class="testimonials section-space" style="background-image:url('https://via.placeholder.com/1500x700')">{{-- --}}
{{-- -}}<section class="testimonials section-space" style="background-image:url('{{ url('storage/app/public/'.$mymage.'') }}')">{{-- --}}
<section class="testimonials section-space" style="background-image:url('{{ 'data:image/'.$image_type.';base64,'.$mymage.'' }}')">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-9 col-12">
						<div class="section-title default text-left">
							<div class="section-top">
								<h1><b>Our Satisfied Clients</b></h1>
							</div>
							<div class="section-bottom">
								<div class="text">
                                    <p>some of our great clients and their review</p>
                                    {{-- }}<p>{{ $id_category }}</p> {{-- --}}
                                </div>
							</div>
						</div>
						<div class="testimonial-inner">
							<div class="testimonial-slider">


                            @php
                                $myfeatures = DB::table('posts')
                                                    ->join('postmetas', 'posts.id', '=', 'postmetas.post_id')
                                                    ->where('posts.post_type', 'article')
                                                    ->where('postmetas.post_parent_id', $id_category)
                                                    ->select('posts.*')
                                                    ->get();

                                foreach ($myfeatures as $myfeature) {

                            @endphp
								<!-- Single Testimonial -->
								<div class="single-slider">
									<ul class="star-list">
										<li><i class="fa fa-star"></i></li>
										<li><i class="fa fa-star"></i></li>
										<li><i class="fa fa-star"></i></li>
										<li><i class="fa fa-star"></i></li>
										<li><i class="fa fa-star"></i></li>
									</ul>
									<p>{!! $myfeature->post_content !!}</p>
									<!-- Client Info -->
									<div class="t-info">
										<div class="t-left">

                                            {{-- }}<div class="client-head"><img src="https://via.placeholder.com/70x70" alt="#"></div>{{-- --}}
											{{-- }}<div class="client-head"><img src="{{ url('storage/'.$mymage.'') }}" alt="#"></div> {{-- --}}
											<h2>{{ $myfeature->post_caption }} <span>{{ $myfeature->external_link }}</span></h2>
										</div>
										<div class="t-right">
											<div class="quote"><i class="fa fa-quote-right"></i></div>
										</div>
									</div>
								</div>
								<!-- / End Single Testimonial -->
                            @php
                                }
                            @endphp

								<!-- / End Single Testimonial -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--/ End Testimonials -->
@php
    }
@endphp
