<?php
/*
HERE WE CREATE A CHECKOUT SESSION FOR THE SELECTED PRODUCT IN ORDER TO PROCEED THE PAYMENT
*/

session_start(); // As we are out of the Laravel Package, we started session using proper PHP way (Not Laravel Ways) just to have full control of our application
// we could eventually use Cookies, instead, but preferred Session in respect of our user's privacy.


//use Illuminate\Support\Facades\Session;

/*
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
*/



/*

*/

if (isset($_POST['cardHolderName'])) {
    //setcookie("card_holder", $_POST['cardHolderName'], time()+3600); // 1hr = 3600 secs
    $_SESSION['card_holder'] = $_POST['cardHolderName'];
} else {
    //setcookie("card_holder", 'Unknown card', time()+3600); // 1hr = 3600 secs
    $_SESSION['card_holder'] = 'Unknown card';
}
$_SESSION['card_holder'] = 'Unknown card';
//
if (isset($_SESSION['productPrintPrice'])) {
    $paid_amount = $_SESSION['productPrintPrice'];
} else {
    $paid_amount = 0;
    //$paid_amount = $_SESSION['productPrintPrice'];
}
//
if (isset($_SESSION['customerEmail'])) {
    $customerEmail = $_SESSION['customerEmail'];
} else {
    $customerEmail = 'support@pelogroup.net';
}
//
if (isset($_SESSION['productPrintName'])) {
    $productPrintName = 'Website Development for ' .$_SESSION['productPrintName'];
} else {
    $productPrintName = 'Website Development';
}
//
if (isset($_SESSION['productCurrency'])) {
    $productCurrency = $_SESSION['productCurrency'];
} else {
    $productCurrency = 'gbp';
}


//$paid_amount = 40000;
/*
if (!isset($_SESSION['paid_amount'])) {
    $paid_amount = 10000;
} else {
    //$paid_amount = $_SESSION['paid_amount'];
    $paid_amount = Session::get('paid_amount');
}
$paid_amount = Session::get('paid_amount');
//$paid_amount = $_COOKIE['paid_amount'];
*/
//$paid_amount = 10000;
//$paid_amount = $_SESSION['paid_amount'];
//require 'vendor/stripe/autoload.php';
//include('./vendor/stripe/stripe-php/init.php');
//include('../vendor/stripe/stripe-php/init.php');
include('../vendor/stripe/stripe-php/init.php');


// This is your real test secret API key.
//\Stripe\Stripe::setApiKey('sk_test_51IWo7BFda2UQUDA6F4J8CAl3q5zVFBZl5K1GgWIXkEsZKTEDWwwJEGGmgJQfk69LWO62ubRkdArU7thhX719cbM000ZSy2o9TJ');
\Stripe\Stripe::setApiKey('YOUR_STRIPE_API_KEY');


function calculateOrderAmount(array $items): int {
  // Replace this constant with a calculation of the order's amount
  // Calculate the order total on the server to prevent
  // customers from directly manipulating the amount on the client
  return 50000;
}

header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://yourdomainename/public';


// Add customer to stripe
try {
    $customer = \Stripe\Customer::create(array(
        //'email' => $email,
        'email' => $customerEmail,
        'description' => $productPrintName
        //'source'  => $token
    ));
}catch(Exception $e) {
    $api_error = $e->getMessage();
}

try {
  // retrieve JSON from POST body
  $json_str = file_get_contents('php://input');
  $json_obj = json_decode($json_str);

  $paymentIntent = \Stripe\PaymentIntent::create([
    //'amount' => calculateOrderAmount($json_obj->items),
    'payment_method_types' => ['card'],
    'amount' => $paid_amount * 100 , // This is how tripe works, multiplying the amount by 100.
    'currency' => $productCurrency,
    'customer' => $customer->id,
    'description' => $productPrintName,
      //
    //'mode' => 'payment',
  ]);

  $output = [
    'clientSecret' => $paymentIntent->client_secret,
  ];

  echo json_encode($output);
  //
} catch (Error $e) {
  http_response_code(500);
  echo json_encode(['error' => $e->getMessage()]);
}
