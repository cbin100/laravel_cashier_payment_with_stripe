 <!-- Header -->
    <header class="header">
        <!-- Topbar -->
        <div class="topbar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <!-- Top Contact -->
                        <div class="top-contact">
                            @php
                                use Illuminate\Support\Facades\DB;

                                use App\Models\Post;
                                use App\Models\Postmeta;
                                //$menutop_lefts = DB::select('select * from posts where post_type = ? and post_status = ? and post_name = ?', ['menu', 'publish', 'top-left']);
                                //*
                                $menutop_lefts = DB::table('posts')
                                                ->where('post_type', 'menu')
                                                ->where('post_status', 'publish')
                                                ->where('post_name', 'top-left')
                                                ->where('guid', 'phone')
                                                //->select('posts.*')
                                                ->count();
                                //*/
                               // foreach ($menutop_lefts as $menutop_left) {
                                    if ($menutop_lefts == true) {
                                            $menutop_lefts = DB::table('posts')
                                                            ->where('post_type', 'menu')
                                                            ->where('post_status', 'publish')
                                                            ->where('post_name', 'top-left')
                                                            ->where('guid', 'phone')
                                                            ->first();

                                            $title = $menutop_lefts->post_title;
                                            $slugs = $menutop_lefts->slug;
                                            $guid = $menutop_lefts->guid;
                                            $ids = $menutop_lefts->id;
                                            $external_link = $menutop_lefts->external_link;
                                            $post_caption = $menutop_lefts->post_caption;
                                            $post_description = $menutop_lefts->post_description;

                                    /*
                                     *
                                     if (strpos($guid, 'phone') !== false) {
                                        echo '<div class="single-contact"><i class="fa fa-phone"></i>Phone: '.$post_caption.'</div>';
                                    }
                                    */
                                    // OR PHP 8
                                    if (str_contains($guid, 'phone')) {
                                        echo '<div class="single-contact"><i class="fa fa-phone"></i>Phone: '.$post_caption.'</div>';
                                    }
                                }

                            $menutop_lefts = DB::table('posts')
                                                ->where('post_type', 'menu')
                                                ->where('post_status', 'publish')
                                                ->where('post_name', 'top-left')
                                                ->where('guid', 'email')
                                                ->count();
                                    if ($menutop_lefts == true) {
                                        $menutop_lefts = DB::table('posts')
                                                ->where('post_type', 'menu')
                                                ->where('post_status', 'publish')
                                                ->where('post_name', 'top-left')
                                                ->where('guid', 'email')
                                                ->first();

                                        $guid = $menutop_lefts->guid;
                                        $ids = $menutop_lefts->id;
                                        $external_link = $menutop_lefts->external_link;
                                        $post_caption = $menutop_lefts->post_caption;
                                        $post_description = $menutop_lefts->post_description;
                                        if (str_contains($guid, 'email')) {
                                            echo '<div class="single-contact"><i class="fa fa-envelope-open"></i> Email: <a href="mailto:'.$external_link.'">'.$external_link.'</a></div>';
                                        }
                                    }
                            $menutop_lefts = DB::table('posts')
                                                ->where('post_type', 'menu')
                                                ->where('post_status', 'publish')
                                                ->where('post_name', 'top-left')
                                                ->where('guid', 'map')
                                                ->count();
                                    if ($menutop_lefts == true) {
                                        $menutop_lefts = DB::table('posts')
                                                ->where('post_type', 'menu')
                                                ->where('post_status', 'publish')
                                                ->where('post_name', 'top-left')
                                                ->where('guid', 'map')
                                                ->first();
                                        $guid = $menutop_lefts->guid;
                                        $external_link = $menutop_lefts->external_link;
                                        $post_caption = $menutop_lefts->post_caption;
                                        $post_description = $menutop_lefts->post_description;
                                        if (str_contains($guid, 'map')) {
                                            echo '<div class="single-contact"><i class="fa fa-map-marker"></i>'.$external_link.'</div>';
                                        }
                                    }
                            @endphp
                            {{-- }} <div class="single-contact"><i class="fa fa-map-marker"></i>Dublin, Ireland</div>
                             <div class="single-contact"><i class="fa fa-clock-o"></i>Opening: '.$external_link.'</div>
                             {{-- --}}
                        </div>
                        <!-- End Top Contact -->
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="topbar-right">
                            <!-- Social Icons -->
                            <ul class="social-icons">
                                @php
                                $menutop_rights = DB::table('posts')
                                ->where('post_type', 'menu')
                                ->where('post_status', 'publish')
                                ->where('post_name', 'top-right')
                                ->where('guid', 'facebook')
                                ->count();
                            if ($menutop_rights == true) {
                                $menutop_rights = DB::table('posts')
                                                    ->where('post_type', 'menu')
                                                    ->where('post_status', 'publish')
                                                    ->where('post_name', 'top-right')
                                                    ->where('guid', 'facebook')
                                                    ->first();
                                $guid = $menutop_rights->guid;
                                $ids = $menutop_rights->id;
                                $external_link = $menutop_rights->external_link;
                                $post_caption = $menutop_rights->post_caption;
                                $post_description = $menutop_rights->post_description;
                                if (str_contains($guid, 'facebook')) {
                                    echo '<li><a href="'.$external_link.'" target="_blank"><i class="fa fa-facebook fa-lg"></i></a></li>';
                                }
                            }
                            $menutop_lefts = DB::table('posts')
                                            ->where('post_type', 'menu')
                                            ->where('post_status', 'publish')
                                            ->where('post_name', 'top-right')
                                            ->where('guid', 'twitter')
                                            ->count();
                            if ($menutop_rights == true) {
                                $menutop_rights = DB::table('posts')
                                            ->where('post_type', 'menu')
                                            ->where('post_status', 'publish')
                                            ->where('post_name', 'top-right')
                                            ->where('guid', 'twitter')
                                            ->first();
                                $guid = $menutop_rights->guid;
                                $external_link = $menutop_rights->external_link;
                                $post_caption = $menutop_rights->post_caption;
                                $post_description = $menutop_rights->post_description;
                                if (str_contains($guid, 'twitter')) {
                                    echo '<li><a href="'.$external_link.'" target="_blank"><i class="fa fa-twitter fa-lg"></i></a></li>';
                                }
                            }

                                $menutop_rights = DB::table('posts')
                                                    ->where('post_type', 'menu')
                                                    ->where('post_status', 'publish')
                                                    ->where('post_name', 'top-right')
                                                    ->where('guid', 'instagram')
                                                    ->count();
                                if ($menutop_rights == true) {
                                    $menutop_rights = DB::table('posts')
                                                    ->where('post_type', 'menu')
                                                    ->where('post_status', 'publish')
                                                    ->where('post_name', 'top-right')
                                                    ->where('guid', 'instagram')
                                                    ->first();

                                    $guid = $menutop_rights->guid;
                                    $ids = $menutop_rights->id;
                                    $external_link = $menutop_rights->external_link;
                                    $post_caption = $menutop_rights->post_caption;
                                    $post_description = $menutop_rights->post_description;
                                    if (str_contains($guid, 'instagram')) {
                                        echo '<li><a href="'.$external_link.'" target="_blank"><i class="fa fa-instagram fa-lg"></i></a></li>';
                                    }
                                }
                                @endphp
                                {{-- }}
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                {{-- --}}
                            </ul>
                            <div class="button">
                                <a href="{{ url('contact-us') }}" class="bizwheel-btn">Get a Quote</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Topbar -->
        <!-- Middle Header -->
        <div class="middle-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="middle-inner">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-12">
                                    <!-- Logo -->
                                    <div class="logo">
                                        <!-- Image Logo -->
                                        <div class="img-logo">
                                            <a href="{{ url('home') }}">
                                                {{-- -}}<img src="{{ asset('t_visitor/pelotheme1/img/pelologo.png') }}" alt="#">{{-- --}}
                                                <img src="{{ asset('t_visitor/pelotheme1/img/pelologo.png') }}" alt="#">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mobile-nav"></div>
                                </div>
                                <div class="col-lg-10 col-md-9 col-12">
                                    <div class="menu-area">
                                        <!-- Main Menu -->
                                        <nav class="navbar navbar-expand-lg">
                                            <div class="navbar-collapse">
                                                <div class="nav-inner">
                                                    <div class="menu-home-menu-container">
                                                        <!-- Naviagiton -->
                                                        <ul id="nav" class="nav main-menu menu navbar-nav">
                                                            {{-- <li> <a href="{{ route('menus.update') }}"> Home </a></li>{{-- --}}

                                                                @php
                                                                //use Illuminate\Support\Facades\DB;
                                                               // use App\Models\Post;
                                                                //use App\Models\Postmeta;

                                                                //$menunavbars = DB::select('select * from posts where post_type = ? and post_status = ? and slug = ?', ['category', 'publish', 'services']);
                                                                $menunavbars = DB::table('posts')
                                                                               ->where('post_type', 'menu')
                                                                               ->where('post_status', 'publish')
                                                                               ->where('post_name', 'nav-right')
                                                                               ->where('post_parent', 0)
                                                                               ->select('posts.*')
                                                                               ->get();

                                                                foreach ($menunavbars as $menunavbar) {

                                                                        $title = $menunavbar->post_title;
                                                                        $slugs = $menunavbar->slug;
                                                                        $post_parent = $menunavbar->post_parent;
                                                                        $ids = $menunavbar->id;
                                                                        $guid = $menunavbar->guid;
                                                                        //echo '<li> <a href="'.route('menus.update', $slugs).'"> '.$title.'  </a></li>';
                                                                        $count_childs = DB::table('posts')
                                                                                //->join('postmetas', 'posts.id', '=', 'postmetas.post_parent_id')
                                                                                //->join('postmetas', 'posts.id', '=', 'postmetas.post_id')
                                                                                ->where('posts.post_type', 'menu')
                                                                                //->where('postmetas.post_parent_id', $ids)
                                                                                //->where('posts.id', '=', $ids)
                                                                                //->where('posts.id', '=', $ids)
                                                                                //->where('posts.post_parent', '=', 0)
                                                                                //->where('posts.post_parent', '>', 0)
                                                                                ->where('posts.post_parent', '=', $ids)
                                                                                ->where('posts.post_name', 'nav-right')
                                                                                //->select('posts.*')
                                                                                ->count();
                                                                               // $child = $childs->post_parent;
                                                                               if ($count_childs>0) {
                                                                                    echo '<li class="icon-active"><a href="#"> ' .$title.'</a>';
                                                                                          echo '<ul class="sub-menu">';
                                                                                   //FOR E-COMMERCE SUBMENUS *******************************************
                                                                                    if ($guid === 'ecommerce-product') {

                                                                                        $childs = DB::table('posts')
                                                                                           ->join('product_metas', 'posts.id', '=', 'product_metas.product_id')
                                                                                           ->where('posts.post_type', 'menu')
                                                                                           ->where('posts.post_parent', '=', $ids)
                                                                                           ->where('posts.post_name', 'nav-right')
                                                                                           ->select('posts.*', 'product_metas.product_parent_id')
                                                                                           //->orderByDesc('posts.menu_order')
                                                                                           //->limit(1)
                                                                                           ->get();
                                                                                        //
                                                                                        foreach ($childs as $child) {
                                                                                                $product_parent_id = $child->product_parent_id;
                                                                                                $ecommerce_category_routes = DB::table('product_categories')
                                                                                                            //->where('posts.post_type', 'menu')
                                                                                                            ->where('id', '=', $product_parent_id)
                                                                                                            //->where('posts.post_name', 'nav-right')
                                                                                                            ->select('product_categories.*')
                                                                                                            ->first();
                                                                                                $slug = $ecommerce_category_routes->slug;
                                                                                                //$post_type = $ecommerce_category_routes->post_type;
                                                                                                //$post_list = array('article', 'page');
                                                                                                echo '<li> <a href="'.route('pricing', $child->slug).'"> '.$child->post_title.' </a></li>';
                                                                                                //echo '<li> <a href="'.route('pricing').'"> '.$child->post_title.' </a></li>';

                                                                                                }
                                                                                    }
                                                                                    // END E-COMMERCE SUBMENUS *******************************************

                                                                                          $childs = DB::table('posts')
                                                                                           ->join('postmetas', 'posts.id', '=', 'postmetas.post_id')
                                                                                           ->where('posts.post_type', 'menu')
                                                                                           ->where('posts.post_parent', '=', $ids)
                                                                                           ->where('posts.post_name', 'nav-right')
                                                                                           ->select('posts.*', 'postmetas.post_parent_id')
                                                                                           ->get();
                                                                                           foreach ($childs as $child) {
                                                                                                $post_parent_id = $child->post_parent_id;
                                                                                                $myroutes = DB::table('posts')
                                                                                                            //->where('posts.post_type', 'menu')
                                                                                                            ->where('id', '=', $post_parent_id)
                                                                                                            //->where('posts.post_name', 'nav-right')
                                                                                                            ->select('posts.*')
                                                                                                            ->first();
                                                                                                $slug = $myroutes->slug;
                                                                                                $post_type = $myroutes->post_type;
                                                                                                $post_list = array('article', 'page');
                                                                                                if (in_array($post_type, $post_list)) {
                                                                                                //if ($post_type === 'article') {
                                                                                                    echo '<li> <a href="'.route('view.index', [$slug]).'"> '.$child->post_title.' </a></li>';
                                                                                                }
                                                                                                else {
                                                                                                      echo '<li> <a href="'.route('view.index', [$slug]).'"> '.$child->post_title.' </a></li>';
                                                                                                }
                                                                                           }
                                                                                           echo '</ul>';
                                                                                   echo '</li>';
                                                                               }
                                                                               else {
                                                                                   $slug = $slugs;
                                                                                   echo '<li> <a href="'.route('view.option', $slug).'"> '.$title.' </a></li>';
                                                                                    //echo '<li> <a href="'.route('view.option', $post_parent).'"> '.$title.' </a></li>';
                                                                                    //$post_parent
                                                                               }
                                                                    }
                                                            @endphp

                                                        </ul>
                                                        <!--/ End Naviagiton -->
                                                    </div>
                                                </div>
                                            </div>
                                        </nav>
                                        <!--/ End Main Menu -->
                                        <!-- Right Bar -->
                                        {{-- --}}
                                        <div class="right-bar">
                                            <!-- Search Bar -->

                                            <ul class="right-nav">
                                                <li class="top-search"><a href="#0"><i class="fa fa-search"></i></a></li>
                                                <li class="bar"><a class="fa fa-bars"></a></li>
                                            </ul>

                                            <!--/ End Search Bar -->
                                            <!-- Search Form -->
                                            <div class="search-top">
                                                <form action="#" class="search-form" method="get">
                                                    <input type="text" name="s" value="" placeholder="Search here"/>
                                                    <button type="submit" id="searchsubmit"><i class="fa fa-search"></i></button>
                                                </form>
                                            </div>
                                            <!--/ End Search Form -->
                                        </div>
                                        <!--/ End Right Bar -->
                                    </div>
                                    <!--/ End Menu Area-->
                                </div>
                                <!--/ End Col Menu -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Middle Header -->



        <!-- Sidebar Popup -->
        <div class="sidebar-popup">
            <div class="cross">
                <a class="btn"><i class="fa fa-close"></i></a>
            </div>
            <div class="single-content">
                <h4>About Pelo Group</h4>
                <p>
                    Pelo Group is your technology growth partner providing software development from conception to delivery. We help you to simplify, strengthen and transform your business.
                    </p>
                <!-- Social Icons -->
                <ul class="social">

                    <li><a href="https://www.facebook.com/pelogroup" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="https://twitter.com/pelogroup" target="_blank"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-instagram" target="_blank"></i></a></li>
                    {{-- -}}<li><a href="#"><i class="fa fa-dribbble"></i></a></li>{{-- --}}

                </ul>
            </div>
            <div class="single-content">
                <h4>Important Links</h4>
                <ul class="links">
                    <li><a href="{{ url('about-us') }}">About Us</a></li>
                    <li><a href="{{ url('services') }}">Our Services</a></li>
                    <li><a href="{{ url('our-portfolio') }}">Portfolio</a></li>
                    {{-- -}}<li><a href="#">Pricing Plan</a></li>{{-- --}}
                    <li><a href="{{ url('news') }}">Blog & News</a></li>
                    <li><a href="{{ url('contact-us') }}">Contact us</a></li>
                </ul>
            </div>
        </div>
        <!--/ Sidebar Popup -->
    </header>
    <!--/ End Header -->

