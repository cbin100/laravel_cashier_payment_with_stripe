


<!-- Footer -->
<footer class="footer" style="background-image:url('{{ asset('t_visitor/pelotheme1/img/map.png') }}')">
    <!-- Footer Top -->
    <div class="footer-top">
        <div class="container">
            <div class="row">



                <div class="col-lg-2 col-md-6 col-12">
                    <!-- Footer Links -->
                    <div class="single-widget f-link widget">
                        <h3 class="widget-title">Pelo Group</h3>
                        <ul>
                            <li><a href="{{ url('about-us') }}">About Us</a></li>
                            <li><a href="{{ url('services') }}">Our Services</a></li>
                            <li><a href="{{ url('our-portfolio') }}">Portfolio</a></li>
                            <li><a href="{{ url('features') }}">PeloApp features</a></li>
                            <li><a href="{{ url('contact-us') }}">Contact us</a></li>
                        </ul>
                    </div>
                    <!--/ End Footer Links -->
                </div>



                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Footer Contact -->
                    <div class="single-widget footer_contact widget">
                        <h3 class="widget-title">Contact</h3>
                        {{-- -}}
                        <p>Beatae vitae dicta sunt explicabo nemo enim ipsam voluptatem</p>
                        {{-- --}}
                        <ul class="address-widget-list">
                            <li class="footer-mobile-number"><i class="fa fa-phone"></i>+44 7466 355319</li>
                            <li><i class="fa fa-whatsapp"></i>+44 7466 355319</li>
                            <li class="footer-mobile-number"><i class="fa fa-envelope"></i>info@pelogroup.net</li>
                            <li class="footer-mobile-number"><i class="fa fa-map-marker"></i>Penny Meadow, Ashton U-Lyne, United Kingdom</li>

                        </ul>
                    </div>
                    <!--/ End Footer Contact -->
                </div>
            </div>

        </div>
    </div>
    <!-- Copyright -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="copyright-content">
                        <!-- Copyright Text -->
                        <p>{{-- }}©{{-- --}} &copy; Copyright {{ date('Y') }}
                            Pelo Group Limited. All rights reserved |



                            @php
                                use Illuminate\Support\Str;
                                //$contains = Str::contains('This is my name', 'my');
                                //$converted = Str::lower('LARAVEL');




                        $menunavbars = DB::table('posts')
                                        ->where('post_type', 'menu')
                                        ->where('post_status', 'publish')
                                        ->where('post_name', 'foot-left')
                                        ->where('post_parent', 0)
                                        ->select('posts.*')
                                        ->get();
                        foreach ($menunavbars as $menunavbar) {
                                 $title = $menunavbar->post_title;
                                 $slugs = $menunavbar->slug;
                                 $post_parent = $menunavbar->post_parent;
                                 $ids = $menunavbar->id;

                                 $guid = Str::lower($menunavbar->guid);
                                    //$ids = $menufoot_slug->id;
                                    $external_link = Str::lower($menunavbar->external_link);
                                    $post_caption = Str::lower($menunavbar->post_caption);
                                    $post_description = Str::lower($menunavbar->post_description);
                                    $foot_slug = Str::lower($menunavbar->slug);
                                    //$foot_title = Str::lower($menufoot_slug->post_title);
                                    $foot_title = $menunavbar->post_title;

                                 $count_childs = DB::table('posts')
                                                    ->where('posts.post_type', 'menu')
                                                    //->where('posts.post_parent', '=', $ids)
                                                    ->where('posts.id', '=', $ids)
                                                    ->where('posts.post_name', 'foot-left')
                                                    ->count();
                                 if ($count_childs>0) {
                                        /*
                                     echo '<li class="icon-active"><a href="#"> ' .$title.'</a>';
                                     echo '<ul class="sub-menu">';
                                        */
                                     $childs = DB::table('posts')
                                                    ->join('postmetas', 'posts.id', '=', 'postmetas.post_id')
                                                    ->where('posts.post_type', 'menu')
                                                    //->where('posts.post_parent', '=', $ids)
                                                    ->where('posts.id', '=', $ids)
                                                    ->where('posts.post_name', 'foot-left')
                                                    ->select('posts.*', 'postmetas.post_parent_id')
                                                    ->get();
                                     foreach ($childs as $child) {
                                             $post_parent_id = $child->post_parent_id;
                                             $myroutes = DB::table('posts')
                                                         ->where('id', '=', $post_parent_id)
                                                         ->select('posts.*')
                                                         ->first();
                                             $slug = $myroutes->slug;
                                             $post_type = $myroutes->post_type;
                                             $external_link = $myroutes->external_link;
                                             $post_list = array('article', 'page', 'category');
                                             if (in_array($post_type, $post_list)) {
                                                 echo '<a href="'.route('view.index', [$slug]).'"> '.$child->post_title.' </a> | ';
                                             }
                                     }

                                 }
                                 if (Str::contains($foot_slug, 'facebook')) {
                                        echo ' <a class="facebook" href="'.$external_link.'" target="_blank"><i class="fa fa-facebook fa-lg"></i></a> | ';
                                    }
                                    else if (Str::contains($foot_slug, 'instagram')) {
                                        echo '<a class="instagram" href="'.$external_link.'" target="_blank"><i class="fa fa-instagram fa-lg"></i></a> | ';
                                    }
                                    else if (Str::contains($foot_slug, 'twitter')) {
                                        echo '<a class="twitter" href="'.$external_link.'" target="_blank"><i class="fa fa-twitter fa-lg"></i></a> | ';
                                    }

                        }




