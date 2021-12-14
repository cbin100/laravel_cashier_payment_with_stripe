<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $order;

    public function __construct($order)
    {
        /*
        $order = DB::table('orders')
                    ->join('products', 'products.id', '=', 'orders.product_id')
                    ->where('products.id', '=', $_SESSION['orderId'])
                    ->select('products.*', 'orders.*')
                    ->first();
        */
        $this->order = $order;
        //$this->product = $product;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //$title = 'Payment '.$this->order->payment_status. '!';
        $title = 'Payment succeeded!';
//*
        $ordered = DB::table('orders')
            ->join('products', 'products.id', '=', 'orders.product_id')
            //->where('products.id', '=', $_SESSION['orderId'])
            ->where('orders.id', '=', $_SESSION['orderId'])
            ->select('products.*', 'orders.*')
            ->first();
//*/
        //$title = 'Payment '.$order->payment_status. '!';
        //$productCategoryContent = $productPrint->product_description;
        $title_header = 'Pricing - ' . $title . ' - Pelo Group Limited, Web, E-commerce, Mobile App, SEO, Data Science';
//
        $orderNumber = $ordered->order_number;
        $orderPrice = $ordered->product_price;
        $orderName = $ordered->product_name;
        $productPrintCurrency = $ordered->product_price_currency;
        $orderStatus = $ordered->payment_status;
        $cardLastFour = $ordered->card_last_four;
        $dateTransaction = date("d/m/Y H:i:s",strtotime($ordered->created_at));
        //$date_repport=date("d/m/Y H:i:s", strtotime($donnees['date_rapport']));
        $customerName = $_SESSION['customerName'];

        return $this->from('nonreply@pelogroup.net')
            ->view('emails.visitor_view_order_succeeded', compact('title', 'title_header', 'orderName', 'orderPrice', 'orderNumber', 'orderStatus', 'productPrintCurrency', 'cardLastFour', 'dateTransaction', 'customerName'));
            /*->with([
                //'orderName' => $this->order->product_name,
                //'customerName' => $_COOKIE['']
                'orderNumber' => '222',//$this->order->order_number,
                'orderPrice' => '777',//$this->order->product_price,
                //'orderStatus' => $this->order->payment_status,
                'title' => $title,
                'title_header' => $title_header,
            ]);*/

    }
}
