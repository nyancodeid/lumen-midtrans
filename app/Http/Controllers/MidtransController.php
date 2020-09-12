<?php
namespace App\Http\Controllers;

use Veritrans_Snap;
use Veritrans_Transaction;

use Illuminate\Http\Request;

class MidtransController extends Controller
{
    private $products;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->products = [
            "hobby" => [
                "name" => "Hobby",
                "price" => 75000,
                "price_text" => "Rp. 75.000"
            ],
            "expert" => [
                "name" => "Expert",
                "price" => 300000,
                "price_text" => "Rp. 300.000"
            ],
            "enterprice" => [
                "name" => "Enterprice",
                "price" => 1200000,
                "price_text" => "Rp. 1.200.000"
            ],
        ];
    }

    public function create_transaction_view (Request $request, $name)
    {
        $product_id = $name;

        return view("checkout", [
            "client_key" => config("app.midtrans.client_key"),
            "product_id" => $product_id,
            "product" => $this->products[$product_id]
        ]);
    }

    public function create_transaction (Request $request)
    {
        $product_id = $request->input("id");
        $product = $this->products[$product_id];

        // Optional
        $billing_address = array(
            'first_name'    => "Andri",
            'last_name'     => "Litani",
            'address'       => "Mangga 20",
            'city'          => "Jakarta",
            'postal_code'   => "16602",
            'phone'         => "081122334455",
            'country_code'  => 'IDN'
        );

        // Optional
        $shipping_address = array(
            'first_name'    => "Obet",
            'last_name'     => "Supriadi",
            'address'       => "Manggis 90",
            'city'          => "Jakarta",
            'postal_code'   => "16601",
            'phone'         => "08113366345",
            'country_code'  => 'IDN'
        );
        // Optional
        $customer_details = array(
            'first_name'    => "Andri",
            'last_name'     => "Litani",
            'email'         => "andri@litani.com",
            'phone'         => "081122334455",
            'billing_address'  => $billing_address,
            'shipping_address' => $shipping_address
        );
        $transaction = [
            "transaction_details" => [
                "order_id" => "TX" . rand(),
                "gross_amount" => $product["price"]
            ],
            "customer_details" => $customer_details,
            "item_details" => [
                [
                    "id" => $product_id,
                    "name" => $product["name"],
                    "price" => $product["price"],
                    "quantity" => 1,
                ]
            ]
        ];

        $token = $this->get_snap_token($transaction);

        return response()->json([
            "token" => $token
        ]);
    }

    private function get_snap_token ($transaction)
    {
        $token = Veritrans_Snap::getSnapToken($transaction);

        return $token;
    }

    public function get_tx_status (Request $request, $id)
    {
        $status = Veritrans_Transaction::status($id);

        return response()->json([
            "id" => $id,
            "status" => $status
        ]);
    }

    public function cancel_tx (Request $request, $id)
    {
        $status = Veritrans_Transaction::cancel($id);

        return response()->json([
            "id" => $id,
            "status" => $status
        ]);
    }
}
