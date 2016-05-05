<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use DB;

use App\Plan;

use Stripe;

use Stripe\Plan as Stripe_Plan;

use Config;

use DB;

class PlanController extends Controller
{

	public function __construct()
	{
		//$this->middleware('admin');
		\Stripe\Stripe::setApiKey(Config::get('services.stripe.secret'));

	}

    public function create(Request $request)
    {
    	$this->validate($request,[
    		'amount' => 'required|numeric',
    		'name' => 'required',
    		'stripe_id' => 'required'
    	]);

		if($this->add_to_stripe($request->all()))
		{
    		$request->custom = (int) $request->custom;
    		$request->amount = (float) $request->amount;

    		$plan = new Plan($request->all());

			if($plan->save())
			{
				//Session::flash('status','\''.$request->name.'\' plan created');
				return redirect('/plans');
			}
		}
    }

    public function index()
    {
    	//do not show not assigned to user
    	$plans = Plan::orderBy('created_at','desc')->get();
    	return view('admin.plans.index',array('plans' => $plans));
    }

    public function show(Plan $id)
    {
    	//$plan = Plan::find($id);
    	return $id;
    }

    public function edit(Plan $id)
    {
    	$plans = Plan::all();
    	$plan = $plans->find($id);
    	return view('admin.plans.edit',array('plan' => $plan));
    }

    public function update(Request $request)
    {
    	$this->validate($request,[
    		'id' => 'required'
    	]);

    	if($this->add_to_stripe($request->all()))
		{
    		$request->custom = (int) $request->custom;
    		$request->amount = (float) $request->amount;

    		$plan = new Plan($request->all());

			if($plan->save())
			{
				//Session::flash('status','\''.$request->name.'\' plan created');
				return redirect('/plans');
			}
		}

    	$this->update_stripe();
    }

    public function subscribers($stripe_id)
    {
    	$users = DB::table('subscriptions')
            ->join('users', 'subscriptions.user_id', '=', 'users.id')
            ->where('subscriptions.stripe_plan',$stripe_id)
            ->select('users.name', 'users.email')
            ->get();
        return $users;
    }

    public function destroy($stripe_id)
    {

    	$users = $this->subscribers($stripe_id);
    	foreach ($users as $user) {
            $user->subscription('main')->cancel();
    	}


        $plan = Plan::where('stripe_id',$stripe_id)->first();
        //dd($stripe_id,$plan);
		$plan->delete();

        try {
            $plan = \Stripe\Plan::retrieve($stripe_id);
            
        } catch(\Stripe\Error\InvalidRequest $e) {
              $body = $e->getJsonBody();
              $err  = $body['error'];

              print('Status is:' . $e->getHttpStatus() . "\n");
              print('Type is:' . $err['type'] . "\n");
              print('Code is:' . $err['code'] . "\n");
              // param is '' in this case
              print('Param is:' . $err['param'] . "\n");
              print('Message is:' . $err['message'] . "\n");

              die();

        } catch(Exception $e) {
            return $e;
        }

        $plan->delete();
        //dd($plan);
        /*$plans = Plan::all();
    	$plan = $plans->find($id);
    	var_dump($plan->user);*/

    	//if cancel subscriptions

    	//if delete plan on laravel

    	//if delete plan on stripe


    }

    public function check_id_available($id)
    {
    	$plan = Plan::where('stripe_id',$id)->first();
    	dd($plan);
    	//return $plan->name;
    }

    public function import()
    {
    	$s_plans = Stripe_Plan::all();

    	//$s_plans = json_decode($s_plans,true);

    	//return $s_plans;

    	foreach ($s_plans->data as $s_plan) {
    		$plan = new Plan;
    		$plan->stripe_id = $s_plan->id;
    		$plan->name = $s_plan->name;
    		$plan->description = $s_plan->description;
    		$plan->amount = $s_plan->amount;
    		if(isset($s_plan->metadata->custom)) $plan->custom = true;
    		$plan->save();
    	}
    }

    public function destroy_all()
    {

    }

    private function add_to_stripe(array $plan)
    {
    	$plan['amount'] = (int) (((float) $plan['amount']) * 100);
    	$plan['id'] = $plan['stripe_id'];
    	unset($plan['stripe_id'],$plan['_token'],$plan['description'],$plan['custom']);
    	$plan['interval'] = 'month';
    	$plan['currency'] = 'usd';
    	//$plan['metadata'] = ['custom' => true];

    	try {
    		Stripe_Plan::create($plan);
    		return true;
    	} catch (Exception $e) {
    		//plan exists?
    		return false;
    	}
    }

    private function update_stripe(array $plan)
    {
    	//$p = \Stripe\Plan::retrieve({PLAN_ID});
		//$p->name = {NAME};
		//...
		//$p->save();
    }
}
