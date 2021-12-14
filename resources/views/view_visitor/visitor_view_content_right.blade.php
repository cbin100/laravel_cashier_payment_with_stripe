<div class="col-lg-4 col-12">
    <!-- Service Sidebar -->
    {{-- -}}<br/><br/><br/> {{-- --}}
    <div class="service-sidebar">
        <!-- Single Sidebar -->
        <div class="service-single-sidebar widget">
            <h2 class="widget-title">Related to  {{ $slug->post_title }} {{-- -}}id= {{ $id_cat }} {{-- --}}</h2>
            <div class="menu-service-menu-container">
                <!-- Service Menu -->
                <ul id="menu-service-menu" class="menu">
{{-- -}}
                @php
                    $metas = DB::table('posts')
                    ->join('postmetas', 'posts.id', '=', 'postmetas.post_id')
                    ->where('posts.slug', 'like', $slug->slug)
                    //->where('posts.post_type', '=', 'category')
                    ->count();
                    //->get();
                    //*/
                    if ($metas> 0) {
                    $mycategories = DB::table('posts')
                    ->join('postmetas', 'posts.id', '=', 'postmetas.post_id')
                    //->select(DB::raw('count(*) as user_count, posts.slug, posts.id, posts.post_content'))
                    ->where('posts.post_type', 'category')
                    ->where('posts.slug',  'like', $slug->slug)
                    //->groupBy('posts.slug', 'posts.id', 'posts.post_content')
                    ->select('posts.*')
                    ->first();
                    $slug = $mycategories->slug;
                    $id_category = $mycategories->id;
                    //
                    $postmeta = DB::table('posts')
                    ->join('postmetas', 'posts.id', '=', 'postmetas.post_id')
                    ->where('posts.post_type', 'article')
                    ->where('postmetas.post_parent_id', $id_category)
                    ->select('posts.*')
                    ->get();
                    }
            @endphp
                    {{-- --}}
                    {{-- --}}
                    @foreach($postmetas as $postmeta)
                    {{-- -}}<li class="active"><a href="service-single.html">Business Strategy</a></li>{{-- --}}

                    <li><a href="{{ route('view.index', [$postmeta->slug]) }}">{{ $postmeta->post_title }}</a></li>
                    @endforeach
                    {{-- --}}
                    {{-- -}}
                    <li><a href="service-market.html">Market Research</a></li>
                    <li><a href="service-advertise.html">Simply Adertisement</a></li>
                    <li><a href="service-design.html">Trend Design</a></li>
                    <li><a href="service-marketing.html">Digital Marketing</a></li>
                    {{-- --}}
                </ul>
            </div>
        </div>
        <!-- Single Sidebar -->
        <div class="service-single-sidebar widget">
            <h2 class="widget-title">Fill the form</h2>
            <div class="contact-form-area service">
                <!-- Service Form -->
                <form class="form" method="POST" action="{{ route('contact.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="icon"><i class="fa fa-user"></i></div>
                                <input type="text" name="first_name" class="@error('first_name') is-invalid @enderror" placeholder="Full Name">
                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <div class="icon"><i class="fa fa-user"></i></div>
                                <input type="text" name="last_name" class="@error('last_name') is-invalid @enderror" placeholder="Full Name">
                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <div class="icon"><i class="fa fa-envelope"></i></div>
                                <input type="email" name="email" class="@error('email') is-invalid @enderror" placeholder="Your Email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>
                        {{-- --}}
                        <div class="col-12">
                            <div class="form-group">
                                <div class="icon"><i class="fa fa-tag"></i></div>
                                {{-- -}}<input type="text" name="subject" placeholder="Type Subject"> {{-- --}}

                                <select id="subject" name="subject" class="form-control select2" placeholder="Select a subject" style="width: 100%;">
                                    {{-- -}}<option value="publish" selected="selected">----</option>{{-- --}}
                                    {{-- --}}<option value="">---</option>{{-- --}}
                                    <option value="Web Design">Web Design</option>
                                    <option value="E-commerce">E-commerce</option>
                                    <option value="Redesign">Redesign</option>
                                    <option value="Mobile App">Mobile App</option>
                                    <option value="SEO">SEO</option>
                                    <option value="Data Analytic">Data Analytic</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>

                        {{-- --}}
                        <div class="col-12">
                            <div class="form-group">
                                <div class="icon"><i class="fa fa-pencil"></i></div>
                                <textarea type="textarea" name="message" rows="5"></textarea>
                            </div>
                        </div>

                        <div class="col-12">
                            <p style="text-align: center">
                                By submitting this form you agree to our
                                <a href="{{ route('view.index', 'privacy-cookies-policy') }}"><strong style="color:blue">Privacy Policy</strong></a> and
                                <a href="{{ route('view.index', 'terms-conditions') }}"><strong style="color:blue">T&Cs</strong>.</a>
                            </p>
                            <div class="form-group button">
                                <button type="submit" class="bizwheel-btn theme-2">Send Now</button>
                            </div>

                            <!-- HERE THE DIV FOR NOTIFICATION MESSAGE -->
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <p>{{ $message }}</p>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if ($message = Session::get('unauthorised'))
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                                    <p>{{ $message }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </form>
                <!--/ End Service Form -->
            </div>
        </div>
    </div>
    <!--/ End Service Sidebar -->
</div>
