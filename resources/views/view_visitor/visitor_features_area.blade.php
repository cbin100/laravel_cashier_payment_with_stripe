<!-- Features Area -->
@php
/*
     $check_features = DB::table('posts')
        ->join('postmetas', 'posts.id', '=', 'postmetas.post_parent_id')
        ->select(DB::raw('count(posts.id) as user_count, posts.slug, posts.id'))
        ->where('posts.post_type', 'category')
        ->where('posts.slug',  'like', 'features%')
        ->groupBy('posts.slug', 'posts.id')
        ->first();
//
    if (($check_features->user_count)> 0) {
        $id_category = $check_features->id;
*/
@endphp

@php
    $check_features = DB::table('posts')
        ->join('postmetas', 'posts.id', '=', 'postmetas.post_parent_id')
        //->select(DB::raw('count(*) as user_count, posts.slug, posts.id, posts.post_content'))
        ->where('posts.post_type', 'category')
        ->where('posts.slug',  'like', 'features%')
        ->count();

    if ($check_features> 0) {
    //if (($check_features->user_count)> 0) {
        $mycategories = DB::table('posts')
        ->join('postmetas', 'posts.id', '=', 'postmetas.post_parent_id')
        //->select(DB::raw('count(*) as user_count, posts.slug, posts.id, posts.post_content'))
        ->where('posts.post_type', 'category')
        ->where('posts.slug',  'like', 'features%')
        //->groupBy('posts.slug', 'posts.id', 'posts.post_content')
        ->select('posts.*')
        ->first();

        $id_category = $mycategories->id;
        //$title_category = $check_features->post_title;
        $content_category = $mycategories->post_content;
@endphp

<section class="features-area section-bg">
    <div class="container">
        <div class="row">
            @php
                $myfeatures = DB::table('posts')
                                    ->join('postmetas', 'posts.id', '=', 'postmetas.post_id')
                                    //->where('postmetas.post_parent_id', $id_category)
                                    ->where('postmetas.post_parent_id', $id_category)
                                    ->where('posts.post_type', 'article')
                                    ->select('posts.*')
                                    ->get();

               foreach ($myfeatures as $myfeature) {
            @endphp
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Single Feature  $myfeature->post_title -->
                <div class="single-feature">
                    <div class="icon-head"><i class="fa fa-podcast"></i></div>
                    <h4><a href="#">{{ $myfeature->post_title }}</a></h4>
                    {{-- --}}<p>{{ $myfeature->post_caption }}</p> {{-- --}}
                    <div class="button">
                        <a href="{{ url($myfeature->slug) }}" class="bizwheel-btn"><i class="fa fa-arrow-circle-o-right"></i>Learn More</a>
                    </div>
                </div>
                <!--/ End Single Feature -->
            </div>
            @php
            }
           // }
            @endphp

        </div>
    </div>
</section>
@php
}

@endphp
<!--/ End Features Area -->

