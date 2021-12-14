@php
    $check_features = DB::table('slidershows')
        //->join('postmetas', 'posts.id', '=', 'postmetas.post_parent_id')
        ->join('posts', 'slidershows.post_image_id', '=', 'posts.id')
        //->where('posts.post_mime_type', 'like', 'jp%')
        //->orWhere('posts.post_mime_type', 'like', 'png%')
        //->where('posts.post_mime_type', '<>', '')
        //->where('posts.post_mine_base64', '<>', '')
//
        //->where('posts.post_type', 'category')
        //->where('posts.slug',  'like', 'news%')
        ->count();

    if ($check_features> 0) {

@endphp


		<!-- Hero Slider -->
		<section class="hero-slider style1">
			<div class="home-slider">
				<!-- Single Slider -->
                {{--  --}}
                @php
                    $mysliders = DB::table('slidershows')
                        ->join('posts', 'slidershows.post_image_id', '=', 'posts.id')
                        //->where('posts.post_mime_type', 'like', 'jp%')
                        //->orWhere('posts.post_mime_type', 'like', 'png%')
                        //->where('posts.post_mine_base64', '<>', '')
                        //->where('post_type', 'article')
                        //->orWhere('post_type', 'page')
                        //->select('slidershows.*', 'posts.*')
                        ->get();
                        foreach ($mysliders as $myslider) {
                            //echo '<label for="linked_post" > <input type="radio" name="linked_post" id="linked_post" value="'.$article->id.'">' .$article->post_title. '</label><br/>' ;

                @endphp
                {{-- -}}<div class="single-slider" style="background-image:url('{{ url('storage/app/public/'.$myslider->guid.'') }}')">{{-- --}}
                    {{-- --}}<div class="single-slider" style="background-image:url('{{ 'data:image/'.$myslider->post_mime_type.';base64,'.$myslider->post_mine_base64.'' }}')">{{-- --}}
                    {{-- }}<div class="single-slider" style="background-image:url('https://via.placeholder.com/1700x800.png')"> {{-- --}}

                    <div class="container">
						<div class="row">
							<div class="col-lg-7 col-md-8 col-12">
								<div class="welcome-text">
									<div class="hero-text">
										<h4>{{ $myslider->slider_caption }}</h4>
										<h1 style="color:#F5F5EF;">{{ $myslider->slider_title }} </h1>
										<div class="p-text">
											{{-- }}<p style="color:#F4F9FC;">{{ $myslider->slider_description }}</p> {{-- --}}
                                            <p style="color:#F5F5EF;">{{ $myslider->slider_description }}</p>
										</div>
										<div class="button">
											<a href="{{ url('contact-us') }}" class="bizwheel-btn theme-1 effect">Work with us</a>
											<a href="{{ url('our-portfolio') }}" class="bizwheel-btn theme-2 effect">View Our Portfolio</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

                @php
                    }
                @endphp
                {{-- --}}
				<!--/ End Single Slider -->



				<!-- Single Slider -->
                {{-- }}
				<div class="single-slider" style="background-image:url('https://via.placeholder.com/1700x800.png')">
					<div class="container">
						<div class="row">
							<div class="col-lg-7 col-md-8 col-12">
								<div class="welcome-text">
									<div class="hero-text">
										<h4>Your time is so important for us</h4>
										<h1>Build Your WorldClass Brand with Bizwheel</h1>
										<div class="p-text">
											<p>Nunc tincidunt venenatis elit. Etiam venenatis quam vel maximus bibendum Pellentesque elementum dapibus diam tristique</p>
										</div>
										<div class="button">
											<a href="blog.html" class="bizwheel-btn theme-1 effect">Read our blog</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
                {{-- --}}
				<!--/ End Single Slider -->

			</div>
		</section>
		<!--/ End Hero Slider -->
@php
    }
@endphp
