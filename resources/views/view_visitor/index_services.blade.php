@php
    $check_features = DB::table('posts')
        ->join('postmetas', 'posts.id', '=', 'postmetas.post_parent_id')
        //->select(DB::raw('count(*) as user_count, posts.slug, posts.id, posts.post_content'))
        ->where('posts.post_type', 'category')
        ->where('posts.slug',  'like', 'services%')
        //->groupBy('posts.slug', 'posts.id', 'posts.post_content')
        ->count();

    if ($check_features> 0) {
    //if (($check_features->user_count)> 0) {
        $mycategories = DB::table('posts')
        ->join('postmetas', 'posts.id', '=', 'postmetas.post_parent_id')
        //->select(DB::raw('count(*) as user_count, posts.slug, posts.id, posts.post_content'))
        ->where('posts.post_type', 'category')
        ->where('posts.slug',  'like', 'services%')
        //->groupBy('posts.slug', 'posts.id', 'posts.post_content')
        ->select('posts.*')
        ->first();

        $id_category = $mycategories->id;
        //$title_category = $check_features->post_title;
        $content_category = $mycategories->post_content;
@endphp

@php
/*
     $check_features = DB::table('posts')
        ->join('postmetas', 'posts.id', '=', 'postmetas.post_parent_id')
        ->select(DB::raw('count(posts.id) as user_count, posts.slug, posts.id, posts.post_content'))
        ->where('posts.post_type', 'category')
        ->where('posts.slug',  'like', 'services%')
        ->groupBy('posts.slug', 'posts.id', 'posts.post_content')
        ->first();

    if (($check_features->user_count)> 0) {
        $id_category = $check_features->id;
        //$title_category = $check_features->post_title;
        $content_category = $check_features->post_content;
*/
@endphp

		<!-- Services -->
		<section class="services section-bg section-space">
			<div class="container">

				<div class="row">
					<div class="col-12">
						<div class="section-title style2 text-center">
							<div class="section-top">
								<h1><span>Creative</span><b>Service We Provide</b></h1><h4>We provide quality service &amp; support..</h4>
							</div>
							<div class="section-bottom">
								<div class="text-style-two">
									<p>{!! $content_category !!}</p>
								</div>
							</div>
						</div>
					</div>
				</div>


				<div class="row">
                    @php
                        $myfeatures = DB::table('posts')
                                            ->join('postmetas', 'posts.id', '=', 'postmetas.post_id')
                                            ->where('posts.post_type', 'article')
                                            ->where('postmetas.post_parent_id', $id_category)
                                            ->select('posts.*')
                                            ->get();

                        foreach ($myfeatures as $myfeature) {
                    $image_type = $myfeature->post_mime_type;
                    $external_link = $myfeature->external_link;
                    if ($external_link == '') {
                        $mylink = url($myfeature->slug);
                    }
                    else {
                        $mylink = $external_link;
                    }

                    if ($image_type == '') {
                        $mymages = DB::table('posts')
                                   //->where('post_mime_type', 'like', 'jp%')
                                   //->orWhere('post_mime_type', 'like', 'png')
                                   ->where('post_mine_base64', '<>', '')
                                   //->select('posts.*')
                                   ->inRandomOrder()
                                   ->limit(3)
                                   ->first();
                        //$mymage = $mymages->guid;
                        $mymage = $mymages->post_mine_base64;
                        $image_type = $mymages->post_mime_type;
                    }
                     else {
                         $mymage = $myfeature->post_mine_base64;
                         $image_type = $myfeature->post_mime_type;
                     }

                    @endphp

					<div class="col-lg-4 col-md-4 col-12">
						<!-- Single Service -->
						<div class="single-service">
							<div class="service-head">
                                {{-- }}<img src="https://via.placeholder.com/555x410" alt="#"> {{-- --}}
								{{-- }}<img src="{{ url('storage/app/public/'.$mymage.'') }}" alt="#" width="555" height="410">{{-- --}}
                                <img src="{{ ('data:image/'.$image_type.';base64,'.$mymage.'') }}" alt="#" width="555" height="410">
								<div class="icon-bg"><i class="fa fa-handshake-o"></i></div>
                                {{-- }}
                                <div class="icon-bg"><i class="fa fa-html5"></i></div>
                                <div class="icon-bg"><i class="fa fa-cube"></i></div>
                                {{-- --}}
							</div>
							<div class="service-content">
								<h4><a href="{{ $mylink }}">{{ $myfeature->post_title }}</a></h4>
								<p>{{ $myfeature->post_caption }}</p>
								<a class="btn" href="{{ $mylink }}"><i class="fa fa-arrow-circle-o-right"></i>View Service</a>
							</div>
						</div>
						<!--/ End Single Service -->
					</div>
                    @php
                        }
                    @endphp

				</div>
			</div>
		</section>
		<!--/ End Services -->
@php
    }
@endphp