/*
                                $menufoot_left = DB::table('posts')
                                ->where('post_type', 'menu')
                                ->where('post_status', 'publish')
                                ->where('post_name', 'foot-left')
                                //->where('guid', 'facebook')
                                ->count();


                            if ($menufoot_left > 0) {
                                $menufoot_slugs = DB::table('posts')
                                                    ->where('post_type', 'menu')
                                                    ->where('post_status', 'publish')
                                                    ->where('post_name', 'foot-left')
                                                    ->select('posts.*')
                                                    //->where('guid', 'facebook')
                                                    ->get();
                                foreach ($menufoot_slugs as $menufoot_slug)
                                {
                                    $guid = Str::lower($menufoot_slug->guid);
                                    //$ids = $menufoot_slug->id;
                                    $external_link = Str::lower($menufoot_slug->external_link);
                                    $post_caption = Str::lower($menufoot_slug->post_caption);
                                    $post_description = Str::lower($menufoot_slug->post_description);
                                    $foot_slug = Str::lower($menufoot_slug->slug);
                                    //$foot_title = Str::lower($menufoot_slug->post_title);
                                    $foot_title = $menufoot_slug->post_title;
                                    //$foot_title = Str::lower($menufoot_slug->external_link)$menufoot_slug->post_title;

                                    if (Str::contains($foot_slug, 'facebook')) {
                                        echo ' <a class="facebook" href="'.$external_link.'" target="_blank"><i class="fa fa-facebook fa-lg"></i></a> | ';
                                    }
                                    else if (Str::contains($foot_slug, 'instagram')) {
                                        echo '<a class="instagram" href="'.$external_link.'" target="_blank"><i class="fa fa-instagram fa-lg"></i></a> | ';
                                    }
                                    else if (Str::contains($foot_slug, 'twitter')) {
                                        echo '<a class="twitter" href="'.$external_link.'" target="_blank"><i class="fa fa-twitter fa-lg"></i></a> | ';
                                    }
                                    else
                                        {
                                        echo '<a href="'.route('view.option', [$foot_slug]).'">'.$foot_title.'</a> | ';
                                        }
                                }

                                //if (str_contains($guid, 'facebook'))
                                }
                            */
                            @endphp

                            {{-- -}}
                            <a href="{{ route('view.index', [$myfeature->slug]) }}">Privacy Policy </a> |
                            <a href="#">Terms & Conditions</a> |




                            <a class="facebook" href="#" target="_blank"><i class="fa fa-facebook fa-lg"></i></a> |
                            <a class="twitter" href="#" target="_blank"><i class="fa fa-twitter fa-lg"></i></a> |
                            <a class="instagram" href="#" target="_blank"><i class="fa fa-instagram fa-lg"></i></a> |
                            {{-- --}} Design &amp; Development By
                            {{-- -}}<a target="_blank" href="{{ URL::current() }}">Pelo Group</a>{{-- --}}
                            <a href="{{ url("/home") }}">Pelo Group</a>
                            {{-- --}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Copyright -->




</footer>

<!-- Jquery JS -->
<script src="{{ asset('t_visitor/pelotheme1/js/jquery.min.js') }}"></script>
<script src="{{ asset('t_visitor/pelotheme1/js/jquery-migrate-3.0.0.js') }}"></script>
<!-- Popper JS -->
<script src="{{ asset('t_visitor/pelotheme1/js/popper.min.js') }}"></script>
<!-- Bootstrap JS -->
<script src="{{ asset('t_visitor/pelotheme1/js/bootstrap.min.js') }}"></script>
<!-- Modernizr JS -->
<script src="{{ asset('t_visitor/pelotheme1/js/modernizr.min.js') }}"></script>
<!-- ScrollUp JS -->
<script src="{{ asset('t_visitor/pelotheme1/js/scrollup.js') }}"></script>
<!-- FacnyBox JS -->
<script src="{{ asset('t_visitor/pelotheme1/js/jquery-fancybox.min.js') }}"></script>
<!-- Cube Portfolio JS -->
<script src="{{ asset('t_visitor/pelotheme1/js/cubeportfolio.min.js') }}"></script>
<!-- Slick Nav JS -->
<script src="{{ asset('t_visitor/pelotheme1/js/slicknav.min.js') }}"></script>
<!-- Slick Nav JS -->
<script src="{{ asset('t_visitor/pelotheme1/js/slicknav.min.js') }}"></script>
<!-- Slick Slider JS -->
<script src="{{ asset('t_visitor/pelotheme1/js/owl-carousel.min.js') }}"></script>
<!-- Easing JS -->
<script src="{{ asset('t_visitor/pelotheme1/js/easing.js') }}"></script>
<!-- Magnipic Popup JS -->
<script src="{{ asset('t_visitor/pelotheme1/js/magnific-popup.min.js') }}"></script>
<!-- Active JS -->
<script src="{{ asset('t_visitor/pelotheme1/js/active.js') }}"></script>

{{-- -}}
https://www.websitepolicies.com/create/cookie-consent-banner
{{-- -}}
<link rel="stylesheet" type="text/css" href="https://cdn.wpcc.io/lib/1.0.2/cookieconsent.min.css"/><script src="https://cdn.wpcc.io/lib/1.0.2/cookieconsent.min.js" defer></script><script>window.addEventListener("load", function(){window.wpcc.init({"border":"thin","corners":"small","colors":{"popup":{"background":"#e2f7d4","text":"#000000","border":"#7fc25e"},"button":{"background":"#7fc25e","text":"#ffffff"}},"position":"bottom","content":{"href":"https://pelogroup.net/privacy-cookies-policy","message":"Pelo Group uses cookies to ensure you get the best experience on our website.","button":"Got it"}})});</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4d7116a51c533d02"></script>
{{-- --}}
