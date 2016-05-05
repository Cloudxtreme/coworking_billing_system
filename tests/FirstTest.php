<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FirstTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->visit('/login')
        	 ->click('Register')
        	 ->see('Confirm Password')
        	 ->seePageIs('/register');
    }

    public function testNewUserRegistration()
    {
	    $this->visit('/register')
	         ->type('Taylor', 'name')
	         ->type('mcmahonempire+taylor@gmail.com','email')
	         ->type('dildotime','password')
	         ->type('dildotime','password_confirmation')
	         ->press('Register')
	         ->seePageIs('/payment');
    }
}
