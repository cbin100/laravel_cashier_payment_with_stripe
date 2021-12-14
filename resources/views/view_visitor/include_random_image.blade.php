@php

$mymages = DB::table('posts')
->where('post_mime_type', 'like', 'jp%')
->orWhere('post_mime_type', 'like', 'png')
->inRandomOrder()
->limit(3)
->first();
$mymage = $mymages->guid;
$mymage = $mymages->post_mine_base64;
@endphp
