<!-- Check if post exists -->
<?php
//include('include_feature.blade.php');
?>
<!--/ Check if post exists -->
@php
    $check_features = DB::table('posts')
        ->join('postmetas', 'posts.id', '=', 'postmetas.post_parent_id')
        //->select(DB::raw('count(*) as user_count, posts.slug, posts.id, posts.post_content'))
        ->where('posts.post_type', 'category')
        ->where('posts.slug',  'like', 'news%')
        //->groupBy('posts.slug', 'posts.id', 'posts.post_content')
        ->count();

    if ($check_features> 0) {
    //if (($check_features->user_count)> 0) {
        $mycategories = DB::table('posts')
        ->join('postmetas', 'posts.id', '=', 'postmetas.post_parent_id')
        //->select(DB::raw('count(*) as user_count, posts.slug, posts.id, posts.post_content'))
        ->where('posts.post_type', 'category')
        ->where('posts.slug',  'like', 'news%')
        //->groupBy('posts.slug', 'posts.id', 'posts.post_content')
        ->select('posts.*')
        ->first();

        $id_category = $mycategories->id;
        //$title_category = $check_features->post_title;
        $content_category = $mycategories->post_content;
@endphp
		<!-- Latest Blog -->
		<section class="latest-blog section-space">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
						<div class="section-title default text-center">
							<div class="section-top">
								<h1><span>Latest</span><b> Published</b></h1>
							</div>
							<div class="section-bottom">
								<div class="text">
									<p> {!! $content_category !!}</p>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-12">
						<div class="blog-latest blog-latest-slider">
                            @php
                            $myfeatures = DB::table('posts')
                                          ->join('postmetas', 'posts.id', '=', 'postmetas.post_id')
                                          ->where('posts.post_type', 'article')
                                          ->where('postmetas.post_parent_id', $id_category)
                                          ->select('posts.*')
                                          ->get();

                            foreach ($myfeatures as $myfeature) {
                                $image_type = $myfeature->post_mime_type;
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
                                           ->inRandomOrder()
                                           ->limit(3)
                                           ->first();
                                //$mymage = $mymages->guid;
                                $mymage = $mymages->post_mine_base64;
                                $image_type = $mymages->post_mime_type;
                            }
                             else {
                                 //$mymage = $myfeature->guid;
                                 $mymage = $myfeature->post_mine_base64;
                                 $image_type = $myfeature->post_mime_type;
                             }

                            @endphp

							<div class="single-slider">
								<!-- Single Blog -->
								<div class="single-news ">
									<div class="news-head overlay">
                                        {{-- -}}<span class="news-img" style="background-image:url('{{ url('storage/app/public/'.$mymage.'') }}'); background-size:700px 530px;"></span>{{-- --}}
                                        <span class="news-img" style="background-image:url('{{ 'data:image/'.$image_type.';base64,'.$mymage.'' }}'); background-size:700px 530px;"></span>
										<a href="{{ $mylink }}" class="bizwheel-btn theme-2">Read more</a>
									</div>
									<div class="news-body">
										<div class="news-content">
											<h3 class="news-title"><a href="{{ $mylink }}">{{ $myfeature->post_title }}</a></h3>
											<div class="news-text"><p> {{ $myfeature->post_caption }}</p></div>
											<ul class="news-meta">
												<li class="date"><i class="fa fa-calendar"></i>{{ \Carbon\Carbon::parse($myfeature->updated_at)->diffForHumans() }}</li>
												<li class="view"><i class="fa fa-comments"></i>{{ $myfeature->post_comment_count }}</li>
											</ul>
										</div>
									</div>
								</div>
								<!--/ End Single Blog -->
							</div>
                            @php
                                }
                            @endphp


						</div>
					</div>
				</div>
			</div>
		</section>
		<!--/ End Latest Blog -->

@php
    }
@endphp
