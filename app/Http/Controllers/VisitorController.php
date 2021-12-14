<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Order;
use App\Models\Post;
use App\Models\Postmeta;
use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Slidershow;
use Laravel\Cashier\Cashier;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;
class VisitorController extends Controller
{
    //DISPLAYING Base64 images in HTML
    //<div>
    //  <p>Taken from wikpedia</p>
    //  <img src="data:image/png;base64, iVBORw0KGgoAAAANSUhEUgAAAAUA
    //    AAAFCAYAAACNbyblAAAAHElEQVQI12P4//8/w38GIAXDIBKE0DHxgljNBAAO
    //        9TXL0Y4OHwAAAABJRU5ErkJggg==" alt="Red dot" />
    //</div>
    public function contactstore(Request $request)
    {
        // Validate contact form data
        $validated = $request->validate([
            //'post_title' => 'required|unique:posts|min:2',
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);
        $validated['name'] = ''.$request->input('first_name'). ' '.$request->input('first_name').'';
        //$validated['subject'] = 'Message for'. $validated['name'];
        //$validated['subject'] = 'Message for'. $validated['name'];
        $validated['folder'] = 'Inbox';
        $validated['is_read'] = 0;
        $sendmessage = Contact::create($validated);
        return back()->with('success', ' '.$sendmessage->name. ', your message has been sent successfully! ');
    }

    public function watch()
    {
        return view('view_visitor.visitor_index', compact('slug'));
    }
    public function home($home)
    {
        // CONTACT **********************
        $contact_list = array('contact', 'contact-us', 'contact_us', 'contact.php', 'contact.html', 'contacts', 'contact-us.php', 'contact.pelo');
        // END CONTACT **********************
        //************************************************
        // HOME PAGE **********************
        $home_list = array('home','home.pelo','home.html','home.php', 'index', 'index.html', 'index.php', 'index.asp', 'index.pelo', 'accueil');
        // END HOME PAGE ***************************************
        //
        // PORTFOLIO PAGE **********************
        $portfolio_list = array('portfolio', 'our-portfolio', 'portfolio.html', 'portfolio.php', 'portfolio.asp', 'portfolio.pelo', 'portfolio.pelogroup');
        // END PORTFOLIO PAGE ***************************************
        if (in_array($home, $portfolio_list)) {
            return view('view_visitor.visitor_index');
        }

        if (in_array($home, $home_list)) {

            $title = 'PELO GROUP';
            $title_header = 'Pelo Group Limited, Web, E-commerce, Mobile App, SEO, Data Science';
            return view('view_visitor.visitor_index',  compact('title', 'title_header'))->with('home', $home);
        }
    }
    public function viewindex(Post $slug, Postmeta $postmeta, Request $request)
    {
        //$this->withoutExceptionHandling();
        $title = $slug->post_title;
        $title_header = ''.$slug->post_title. ' - Pelo Group Limited, Web, E-commerce, Mobile App, SEO, Data Science';
        /*
        $slug_exist = Post::where('slug', '=', $slug->slug)->first();
        if ($slug_exist === null) {
            // user doesn't exist
            $title = 'Ops';
            $title_header = '| Pelo Group Limited | Web | E-commerce | Mobile App | SEO | Data Science';
        }
        else
        {
            $title = 'Ops';
            $title_header = '| Pelo Group Limited | Web | E-commerce | Mobile App | SEO | Data Science';
        }
        */

        $mymages = DB::table('posts')
            ->where('post_mime_type', 'like', 'jp%')
            ->orWhere('post_mime_type', 'like', 'png')
            //->select('posts.*')
            ->inRandomOrder()
            ->limit(3)
            ->first();

        $mymage = $mymages->guid;

        // CONTACT **********************
        $contact_list = array('contact', 'contact-us', 'contact_us', 'contact.php', 'contact.html', 'contacts', 'contact-us.php', 'contact.pelo');
        // END CONTACT **********************
        //************************************************
        // HOME PAGE **********************
        $home_list = array('home','home.pelo','home.html','home.php', 'index', 'index.html', 'index.php', 'index.asp', 'index.pelo', 'accueil');
        // END HOME PAGE ***************************************
        //
        // PORTFOLIO PAGE **********************
        $portfolio_list = array('portfolio', 'our-portfolio', 'portfolio.html', 'portfolio.php', 'portfolio.asp', 'portfolio.pelo', 'portfolio.pelogroup');
        // END PORTFOLIO PAGE ***************************************


        $post_slug = $slug->slug;
        //

        $metas = DB::table('posts')
            ->join('postmetas', 'posts.id', '=', 'postmetas.post_id')
            ->where('posts.slug', 'like', $slug->slug)
            ->count();

        if (in_array($slug->slug, $contact_list)) {
            $title = 'Contact us';
            $title_header = 'Contact us - Pelo Group Limited | Web, E-commerce, Mobile App, SEO, Data Science';
            return view('view_visitor.visitor_contact', compact('title', 'title_header'));
            //abort(404);
        }
        if (in_array($request, $home_list)) {
            $title = 'Home';
            $title_header = 'Home - Pelo Group Limited - Web, E-commerce, Mobile App, SEO, Data Science';
            return view('view_visitor.visitor_index', compact('title', 'title_header'));
        }

        $portfolio_list = array('portfolio', 'our-portfolio', 'portfolio.html', 'portfolio.php', 'portfolio.asp', 'portfolio.pelo', 'portfolio.pelogroup');
        // END PORTFOLIO PAGE ***************************************
        if (in_array($slug->slug, $portfolio_list)) {
            return view('view_visitor.visitor_portfolio', compact('title', 'title_header'));
        }

        $faq_list = array('faq', 'FAQ', 'faq.htm', 'faq.php', 'frequently-asked-questions', 'frequently-asked-questions.php', 'frequently_asked_questions');
        // END PORTFOLIO PAGE ***************************************
        /*
        if (in_array($slug->slug, $faq_list)) {
            $test_slug = $slug->slug;
            $postmeta = DB::table('posts')
                ->join('postmetas', 'posts.id', '=', 'postmetas.post_id')
                //->where('posts.post_type', 'article')
                ->where('postmetas.post_parent_id', $slug->id)
                //->where('posts.slug', $slug->slug)
                ->select('posts.*')
                ->get();
            return view('view_visitor.visitor_faq', ['slug' => $slug, 'postmetas' => $postmeta, 'test_slug' => $test_slug])->with('i', (request()->input('page', 1) -1) *5);
        }
        */
        // END HOME************************
        if (in_array($slug->slug, $home_list)) {
            return view('view_visitor.visitor_index', compact('title', 'title_header'));
            //return redirect()->route('view.option');
            //return redirect()->route('view.option')->with('success', 'Post '.$post->post_title. ' created successfully! ');
        } else {
            if (($slug->post_type) == 'article') {
                //$id_category = $mycategories->post_parent_id;
                if ($metas > 0) {

                    $mycategories = DB::table('posts')
                        ->join('postmetas', 'posts.id', '=', 'postmetas.post_id')
                        ->where('posts.slug', 'like', $slug->slug)
                        ->select('postmetas.*')
                        ->first();

                    //$slugs = $mycategories->slug;
                    $id_category = $mycategories->post_parent_id;

                    $postmeta = DB::table('posts')
                        ->join('postmetas', 'posts.id', '=', 'postmetas.post_id')
                        ->where('posts.post_type', 'article')
                        ->where('postmetas.post_parent_id', $id_category)
                        ->select('posts.*')
                        ->get();
                    return view('view_visitor.visitor_view',compact('title', 'title_header'), ['slug' => $slug, 'postmetas' => $postmeta]);
                } else {
                    //abort(404);
                }
            } elseif (($slug->post_type) == 'page') {
                $postmeta = DB::table('posts')
                    ->where('post_type', 'like', $slug->post_type)
                    ->select('posts.*')
                    ->get();
                return view('view_visitor.visitor_view', compact('title', 'title_header'), ['slug' => $slug, 'postmetas' => $postmeta]);

            } elseif (($slug->post_type) == 'category') {
                //if ($metas > 0) {
                $mycategories = DB::table('posts')
                    ->join('postmetas', 'posts.id', '=', 'postmetas.post_parent_id')
                    ->where('posts.slug', 'like', $slug->slug)
                    ->select('postmetas.*')
                    ->first();
                //$slugs = $mycategories->slug;
                $id_category = $mycategories->post_parent_id;
                //$id_category = $mycategories->post_id;

                $postmeta = DB::table('posts')
                    ->join('postmetas', 'posts.id', '=', 'postmetas.post_id')
                    ->where('posts.post_type', 'article')
                    ->where('postmetas.post_parent_id', $id_category)
                    ->select('posts.*')
                    ->get();


                /*
                $postmeta = DB::table('posts')
                    ->where('id', $slug->id)
                ->select('posts.*')
                ->get();
                */
                return view('view_visitor.visitor_category', compact('title', 'title_header'), ['slug' => $slug, 'postmetas' => $postmeta, 'mymage' => $mymage]);
                //}


            }
            else
            {
                //abort(404);
            }


        }
    }

    public function pricing(Request $request, ProductCategory $productCategory)
    {

        /*
        $request->param;
        $request->input('param'); or
        request('param');
        If you only want to retrieve the value from the query string, you can use
        $request->query('param');
        */
        $slug = $request->slug;
        $check_product_category = ProductCategory::where('slug', $slug)->count();
        if($check_product_category) {


        $productCategory = ProductCategory::where('slug', $slug)->first();

        $title = $productCategory->title;
        $productCategoryContent = $productCategory->content;
        $title_header = 'Pricing - '.$title. ' - Pelo Group Limited, Web, E-commerce, Mobile App, SEO, Data Science';

        $productCategories = DB::table('product_categories')
            ->join('product_metas', 'product_categories.id', '=', 'product_metas.product_parent_id')
            ->join('products', 'products.id', '=', 'product_metas.product_id')
            ->where('product_categories.slug', $slug)
            ->select('products.*', 'product_categories.title', 'product_metas.*')
            ->orderBy('products.id')
            //->select('product_categories.*')
            ->get();
        return view('view_visitor.visitor_view_pricing', compact('slug','productCategories','title', 'title_header', 'productCategoryContent'));
        //return view('view_visitor.visitor_view_pricing', compact('title', 'title_header'));
        } else {
            abort(404);
        }
    }

public function billing(Request $request, \App\Models\Order $order)
{
    // REDIRECT TO THE FORM OF TYPING CUSTOMER'S BILLING DETAILS
    $slug = $request->slug;
    $check_product = \App\Models\Product::where('slug', $slug)->count();
    if($check_product) {
        $productPrint = \App\Models\Product::where('slug', $slug)->first();

        $productPrintName = $productPrint->product_name;
        $productPrintPrice = $productPrint->product_price;
        $product_currency = $productPrint->product_currency;
        $productPrintCurrency = '£';
        if ($product_currency === 'gbp') {
            $productPrintCurrency = '£';
        } elseif ($product_currency === 'usd') {
            $productPrintCurrency = '$';
        } elseif ($product_currency === 'cad') {
            $productPrintCurrency = '$';
        } elseif ($product_currency === 'eur') {
            $productPrintCurrency = '€';
        }
        //$productCategories = $productPrint;
        $title = $productPrintName;
        $productCategoryContent = $productPrint->product_description;

        $title_header = 'Pricing - ' . $title . ' - Pelo Group Limited, Web, E-commerce, Mobile App, SEO, Data Science';
        return view('view_visitor.visitor_view_order', compact('slug', 'productPrintName', 'productPrintPrice', 'productPrintCurrency', 'title', 'title_header', 'productCategoryContent'));
    } else {
        abort(404);
    }
}
// HERE WE CREATE AN ORDER
public function createOrder(Request $request)
{
    $slug = $request->slug;
    $check_product = \App\Models\Product::where('slug', $slug)->count();
    if($check_product) {
        $productPrint = \App\Models\Product::where('slug', $slug)->first();

        $productPrintName = $productPrint->product_name;
        //$productId = $productPrint->id;
        $productPrintPrice = $productPrint->product_price;
        $product_currency = $productPrint->product_currency;
        $productCurrency = $productPrint->product_currency;

        if ($product_currency === 'gbp') {
            $productPrintCurrency = '£';
        } elseif ($product_currency === 'usd') {
            $productPrintCurrency = '$';
        } elseif ($product_currency === 'cad') {
            $productPrintCurrency = '$';
        } elseif ($product_currency === 'eur') {
            $productPrintCurrency = '€';
        }

        /* NOT IN USE AS WE MANUALLY USE PROPER PHP WAY OF SESSION

        //$productCategories = $productPrint;
        if(isset($_COOKIE['php_customer_email'])) {
            //setcookie("php_paid_amount", $productPrintPrice, time()+3600); // 1hr = 3600 secs
        } else {

        }
        if (Cookie::has('laravel_customer_email')) {
            //Cookie::get('laravel_customer_email');
            //Cookie::queue('laravel_paid_amount', $productPrintPrice, 120);
        } else {

        }
        */
        $title = $productPrintName;
        //$productCategoryContent = $productPrint->product_description;
        $title_header = 'Pricing - ' . $title . ' - Pelo Group Limited, Web, E-commerce, Mobile App, SEO, Data Science';


        // Validate posted form data
        $validated = $request->validate([
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            //'first_name' => 'required|unique:posts|min:2',
            'email_address' => 'required|email|unique:customers,email',
            'telephone_number' => 'required',
            'BillingAddressCountry' => 'required',
            'address_line_1' => 'required',
            //'address_line_2' => 'required',
            'town' => 'required',
            'county_or_state' => 'required',
            'postcode_or_zip_code' => 'required',
            //'name_on_the_card' => 'required',
            //'file_upload' => 'image|mimes:jpg,png,jpeg,gif,svg|max:5000',
            //'g-recaptcha-response' => 'required|captcha',

        ]);
        $validated['name'] = $validated['first_name'] . ' ' . $validated['last_name'];
        $validated['phone'] = $validated['telephone_number'];
        $validated['email'] = $validated['email_address'];
        $validated['address'] = $validated['address_line_1'] . ' ' . $request->input('address_line_2') . ' ' . $validated['town'] . ' ' . $validated['county_or_state'] . ' ' . $validated['postcode_or_zip_code'];
        $country = $request->input('BillingAddressCountry');
        //$token_source = $request->input('stripeToken');
        //$token_source = $request->input('payment_id');

        //$validated['card_brand'] = $token_source;
        //$validated['card_holder'] = $validated['name_on_the_card'];
        //$validated['login'] = Auth::user()->id;

        //

        /*
        if (Cookie::has('laravel_paid_amount')) {
            Cookie::get('laravel_paid_amount');
        } else {
            Cookie::queue('laravel_paid_amount', $productPrintPrice, 120);
            //setcookie('paid_amount', 20000, time() + (86400 * 30), "/"); // 86400 = 1 day
            //setcookie("paid_amount", 20000, time()+3600); // 1hr = 3600 secs
        }
        */
        //Cookie::queue('laravel_customer_email', $validated['email'], 120);
        //Cookie::queue('laravel_paid_amount', $productPrintPrice, 120);
        
        // HERE WE ARE: USE PROPER PHP WAY OF SESSION (NOT LARAVEL WAY)
        session_start();
        //
        setcookie("customerEmail", "", time() - 3600); // HAHAHAHA LONG LASTING COOKIES 
        setcookie("customerEmail", $validated['email'], time()+3600); // 1hr = 3600 secs
        $_SESSION['customerEmail'] = $validated['email'];
        $_SESSION['customerName'] = $validated['name'];
        //setcookie("productPrintPrice", $productPrintPrice, time()+3600); // 1hr = 3600 secs
        //

        //
        setcookie("productPrintName", "", time() - 3600);
        setcookie("productPrintName", $productPrintName, time()+3600); // 1hr = 3600 secs
        $_SESSION['productPrintName'] = $productPrintName;
        //
        setcookie("productPrintPrice", "", time() - 3600);
        setcookie("productPrintPrice", $productPrintPrice, time() + 3600); // 1hr = 3600 secs
        $_SESSION['productPrintPrice'] = $productPrintPrice;
        //
        setcookie("productCurrency", "", time() - 3600);
        setcookie("productCurrency", $productCurrency, time()+3600); // 1hr = 3600 secs
        $_SESSION['productCurrency'] = $productCurrency;
        //productPrintPrice
        //Cookie::queue('productPrintName', $productPrintName, 120);
        //Cookie::queue('productPrintPrice', $productPrintPrice, 120);
        //$productPrintName = $productPrint->product_name;
        //$productPrintPrice = $productPrint->product_price;
        //$product_currency = $productPrint->product_currency;

        /*
        if(!isset($_COOKIE['php_paid_amount'])) {
            $paid_amount = 10000;
            setcookie("php_paid_amount", $productPrintPrice, time()+3600); // 1hr = 3600 secs
        } else {
            $paid_amount = $_COOKIE['php_paid_amount'];
        }
        */

        $peloCustomer = Customer::create($validated);
        setcookie("customerId", "", time() - 3600);
        //setcookie("customerId", $peloCustomer->id, time()+3600); // 1hr = 3600 secs
        $_SESSION['customerId'] = $peloCustomer->id;
        //$_SESSION['customerId'] = 1;
        setcookie("customerId", 1, time()+3600); // 1hr = 3600 secs
        //$productCurrency
        setcookie("productId", "", time() - 3600);
        setcookie("productId", $productPrint->id, time()+3600); // 1hr = 3600 secs
        $_SESSION['productId'] = $productPrint->id;

        return view('view_visitor.visitor_view_order_payment', compact('slug', 'productPrintName', 'productPrintPrice', 'productPrintCurrency', 'title', 'title_header'));
    } else {
        abort(404);
    }
}

public function chargeCustomer(Request $request) {

}

// HERE WE ARE CHARGING OUR CUSTOMER USING STRIPE
public function paymentSuccess(Request $request)
{
    //$title = $productPrintName;
    session_start();

    $title = 'Payment done!';
    //$productCategoryContent = $productPrint->product_description;
    $title_header = 'Pricing - ' . $title . ' - Pelo Group Limited, Web, E-commerce, Mobile App, SEO, Data Science';

    $paymentIntentId = $request->payment_Intent_Id;
    //\Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    //\Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    //$intent = \Stripe\PaymentIntent::retrieve($paymentIntentId);


    $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    $intent = $stripe->paymentIntents->retrieve(
        $paymentIntentId,
        []
    );

    //$payment_amount = $intent['amount'];
    $payment_amount = $intent['amount_received'];
    $charges = $intent['charges'];
    $charges = ['charges' => ['data' => ['payment_method_details' => 'last4']]];
    //$charges = $intent['charges']->data[0]->payment_method_details->last4;
    $charges = $intent['charges']->object;
    $charges = $intent['charges']->data[0]->payment_method_details->card->last4;
    $payment_method = $intent['charges']->data[0]->payment_method;
    $received_currency = $intent['charges']->data[0]->currency;
    $card_country = $intent['charges']->data[0]->payment_method_details->card->country;
    $card_network = $intent['charges']->data[0]->payment_method_details->card->network;

    $payment_type = $intent['charges']->data[0]->payment_method_details->type;
    $stripeCustomerId = $intent['charges']->data[0]->customer;

    $payment_status = $intent['status'];


    $productPrint = \App\Models\Product::where('id', $_SESSION['productId'])->first();
    $customerPrint = \App\Models\Customer::where('id', $_SESSION['customerId'])->first();

    //$validated['product_id'] = $_COOKIE['productId'];
    //$validated['customer_id'] = $_COOKIE['customerId'];
    //$validated['product_price'] = $_COOKIE['php_paid_amount'];
    //$validated['product_price_currency'] = $_COOKIE['productCurrency'];

    $validated['product_id'] = $productPrint->id;
    $validated['customer_id'] = $customerPrint->id;

    $validated['order_number'] = Str::random(8);
    $validated['order_quantity'] = 1;
    $validated['product_price'] = $productPrint->product_price;

    $validated['product_price_currency'] = $productPrint->product_currency;
    $validated['paid_amount_currency'] = $received_currency;
    $validated['paid_amount'] = $payment_amount;
    $validated['payment_status'] = $payment_status;
    //$validated['card_holder'] = $_SESSION['cardHolderName'];
    $validated['stripe_id'] = $paymentIntentId;
    $validated['stripe_customer_id'] = $stripeCustomerId;
    $validated['card_brand'] = $card_network;
    $validated['card_last_four'] = $intent['charges']->data[0]->payment_method_details->card->last4;;

$createdOrder = \App\Models\Order::create($validated);
$_SESSION['orderId'] = $createdOrder->id;
//
    $details = [
        'title' => $title,
        'title_header' => $title_header,
        'body' => 'This is for testing email using smtp'
    ];
//*
    $order = DB::table('orders')
        ->join('products', 'products.id', '=', 'orders.product_id')
        //->where('products.id', '=', $_SESSION['orderId'])
        ->where('orders.id', '=', $_SESSION['orderId'])
        ->select('products.*', 'orders.*')
        ->first();
//*/
//$order = \App\Models\Order::where('id', $_SESSION['orderId']);
/*
    $orderNumber = $order->order_number;
    $orderPrice = $order->product_price;
    $orderName = $order->product_name;
    $productPrintCurrency = $order->product_price_currency;
    $orderStatus = $order->payment_status;
    $cardLastFour = $order->card_last_four;
    $dateTransaction = date("d/m/Y H:i:s",strtotime($order->created_at));
    //$date_rapport=date("d/m/Y H:i:s", strtotime($donnees['date_rapport']));
    $customerName = $_SESSION['customerName'];
*/
    //return view('view_visitor.visitor_view_order_success', compact('slug', 'productPrintName', 'productPrintPrice', 'productPrintCurrency', 'title', 'title_header'));


    // WHEN EVERYTHING IS CREATED AND SAVE INTO MYSQL TABLE, THEN SEND CONFIRMATION EMAIL TO OUR CUSTOMER

    Mail::to($customerPrint->email)->send(new OrderShipped($order));

    return view('view_visitor.visitor_view_order_success', compact('title', 'title_header', 'intent', 'payment_amount', 'payment_status', 'charges', 'payment_method', 'stripeCustomerId'))
            ->with([
                'orderName' => $productPrint->product_name,
                //'orderNumber' => $productPrint->order_number,
                'orderNumber' => $order->order_number,
                'orderNumber' => $order->order_number,
                'orderPrice' => $order->product_price,
                'orderName' => $order->product_name,
                'productPrintCurrency' => $order->product_price_currency,
                'orderStatus' => $order->payment_status,
                'cardLastFour' => $order->card_last_four,
                'dateTransaction' => date("d/m/Y H:i:s",strtotime($order->created_at)),
                'customerName' => $_SESSION['customerName'],
            ]);

}




}
