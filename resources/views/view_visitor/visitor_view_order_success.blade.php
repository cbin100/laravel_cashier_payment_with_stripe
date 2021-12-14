@section('title', 'New Post')
@extends('view_visitor.layout_visitor')

@section('content_visitor')

    {{-- }}
   <!-- Breadcrumb -->
   {{-- --}}@include('view_visitor.view_breadcrumb') {{-- --}}
    <!-- / End Breadcrumb -->
    {{-- --}}

    {{-- -}}
    <!-- Features Area -->
    @include('view_visitor.visitor_view_order_payment_form')
    <!--/ Features Area -->
    {{-- --}}



    <!-- Contact Us -->
    <section class="contact-us section-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-12">
                    <!-- Contact Form -->
                    <div class="contact-form-area m-top-30">
                        <h4>{{$title}}</h4>

                        <p>
                            Your TEST MODE payment has been received.
                        </p>
                        <p>
                            Here are your payment details:
                        </p>

                        {!! '<p>Customer: '.$customerName.'</p><p> Order: '. $orderName. '</p><p>Order Reference number: '.$orderNumber. '</p><p>Paid amount: '.$productPrintCurrency.''. number_format($orderPrice, 0). '</p><p>Date and Time of the transaction: '.$dateTransaction.'</p><p>Last four debit/Credit Card: '.$cardLastFour.'</p><p>Status: '. $orderStatus. '</p>' !!}



                    </div>
                    <!--/ End contact Form -->
                </div>





                <div class="col-lg-5 col-md-5 col-12">
                    <br class="contact-box-main m-top-30">
                    <p class="contact-title">
                        {{-- -}}<h2>Order: {{ $productPrintName.' '.$productPrintCurrency.''.number_format($productPrintPrice, 0) }}</h2>{{-- --}}
                        Dear <b>customer,</b>

                    </p>

                    <p>
                        Pelo Group Limited is registered in England and Wales under company number 13268133 and with our registered office at 79 Penny Meadow, Ashton Under-Lyne, OL6 6EL, United Kingdom.
                    </p>
                    <p>
                        <b>As one-off payment, we did not save your debit/credit card details.</b>
                        Once we receive your payment, we will contact you as soon as possible (within 24 hours). Your ordered product/service will be available as soon as we get all requirements (logo, images, texts, etc.)
                    </p>

                    </br>
                    <p>
                        <b>Not found the right package for you?</b>
                        For any tailored package, please <a href="{{ route('contact') }}"> <b style="color: #0000ff">get in touch here</b>. </a>

                    </p>

                    <!--/ End Single Contact -->

                </div>
            </div>
        </div>
        </div>
    </section>
    <!--/ End Contact Us -->










    {{-- -}}
    <!-- Call To Action -->
    @include('view_visitor.call_to_action')
    <!--/ Call To Action -->
    {{-- --}}
    {{-- -}}
    <!-- Latest Blog -->
    @include('view_visitor.index_blog')
    <!--/ Latest Blog -->
    {{-- --}}
    <!-- Client Area -->
    {{-- }}
    @include('view_visitor.index_client')
    {{-- --}}
    <!--/ Client Area -->

    {{-- --}}
    <!-- Call To Action -->
    @include('view_visitor.call_to_contact')
    <!--/ Call To Action -->
    {{-- --}}

    {{-- -}}
    <!-- Counterup -->
    @include('view_visitor.index_counterup')
    <!--/ Counterup -->
    {{-- --}}
@endsection

