<!-- Start Error Area-->
<section class="error">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 offset-lg-1 col-md-6 col-12">
                <div class="error-inner">
                    <h4>500</h4>
                    <h2>Internal Server <span>Error!</span></h2>
                    <p>It looks like the server encountered an Internal error and was unable to complete your request. Please try to contact us and let us know about it.</p>
                    <div class="button">
                        <a href="{{ route('view.index', 'home') }}" class="bizwheel-btn"><i class="fa fa-long-arrow-left"></i>Go to home</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <img src="{{ asset('t_visitor/pelotheme1/img/error-img.png') }}" alt="#">
            </div>
        </div>
    </div>
</section>
<!--/ End Error Area-->
