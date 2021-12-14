<!-- Breadcrumb -->
@php
    $mymages = DB::table('posts')
               //->where('post_mime_type', 'like', 'jp%')
               //->orWhere('post_mime_type', 'like', 'png')
               ->where('post_mine_base64', '<>', '')
               //->select('posts.*')
               ->inRandomOrder()
               ->limit(3)
               ->first();
    //$mymage = $mymages->guid;
    $myextension = $mymages->post_mime_type;
    $mymage = $mymages->post_mine_base64;
@endphp
<div class="breadcrumbs overlay" style="background-image:url('{{ 'data:image/'.$myextension.';base64,'.$mymage.'' }}')">
{{-- -}}<div class="breadcrumbs overlay" style="background-image:url('{{ url('storage/app/public/'.$mymage.'') }}')"> {{-- --}}
    {{-- -}}<div class="breadcrumbs overlay" style="background-image:url('https://via.placeholder.com/1600x500')">{{-- --}}
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <!-- Bread Menu -->
                    <div class="bread-menu">
                        <ul>
                            <li><a href="{{ url('home') }}">Home</a></li>
                            <li><a href="{{ url('services') }}">Services</a></li>
                            {{-- -}}<li><a href="service-business.html">Service Business</a></li>{{--  --}}
                        </ul>
                    </div>
                    <!-- Bread Title -->
                    <div class="bread-title"><h2>Ops!</h2></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / End Breadcrumb -->
