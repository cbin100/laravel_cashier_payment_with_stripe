@php
/*
     $check_features = DB::table('posts')
        ->join('postmetas', 'posts.id', '=', 'postmetas.post_parent_id')
        ->select(DB::raw('count(posts.id) as user_count, posts.slug, posts.id, posts.post_content'))
        ->where('posts.post_type', 'category')
        ->where('posts.slug',  'like', 'portfolio%')
        ->groupBy('posts.slug', 'posts.id', 'posts.post_content')
        ->first();

    if (($check_features->user_count)> 0) {
        $id_category = $check_features->id;
        $content_category = $check_features->post_content;
*/
@endphp

@php
    $check_features = DB::table('posts')
        ->join('postmetas', 'posts.id', '=', 'postmetas.post_parent_id')
        //->select(DB::raw('count(*) as user_count, posts.slug, posts.id, posts.post_content'))
        ->where('posts.post_type', 'category')
        ->where('posts.slug',  'like', 'portfolio%')
        ->count();

    if ($check_features> 0) {
    //if (($check_features->user_count)> 0) {
        $mycategories = DB::table('posts')
        ->join('postmetas', 'posts.id', '=', 'postmetas.post_parent_id')
        //->select(DB::raw('count(*) as user_count, posts.slug, posts.id, posts.post_content'))
        ->where('posts.post_type', 'category')
        ->where('posts.slug',  'like', 'portfolio%')
        //->groupBy('posts.slug', 'posts.id', 'posts.post_content')
        ->select('posts.*')
        ->first();

        $id_category = $mycategories->id;
        //$title_category = $check_features->post_title;
        $content_category = $mycategories->post_content;
@endphp


		<!-- Portfolio -->
		<section class="portfolio section-space">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
						<div class="section-title default text-center">
							<div class="section-top">
								<h1><span>Project</span><b>Our Successful Works</b></h1>
							</div>
							<div class="section-bottom">
								<div class="text">
									<p>{!! $content_category !!}</p>
								</div>
							</div>
						</div>
					</div>
				</div>
                {{-- }}
				<div class="row">
					<div class="col-12">
						<div class="portfolio-menu">
							<!-- Portfolio Nav -->
							<ul id="portfolio-nav" class="portfolio-nav tr-list list-inline cbp-l-filters-work">
								<li data-filter="*" class="cbp-filter-item active">All</li>
								<li data-filter=".animation" class="cbp-filter-item">Animation</li>
								<li data-filter=".branding" class="cbp-filter-item">Branding</li>
								<li data-filter=".business" class="cbp-filter-item">Business</li>
								<li data-filter=".consulting" class="cbp-filter-item">Consulting</li>
								<li data-filter=".marketing" class="cbp-filter-item">Marketing</li>
								<li data-filter=".seo" class="cbp-filter-item">SEO</li>
							</ul>
							<!--/ End Portfolio Nav -->
						</div>
					</div>
				</div>
                {{-- --}}
				<div class="row">
					<div class="col-12">
						<div class="portfolio-main">
							<div id="portfolio-item" class="portfolio-item-active">

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
                                    $mylink = '#';
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
                                  //$mymage = $myfeature->guid;
                                  $mymage = $myfeature->post_mine_base64;
                                  $image_type = $myfeature->post_mime_type;
                                }
                                @endphp
                                <div class="cbp-item business animation">
									<!-- Single Portfolio -->
									<div class="single-portfolio">
										<div class="portfolio-head overlay">
                                            {{-- <img src="{{ url('storage/app/public/'.$mymage.'') }}" alt="#" width="600"
                                            height="415"> --}}
                                            {{-- }}<img src="https://via.placeholder.com/600x415" alt="#">{{-- --}}
                                            <img src="{{ ('data:image/'.$image_type.';base64,'.$mymage.'') }}" alt="#" width="600" height="415">
                                            <a class="more" href="{{ $mylink }}" target="_blank"><i class="fa fa-long-arrow-right"></i></a>
										</div>
										<div class="portfolio-content">
											<h4><a href="{{ $mylink }}" target="_blank">{{ $myfeature->post_title }}</a></h4>
											<p>{{ $myfeature->post_caption }}</p>
										</div>
									</div>
									<!--/ End Single Portfolio -->
								</div>
                                @php
                                    }
                                @endphp

							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--/ End Portfolio -->
@php
    }
@endphp
