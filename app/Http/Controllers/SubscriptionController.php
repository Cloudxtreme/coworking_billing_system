<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

class SubscriptionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        return view('payment');
    }

    public function show($id)
    {

    }

    public function create(Request $request)
    {
        $user = User::first();
        
        $token = $request->input('stripe-token');
        
        $plan = $request->input('plan');

        $subscription = $user->newSubscription('monthly', $plan)->create($token);
        
        return $subscription;
    }

    public function update(Request $request)
    {
        $user = User::first();

        $plan = $request->input('plan');

        $swapped = $user->subscription('monthly')->swap($plan);

        return $swapped;
    }

    public function trial()
    {
        //'trial_ends_at' => Carbon::now()->addDays(10),
    }

    public function delete()
    {
        $user->subscription('monthly')->cancel();
    }
}
