<!-- Blog Layout -->
<section class="blog-layout news-default section-space">
    <div class="container">
        <div class="row ">



            {{-- --}}@foreach($postmetas as $postmeta){{-- --}}

            <div class="col-lg-4 col-md-6 col-12">
                <!-- Single Blog -->
                <div class="single-news ">
                    <div class="news-head overlay">
                        @php
                            $mymages = DB::table('posts')
                                        ->where('post_mime_type', 'like', 'jp%')
                                        ->orWhere('post_mime_type', 'like', 'png')
                                        ->inRandomOrder()
                                        ->limit(3)
                                        ->first();
                            $mymage = $mymages->guid;
                        @endphp

                        {{-- -}
                        @if(($postmeta->post_mime_type)=== '')

                        <img src="{{ url('storage/app/public/'.$mymage.'') }}" alt="#">
                        @else
                            <img src="{{ url('storage/app/public/'.$postmeta->guid.'') }}" alt="#">
                        @endif

                        {{-- -}}<img src="https://via.placeholder.com/700x530" alt="#">{{-- --}}


                        @if((($postmeta->post_mime_type)=== '') OR (($postmeta->slug)=== 'frequently-asked-questions'))
                            {{-- -}}<img src="{{ url('storage/app/public/'.$postmeta->guid.'') }}" alt="#">{{-- --}}

                            {{-- -}}<img src="https://via.placeholder.com/750x400" alt="#"> {{-- --}}
                        @else
                            {{-- -}}<img src="{{ url('storage/app/public/'.$postmeta->guid.'') }}" alt="#">{{-- --}}
                            {{-- --}}<img src="{{ 'data:image/'.$postmeta->post_mime_type.';base64,'.$postmeta->post_mine_base64.'' }}" alt="#">{{-- --}}
                        @endif


                        <ul class="news-meta">
                            <li class="author"><a href="#"><i class="fa fa-user"></i>{{ $postmeta->post_type }}</a></li>
                            <li class="date"><i class="fa fa-calendar"></i>{{ \Carbon\Carbon::parse($postmeta->updated_at)->diffForHumans() }}</li>
                            <li class="view"><i class="fa fa-comments"></i>{{ $postmeta->post_comment_count }}</li>
                        </ul>
                    </div>
                    <div class="news-body">
                        <div class="news-content">
                            <h3 class="news-title"><a href="{{ route('view.index', [$postmeta->slug]) }}">{{ $postmeta->post_title }}</a></h3>
                            <div class="news-text"><p>{{ $postmeta->post_caption }}</p></div>
                            <a href="{{ route('view.index', [$postmeta->slug]) }}" class="more">Continue reading <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                <!--/ End Single Blog -->
            </div>
            @endforeach





        </div>
        {{-- -}}
        <div class="row">
            <div class="col-12">
                <!-- Pagination -->
                <div class="pagination-plugin">
                    <ul class="pagination-list">
                        <li class="prev"><a href="#">Prev</a></li>
                        <li class="page-numbers"><a href="#">1</a></li>
                        <li class="page-numbers current"><a href="#">2</a></li>
                        <li class="page-numbers"><a href="#">3</a></li>
                        <li class="next"><a href="#">Next</a></li>
                    </ul>
                </div>
                <!--/ End Pagination -->
            </div>
        </div>
        {{-- --}}
    </div>
</section>
