<?php

namespace App\Http\Controllers;

//use http\Cookie;
use App\Models\Product;
use App\Models\ProductMeta;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Cashier\Cashier;
use App\Models\User;
use App\Models\Customer;
use Laravel\Cashier\Exceptions\IncompletePayment;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class EcommerceController extends Controller
{
    //
    public function customers_create(User $user)
    {
        //return view('view_admin.checkout');
        return view('view_admin.customer_create');
        /*
        $options = [
            'name' => 'Taylor Mc',
            'email' => 'no@pelogroup.net',
            'description' => 'My first customer',
            'invoice_settings' => [
                'custom_fields' => null,
                'default_payment_method' => null,
                'footer' => null,
            ],
            'phone' => '074888888'
        ];
        //$stripeCustomer = $user->createAsStripeCustomer();
        $stripeCustomer = $user->createAsStripeCustomer($options);
        */
    }

    public function create_checkout_session(Customer $customer, Request $request)
    {
        $api_error = '';
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
            'name_on_the_card' => 'required',
            //'file_upload' => 'image|mimes:jpg,png,jpeg,gif,svg|max:5000',

        ]);
        $validated['name'] = $validated['first_name'] . ' ' . $validated['last_name'];
        $validated['phone'] = $validated['telephone_number'];
        $validated['email'] = $validated['email_address'];
        $validated['address'] = $validated['address_line_1'] . ' ' . $request->input('address_line_2') . ' ' . $validated['town'] . ' ' . $validated['county_or_state'] . ' ' . $validated['postcode_or_zip_code'];
        $country = $request->input('BillingAddressCountry');
        //$token_source = $request->input('stripeToken');
        $token_source = $request->input('payment_id');

        $validated['card_brand'] = $token_source;
        $validated['card_holder'] = $validated['name_on_the_card'];
        //$validated['login'] = Auth::user()->id;
        //
        //if Coolie Not called in use use Illuminate\Support\Facades\Cookie;.... then use the bellow....
        /*
        public function setCookie(Request $request) {
            Cookie::queue('name', $request->test, 10);
            return view('home');
        }
        */
        //
        if (Cookie::has('login_id')) {
            Cookie::get('login_id');
        } else {
            //Cookie::queue('login_id', Auth::id(), 120);
            Cookie::make('login_id', Auth::id(), 120);
            //$login_id = Cookie::queue('login_id', Auth::id(), 120);
        }
        //
        if (Cookie::has('customer_email')) {
            Cookie::get('customer_email');
        } else {
            Cookie::queue('customer_email', $validated['email'], 120);
        }
        //
        if (Cookie::has('paid_amount')) {
            Cookie::get('paid_amount');
        } else {
            //Cookie::queue('paid_amount', 20000, 120);
            //setcookie('paid_amount', 20000, time() + (86400 * 30), "/"); // 86400 = 1 day
            setcookie("paid_amount", 20000, time()+3600); // 1hr = 3600 secs
        }
        /*********FROM PURE PHP ***************
         * DESTROY OR DELETE A COOLIE
         * $cookie = Cookie::forget('cookieName');
         *
         * Set the cookie forever ************************
         * $cookie = Cookie::forever('name', 'value');
         *
         * $cookie_name = "user";
         * $cookie_value = "John Doe";
         * setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
         *
         * if(!isset($_COOKIE[$cookie_name])) {
         * echo "Cookie named '" . $cookie_name . "' is not set!";
         * } else {
         * echo "Cookie '" . $cookie_name . "' is set!<br>";
         * echo "Value is: " . $_COOKIE[$cookie_name];
         * }
         *
         */
        if (Session::has('user_id')) {
            Session::get('user_id');
        } else {
            $request->session()->put('user_id', Auth::id()); // Via a request instance...
            //OR
            //session(['login' => Auth::id()]);
            //OR
            //Session::flash('login', Auth::id());
        }
        if (Session::has('paid_amount')) {
            Session::get('paid_amount');
        } else {
            //$request->session()->put('paid_amount', 20000); // Via a request instance...
            //OR
            session(['paid_amount' => 80000]);
            //OR
            //Session::flash('paid_amount', 20000);
        }
        session(['paid_amount' => 80000]);
        setcookie('paid_amount', 98000, time() + (86400 * 30), "/"); // 86400 = 1 day

        Session::flash('paid_amount', 20000);
        $_SESSION['paid_amount'] = 20000;

        $validated['login'] = Auth::id(); //

        //$request->session()->save();
        /*
         * // Via a request instance...
        $request->session()->put('key', 'value');
        //
        // Via the global "session" helper...
        session(['key' => 'value']);
        $request->session()->push('user.teams', 'developers'); // to push a new value onto a session value that is an array
        $value = $request->session()->pull('key', 'default'); //will retrieve and delete an item from the session

         */

        //Customize $options from the Cashier's method ==> ManagesCustomer.php
        $options = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'description' => 'Test customer creation',
            'invoice_settings' => [
                'custom_fields' => null,
                'default_payment_method' => null,
                'footer' => null,
            ],
            'phone' => $validated['phone'],
            //'source' => $_POST['stripeToken'],
            'source' => $token_source,
            //'billing_details' => [
            'address' => [
                'line1' => $validated['address_line_1'],
                'line2' => $request->input('address_line_2'),
                'city' => $validated['town'],
                'country' => $country,
                'state' => $validated['county_or_state'],
                'postal_code' => $validated['postcode_or_zip_code'],
            ],
            //],
        ];

        //Customize $options from the Cashier's method ==> ManagesCustomer.php

        // Add customer to stripe
        try {


            $stripeCustomer = $customer->createAsStripeCustomer($options);
            // retrieve customer info (ID, ...) from Stripe
            //$validated['stripe_id'] = $stripeCustomer->id;

            //$this->name = $customer->name;
            //$this->email = $customer->email;
            //$this->password = Hash::make('xxxxxxxx');

        } catch (Exception $e) {
            $api_error = $e->getMessage();
        }
        $paymentMethod = $customer->defaultPaymentMethod();

        //$validated['card_last_four'] = $stripeCustomer->sources->data[0]->last4;
        // Inserting Customer's details
        //Customer::create($validated);
        return view('view_admin.update-payment-method', [
            'intent' => $customer->createSetupIntent()
        ]);

        // End Inserting Customer's details
        /*
        //return $request->customer()->redirectToBillingPortal();
        try {
            $payment = $customer->charge(100, $paymentMethod);
        } catch (Exception $e) {
            $api_error = $e->getMessage();
        }
        */


    }

    public function createPayment(Customer $customer, Request $request)
    {
        $validated = $request->validate([
            'cardHolderName' => 'required|min:2',
        ]);

        //$token_source = $request->input('stripeToken');
        //$validated['card_brand'] = $token_source;
        $validated['card_holder'] = $validated['cardHolderName'];
        //$options = ['source' => $token_source];
        //$stripeCustomer = $customer->updateStripeCustomer($options);
        $stripeCharge = $request->customer()->charge(100, $request->paymentMethodId);
        $customer->update($validated);

    }

    public function customerCreatePayment(Customer $customer, Request $request)
    {

        //require 'vendor/autoload.php';
        include('../vendor/stripe/stripe-php/init.php');

// This is your real secret API key.
        \Stripe\Stripe::setApiKey('your_real_secret_API_key');


        function calculateOrderAmount(array $items): int
        {
            // Replace this constant with a calculation of the order's amount
            // Calculate the order total on the server to prevent
            // customers from directly manipulating the amount on the client
            return 50000;
        }

        header('Content-Type: application/json');

        try {
            // retrieve JSON from POST body
            //$json_str = file_get_contents('php://input');
            //$json_obj = json_decode($json_str);

            $paymentIntent = \Stripe\PaymentIntent::create([
                //'amount' => calculateOrderAmount($json_obj->items),
                'amount' => 300,
                //'currency' => 'usd',
                'currency' => 'gbp',
            ]);

            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];

            echo json_encode($output);
        } catch (Error $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }


        /*
            try {
            $token_source = $request->input('payment_id');
            //$paymentMethod = $customer->defaultPaymentMethod();
            //$checkout = $customer->charge(1200, ['source' => $token_source]);
            $checkout = $customer->charge(1200, $token_source);

            //return view('view_visitor.visitor_view');
            return redirect()->back();

            }catch (IncompletePayment $exception) {
                return redirect()->route(
                    'cashier.payment',
                    [$exception->payment->id, 'redirect' => route('view.home')]
                );
            }
        */

    }

    public function categoryProductCreate()
    {
        return view('view_admin.product_category_create');
    }

    public function categoryProductStore(Request $request)
    {
        // Validate posted form data
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'parent_category' => 'required'
        ]);
        //$validated['post_title'] = $validated['title'];
        //$validated['post_title'] = $request->input('title');
        $validated['user_id'] = Auth::user()->id;
        // Create slug from title
        $validated['slug'] = Str::slug($validated['title'], '-');
        if ($request->has('parent_category')) {
            $post_parent_id = $request->input('parent_category');
            $validated['parent_category'] = $post_parent_id;
        } else {
            $post_parent_id = 0;
        }
        $validated['parent_category'] = $post_parent_id;
        //******** INSERTING INPUT INTO posts TABLE **********************
        $post = ProductCategory::create($validated);

        return back()->with('success', 'Category created successfully.');

    }

    public function categoryProductIndex()
    {
        //$posts = Post::latest()->paginate(5);
        $productcategories = DB::table('product_categories')
            ->join('users', 'product_categories.user_id', '=', 'users.id')
            ->select('product_categories.*', 'users.name')
            ->get();


        return view('view_admin.product_category_index', compact('productcategories'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function categoryProductDestroy(ProductCategory $category)
    {
        $user = ProductCategory::where('user_id', '=', (Auth::user()->id))->first();
        if (($user === null) and ((Auth::user()->permission) > (2))) {
            return back()->with('unauthorised', 'You are not authorised to update this post.');
        } else {
            //**************DELETE POSTMETAS*********************
            //Storage::disk('public')->delete('pelouploads/'.$post->post_name);
            //OR
            Storage::disk('public')->delete($category->guid);
            //Storage::disk('public')->delete('pelouploads/'.$post->guid);
            //Storage::disk('public')->delete($post->guid);
            //************DELETE POST********************************************************
            $category->delete();
            return back()->with('success', ' ' . $category->title . ' deleted successfully.');
        }
    }

    public function categoryProductEdit(ProductCategory $category)
    {
        return view('view_admin.product_category_edit', compact('category'));
    }

    public function categoryProductUpdate(ProductCategory $category, Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'parent_category' => 'required'
        ]);
        $validated['slug'] = Str::slug($validated['title'], '-');
        $user = ProductCategory::where('user_id', '=', (Auth::user()->id))->first();
        if (($user === null) and ((Auth::user()->permission) > (2))) {
            return back()->with('unauthorised', 'You are not authorised to update this post.');
        } else {
            $category->update($validated);
            return redirect(route('categoryProductIndex'))->with('success', 'Category ' . $category->title . 'successfully updated!');
        }
    }

    public function productCreate() {
        return view('view_admin.product_create');
    }

    public function productStore(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|unique:products|min:2',
            //'product_price' => 'required|regex:^[1-9][0-9]+|not_in:0',
            'product_price' => 'required|numeric|min:0|not_in:0',
            //'min:0 make sure the minimum value is 0 and no negative values are allowed. not_in:0 make sure value cannot be 0. So, combination of both of these rules does the job.',
            'product_vat_rate' => 'required|numeric|min:0',
            'file_upload' => 'image|mimes:jpg,png,jpeg,gif,svg|max:5000',
            'checked_category' => 'required',
            'product_description' => 'required',
            //'product_caption' => 'required',

        ]);
        $validated['product_status'] = $request->input('product_status');
        $validated['product_currency'] = $request->input('product_currency');
        $validated['product_caption'] = $request->input('product_caption');
        $validated['slug'] = Str::slug($validated['product_name'], '-');

        //
        if ($request->hasFile('file_upload'))
        {
            /*
            $original_name = $request->file_upload->getClientOriginalName();
            $extension = $request->file_upload->getClientOriginalExtension();
            $path = $request->file_upload->storeAs('public/pelouploads/', $original_name);
            */
            $imagePath = $request->file('file_upload');
            $original_name = $imagePath->getClientOriginalName();
            $extension = $imagePath->getClientOriginalExtension();
            //$path = $request->file('file_upload')->storeAs('pelouploads', $original_name, 'public');

            //$url = Storage::url($path);
            $validated['post_name'] = $original_name;

            $validated['post_mime_type'] = $extension;
            $validated['product_mine_base64'] = base64_encode(file_get_contents($request->file('file_upload')));

        }
        else {
            //$validated['post_name'] = $original_name;
            //$validated['post_mime_type'] = $extension;
            //$validated['guid'] = Str::slug($validated['post_title'], '-');

        }
        $validated['user_id'] = Auth::user()->id;
        $validated['post_type'] = "article";
        //$validated['post_mime_type'] = "";
        //$validated['checked_comment'] = $validated['checked_comment'];

        if( $request->has('checked_comment') ){
            $validated['comment_status'] = 'open';
        } else {
            $validated['comment_status'] = 'closed';
        }

        $validated['product_comment_count'] =0;
        //if ($request->filled('checked_to_ping')) {
        if ($request->has('checked_to_ping')){
            $validated['to_ping'] = $request->input('checked_to_ping');
        }
        else {
            $validated['to_ping'] = 0;
        }
        //
        $validated['external_link'] = $request->input('external_link');

        $product = \App\Models\Product::create($validated);
        $product->id;

        if ($request->has('checked_category')){
            foreach ($_POST['checked_category'] as $cate) {
                //$post_option->post_id = implode(',', (array) $request->get('checked_category'));
                //$post_option->post_id = implode(',',(array) $cate);
                $post_option = new ProductMeta();
                $post_option->product_id = $product->id;
                $post_option->product_parent_id = $cate;
                $post_option->save();
                //$validated['product_categories_id'] = $cate;
            }
        }
        else {
            //$validated['product_categories_id'] = 1;
        }
        //$validated['product_categories_id'] = 1;

        return redirect()->route('productIndex')->with('success', 'Post '.$product->product_name. ' created successfully! ');
        //return back()->with('success', ' ' . $product->product_name . ' deleted successfully.');

    }

    public function productIndex()
    {
        //$posts = Post::latest()->paginate(5);
        $products = DB::table('products')
            ->join('users', 'products.user_id', '=', 'users.id')
            ->select('products.*', 'users.name')
            //->where('posts.post_type', '=', 'article')
            ->get();

        return view('view_admin.product_index', compact('products'))
            ->with('i', (request()->input('page', 1) -1) *5);
        //->with('i', (request()->input('page', 1) -1) *5);
    }

    public function productEdit(Product $product)
    {
        return view('view_admin.product_edit', compact('product'));
    }

    public function productUpdate(Request $request, Product $product)
    {
        $validated = $request->validate([
            'product_name' => 'required|min:2',
            //'product_price' => 'required|regex:^[1-9][0-9]+|not_in:0',
            'product_price' => 'required|numeric|min:0|not_in:0',
            //'min:0 make sure the minimum value is 0 and no negative values are allowed. not_in:0 make sure value cannot be 0. So, combination of both of these rules does the job.',
            'product_vat_rate' => 'required|numeric|min:0',
            'file_upload' => 'image|mimes:jpg,png,jpeg,gif,svg|max:5000',
            'checked_category' => 'required',
            'product_description' => 'required',
            //'product_caption' => 'required',

        ]);
        $validated['product_status'] = $request->input('product_status');
        $validated['product_currency'] = $request->input('product_currency');
        $validated['product_caption'] = $request->input('product_caption');
        $validated['slug'] = Str::slug($validated['product_name'], '-');

        //
        if ($request->hasFile('file_upload')) {
            $imagePath = $request->file('file_upload');
            $original_name = $imagePath->getClientOriginalName();
            $extension = $imagePath->getClientOriginalExtension();
            $validated['product_mime'] = $original_name;
            $validated['product_mime_type'] = $extension;
            $validated['product_mine_base64'] = base64_encode(file_get_contents($request->file('file_upload')));
        } else {
            //$validated['post_name'] = $original_name;
            //$validated['post_mime_type'] = $extension;
        }
        $validated['user_id'] = Auth::user()->id;
        if ($request->has('checked_comment')) {
            $validated['comment_status'] = 'open';
        } else {
            $validated['comment_status'] = 'closed';
        }

        $validated['product_comment_count'] = 0;
        //if ($request->filled('checked_to_ping')) {
        if ($request->has('checked_to_ping')) {
            $validated['to_ping'] = $request->input('checked_to_ping');
        } else {
            $validated['to_ping'] = 0;
        }
        //
        $validated['external_link'] = $request->input('external_link');
        $user = \App\Models\Product::where('user_id', '=', (Auth::user()->id))->first();

        if (($user === null) and ((Auth::user()->permission) > (2))) {
            return back()->with('unauthorised', 'You are not authorised to update this post.');
        } else {

            $product->update($validated);
            $product->id;
            $deletedRows = ProductMeta::where('product_id', $product->id)->delete();
            if ($request->has('checked_category')) {
                foreach ($_POST['checked_category'] as $cate) {
                    $post_option = new ProductMeta();
                    $post_option->product_id = $product->id;
                    $post_option->product_parent_id = $cate;
                    $post_option->save();
                    //$validated['product_categories_id'] = $cate;
                }
            } else {
                //$validated['product_categories_id'] = 1;
            }
            //$validated['product_categories_id'] = 1;

            return redirect()->route('productIndex')->with('success', 'Post ' . $product->product_name . ' created successfully! ');
            //return back()->with('success', ' ' . $product->product_name . ' deleted successfully.');
        }
    }

    public function productShow(Product $product)
    {
        return view('view_admin.product_show', compact('product'));
    }

    public function productDestroy(Product $product)
    {
        $user = \App\Models\Product::where('user_id', '=', (Auth::user()->id))->first();
        if (($user === null) AND ((Auth::user()->permission)>(2))) {
            return back()->with('unauthorised', 'You are not authorised to update this post.');
        }

        else {
            //**************DELETE PRODUCTMETAS*********************

            DB::table('product_metas')->where('product_id', '=', ($product->id))->delete();
            //************DELETE POST********************************************************
            $product->delete();
            //
            //return back()->with('success', ' ' . $product->product_name . ' deleted successfully.');

            return redirect()->route('productIndex')
                ->with('success', 'Product ' . $product->product_name . ' deleted successfully');

        }
    }

    public function pricing()
    {
        $title = 'Pricing';
        $title_header = 'Pricing';
        return view('view_visitor.visitor_view_pricing', compact('title', 'title_header'));
        //return view('view_visitor.visitor_view_pricing');
    }


}
