
<!-- Pricing Plan -->
<section class="pricing section-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                <div class="section-title default text-center">
                    <div class="section-top">
                        <h1><span>Pricing Plan</span><b> {{ $title }}</b></h1>
                    </div>
                    <div class="section-bottom">
                        <div class="text pl-4 pr-4 text-left">
                            {!! $productCategoryContent !!}
                            {{-- -}}
                            <p>
                                Lorem Ipsum Dolor Sit Amet, Conse Ctetur Adipiscing Elit, Sed Do Eiusmod Tempor Ares Incididunt Utlabore. Dolore Magna Ones Baliqua
                            </p>
                            {{-- --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">


           {{-- --}} @foreach ($productCategories as $productCategory) {{-- --}}
            <div class="col-lg-4 col-md-4 col-12">
                <!-- Single pricing -->
                <div class="single-pricing">
                    <!-- Price Head -->
                    <div class="price-head">
                        @if ((($productCategory->product_id) == 4) OR (($productCategory->product_id) == 7))
                        <div class="p-best"><p>Best Plan<span>25% off</span></p></div>
                        @endif
                        <h4 class="small-title"> {{ $productCategory->product_name }}<span>{{ $productCategory->product_caption }}</span></h4>
                        <div class="icon-head">
                            <i class="fa fa-bicycle"></i>
                        </div>
                    </div>
                    @php
                        $product_currency = $productCategory->product_currency;
                        //$productPrintCurrency = '£';
                        if ($product_currency === 'gbp') {
                            $productPrintCurrency = '£';
                        } elseif ($product_currency === 'usd') {
                            $productPrintCurrency = '$';
                        } elseif ($product_currency === 'cad') {
                            $productPrintCurrency = '$';
                        } elseif ($product_currency === 'eur') {
                            $productPrintCurrency = '€';
                        }
                    @endphp
                    <h2 class="price"><span><b>{{ $productPrintCurrency }}</b>{{ number_format($productCategory->product_price, 0) }}</span></h2><b class="renew">VAT included</b> (No hidden fees)</h2>

                        <ul class="price-list pl-4 pr-4 text-left">
                        {!! $productCategory->product_description !!}
                        </ul>

                    {{-- -}}
                    <ul class="price-list">
                        <li>01 Free website</li>
                        <li>Unlimited disk spaces</li>
                        <li>Creative design</li>
                        <li>Free consulting service</li>
                        <li>24/7 live support</li>
                        <li>99% Uptime gurantee</li>
                    </ul>
                    {{-- --}}
                    <div class="button">
                        <a class="bizwheel-btn theme-1" href="{{ route('billing', [$productCategory->slug]) }}">Order Now</a>
                    </div>
                </div>
                <!--/ End Single pricing -->
            </div>
            {{-- --}}
            @endforeach

            {{-- --}}


            {{-- -}}
            <div class="col-lg-4 col-md-4 col-12">
                <!-- Single pricing -->
                <div class="single-pricing active">
                    <!-- Price Head -->
                    <div class="price-head">
                        <div class="p-best"><p>Best Plan<span>25% off</span></p></div>
                        <h4 class="small-title">Medium<span>Great for medium business</span></h4>
                        <div class="icon-head">
                            <i class="fa fa-bicycle"></i>
                        </div>
                    </div>
                    <h2 class="price"><span><b>$</b>39</span><b class="renew">Monthly</b></h2>
                    <ul class="price-list">
                        <li>01 Free website</li>
                        <li>Unlimited disk spaces</li>
                        <li>Creative design</li>
                        <li>Free consulting service</li>
                        <li>24/7 live support</li>
                        <li>99% Uptime gurantee</li>
                    </ul>
                    <div class="button">
                        <a class="bizwheel-btn theme-1" href="contact.html">Buy Now</a>
                    </div>
                </div>
                <!--/ End Single pricing -->
            </div>
            <div class="col-lg-4 col-md-4 col-12">
                <!-- Single pricing -->
                <div class="single-pricing">
                    <!-- Price Head -->
                    <div class="price-head">
                        <h4 class="small-title">Starter<span>Great for small business</span></h4>
                        <div class="icon-head">
                            <i class="fa fa-bicycle"></i>
                        </div>
                    </div>
                    <h2 class="price"><span><b>$</b>79</span><b class="renew">Monthly</b></h2>
                    <ul class="price-list">
                        <li>01 Free website</li>
                        <li>Unlimited disk spaces</li>
                        <li>Creative design</li>
                        <li>Free consulting service</li>
                        <li>24/7 live support</li>
                        <li>99% Uptime gurantee</li>
                    </ul>
                    <div class="button">
                        <a class="bizwheel-btn theme-1" href="contact.html">Buy Now</a>
                    </div>
                </div>
                <!--/ End Single pricing -->
            </div>
            {{-- --}}

        </div>
    </div>
</section>
<!--/ End Pricing Plan -->

