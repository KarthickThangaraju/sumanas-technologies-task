<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StripeController extends Controller
{
    public function stripeview($id = null)
    {
        $singleproduct = DB::table('product_details')
                            ->where('id', $id)
                            ->get();

        return view('stripe_view', ['singleproduct' => $singleproduct]);

    }
    public function payment()
    {
        echo "sucess";die();

    }
}
