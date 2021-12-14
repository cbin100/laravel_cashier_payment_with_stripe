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
        ->first();

        $id_category = $mycategories->id;
        //$title_category = $check_features->post_title;
        $content_category = $mycategories->post_content;
@endphp
