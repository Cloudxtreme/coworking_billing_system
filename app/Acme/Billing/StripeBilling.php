<?php namespace Acme\Billing;

use Stripe;

use Config;

use Exception;

class StripeBilling implements BillingInterface {

	public function __construct()
	{
		\Stripe\Stripe::setApiKey(Config::get('services.stripe.secret'));
	}

	public function charge(array $data)
	{
		try {

			\Stripe\Charge::create([
				'customer' => $data['customer-id'],
				'amount' => 10 * 100,
				'currency' => 'usd'
			]);

			return $customer->id;

		} catch(Exception $e) {
			return $e;//->with('message',$e->getMessage());
		}

	}

	public function addCustomer(array $data)
	{
		try {

			$customer = \Stripe\Customer::create([
				'card' => $data['token'],
				'description' => $data['email']
			]);

			return $customer->id;

		} catch(Exception $e) {
			return $e;//->with('message',$e->getMessage());
		}

	}

	public function addPlan(array $data)
	{
		try {
			$customer = \Stripe\Customer::retrieve($data['customer_id']);
			$customer->plan = $data['plan'];
			return $customer->save();
		} catch (Exception $e) {
			return $e;
		}
	}

	public function getCustomer($id)
	{
		try {
			$customer = \Stripe\Customer::retrieve($id);
			return $customer;
		} catch (Exception $e) {
			return $e;
		}
	}
}