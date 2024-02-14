<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Laravel\Cashier\Facades\Cashier;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class ProductController extends Controller
{
    public function view()
    {
        $productlists = Product::get();
        return view('product_view', ['productlists' => $productlists]);

    }

    public function payment(Product $Product, Request $request, $id = null)
    {
        $singleproduct = DB::table('products')
                            ->where('id', $id)
                            ->get();

        $user = Auth::user();
        return view('payment',[
            'user'=>$user,
            'intent' => $user->createSetupIntent(),
            'singleproduct' => $singleproduct
        ]);
    }

    public function subscription(Request $request, Product $Product)
    {
        $user = $request->user();
        $product = Product::find($request->product);
        $planId = $product->stripe_plan; // ID of the plan created in Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // Get the authenticated user
            $user = Auth::user();

            // Check if the user has a Stripe customer ID
            if (!$user->stripe_id) {
                // If the user doesn't have a Stripe customer ID, create a new Stripe customer
                $stripeCustomer = Customer::create([
                    'email' => $user->email,
                    // Add additional customer details if needed
                ]);

                // Save the Stripe customer ID to the user model
                $user->stripe_id = $stripeCustomer->id;
                $user->save();
            }
            // Attach the PaymentMethod to the customer
            $user->updateDefaultPaymentMethod($request->token);
            // Charge the customer
            $payment = $user->charge($product->price * 100, $request->token); // Example charge amount (in cents)
        } catch (\Exception $e) {
            // Handle payment failure
            return redirect()->back()->with('error', 'Payment failed: ' . $e->getMessage());
        }
           
        return redirect()->route('product.view')->with('success', 'Payment successfull');
         
    }
}
