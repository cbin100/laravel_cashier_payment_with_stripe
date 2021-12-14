<!-- Header -->
<header class="header">
    <!-- Topbar -->
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <!-- Top Contact -->
                    <div class="top-contact">

<div class="single-contact"><i class="fa fa-phone"></i>Phone: +(600) 125-4985-214</div>
<div class="single-contact"><i class="fa fa-envelope-open"></i>Email: info@yoursite.com</div>
<div class="single-contact"><i class="fa fa-clock-o"></i>Opening: 08AM - 09PM</div>
</div>
<!-- End Top Contact -->
</div>
<div class="col-lg-4 col-12">
<div class="topbar-right">
<!-- Social Icons -->
<ul class="social-icons">
<li><a href="#"><i class="fa fa-facebook"></i></a></li>
<li><a href="#"><i class="fa fa-twitter"></i></a></li>
<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
</ul>
<div class="button">
<a href="contact.html" class="bizwheel-btn">Get a Quote</a>
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
        <a href="index.html">
            <img src="{{ asset('t_visitor/bizwheel/img/logo.png') }}" alt="#">
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
                        @php
                            use Illuminate\Support\Facades\DB;

                            use App\Models\Post;
                            use App\Models\Postmeta;
                            /*
                            $menunavbars = DB::table('posts')
                                               ->where('post_type', 'menu')
                                               ->where('post_status', 'publish')
                                               ->where('post_name', 'nav-right')
                                               ->select('posts.*')
                                               ->get();
                            */
                            $menunavbars = DB::select('select * from posts where post_type = ? and post_status = ? and post_name = ?', ['menu', 'publish', 'nav-right']);
                                /*$menunavbars = DB::table('posts')
                                ->where('post_type', 'article')
                                ->orWhere('post_type', 'page')
                                ->orWhere('post_type', 'category')
                                //->select('posts.*', 'users.name')
                                ->get();
                                */

                            foreach ($menunavbars as $menunavbar) {
                                $title = $menunavbar->post_title;
                                $slugs = $menunavbar->slug;
                                $ids = $menunavbar->id;

                                $submenu_check = DB::table('posts')
                                                //->join('postmetas', 'posts.id', '=', 'postmetas.post_parent_id')
                                                ->join('postmetas', 'posts.id', '=', 'postmetas.post_id')
                                                ->where('posts.post_type', 'menu')
                                                //->where('postmetas.post_parent_id', $ids)
                                                ->where('postmetas.post_id', $ids)
                                                ->where('posts.post_status', 'publish')
                                                ->where('posts.post_name', 'nav-right')
                                                ->count();


                                if ($submenu_check > 0) {

                                    echo '<li class="icon-active"><a href="#"> Loo ' .$title.'</a>';
                                            echo '<ul class="sub-menu">';

                                    $submenus = DB::table('posts')
                                                ->join('postmetas', 'posts.id', '=', 'postmetas.post_id')
                                                //->join('postmetas', 'posts.id', '=', 'postmetas.post_parent_id')
                                                //->where('postmetas.post_parent_id', $ids)
                                                ->where('postmetas.post_id', $ids)
                                                ->where('posts.post_status', 'publish')
                                                ->where('posts.post_name', 'nav-right')
                                                ->where('posts.post_type', 'menu')
                                                //->select('postmetas.*')
                                                ->get();

                                    foreach ($submenus as $submenu) {
                                                echo '<li><a href="'.route('menus.update', $submenu->slug).'"> '.$submenu->post_title.'</a></li>';
                                            }
                                            echo '</ul>';
                                    echo '</li>';
                                }
                                else {
                                      echo '<li> <a href="'.route('menus.update', $slugs).'"> '.$title.' '.$submenu_check.' </a></li>';
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
            <h4>About Bizwheel</h4>
            <p>The main component of a healthy environment for self esteem is that it needs be nurturing. It should provide unconditional warmth.</p>
            <!-- Social Icons -->
            <ul class="social">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
            </ul>
        </div>
        <div class="single-content">
            <h4>Important Links</h4>
            <ul class="links">
                <li><a href="#">About Us</a></li>
                <li><a href="#">Our Services</a></li>
                <li><a href="#">Portfolio</a></li>
                <li><a href="#">Pricing Plan</a></li>
                <li><a href="#">Blog & News</a></li>
                <li><a href="#">Contact us</a></li>
            </ul>
        </div>
    </div>
    <!--/ Sidebar Popup -->
</header>
<!--/ End Header -->

