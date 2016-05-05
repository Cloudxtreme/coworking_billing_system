@extends('layouts.app')

@section('content')

<div class="container main">
	<div class="panel">
	                           <div id="price-block" style="display: none;">
                                <h1 style="color: green;">$<span id="price"></span>/month</h1> <button type="button" class="btn btn-success btn-lg" id="subscribe">Become a Member</button>
                            </div>
	                                    <!--<div class="col-md-6">
                                        <h3 style="margin-top: 3px;">How many days would you like?</h3>
                                    </div>
                                    <div class="col-md-3">
                                    <div class="input-group">
                                          <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                                                  <span class="glyphicon glyphicon-minus"></span>
                                              </button>
                                          </span>
                                          <input type="text" name="quant[1]" class="form-control input-number" value="1" min="1" max="10">
                                          <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quant[1]">
                                                  <span class="glyphicon glyphicon-plus"></span>
                                              </button>
                                          </span>
                                    </div>
                                    </div>-->
                                                                <!--<div class="row" style="margin-top: 10px">

                                <div class="col-md-6">
                                    <h3 style="margin-top: 3px;">How many days would you like?</h3>
                                </div>
                                <div class="col-md-6">
                                <div class="input-group">
                                      <span class="input-group-btn">
                                          <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                                              <span class="glyphicon glyphicon-minus"></span>
                                          </button>
                                      </span>
                                      <input type="text" name="quant[1]" class="form-control input-number" value="1" min="1" max="10">
                                      <span class="input-group-btn">
                                          <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quant[1]">
                                              <span class="glyphicon glyphicon-plus"></span>
                                          </button>
                                      </span>
                                </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                

                                    {{ Form::open(['id' => 'billing-form','url' => 'add_customer_to_stripe','class' => 'form-horizontal center-block']) }}
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-offset-3 control-label">Card Number</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" data-stripe="number">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-offset-3 control-label">Security Code</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" data-stripe="cvc">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-offset-3 control-label">Expiration Date</label>
                                        <div class="col-sm-2"> 
                                            {{ Form::selectMonth(null, null, ['data-stripe' => 'exp-month','class' => 'form-control']) }}
                                        </div>
                                        <div class="col-sm-2">
                                            {{ Form::selectYear(null, date('Y'), date('Y')+10, null, ['data-stripe' => 'exp-year','class' => 'form-control']) }}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-2 col-sm-offset-7">
                                            {{ Form::submit('Add Card',['class' => 'form-control btn btn-primary']) }}
                                        </div>
                                    </div>
                                    
                                    <div class="payment-errors"></div>
                                    @if (session('message'))
                                    <div class="flash_message">
                                        {{ session('message') }}
                                    </div>
                                    @endif
                                    {{ Form::close() }}

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div id="price-block-single">
                                        <h1 style="color: green;">$<span id="price-single"></span>/month</h1> 
                                        <button type="button" class="btn btn-success btn-lg" id="pay">Become a Member</button>
                                    </div>                                        
                                </div>
                            </div>-->
	</div>
                <!--<div class="panel-heading">Add Credit Card</div>

                <div class="panel-body">
                    {{ Form::open(['id' => 'billing-form','url' => 'add_customer_to_stripe','class' => 'form-horizontal center-block']) }}
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-offset-3 control-label">Card Number</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" data-stripe="number">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 col-sm-offset-3 control-label">Security Code</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" data-stripe="cvc">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 col-sm-offset-3 control-label">Expiration Date</label>
                        <div class="col-sm-2"> 
                            {{ Form::selectMonth(null, null, ['data-stripe' => 'exp-month','class' => 'form-control']) }}
                        </div>
                        <div class="col-sm-2">
                            {{ Form::selectYear(null, date('Y'), date('Y')+10, null, ['data-stripe' => 'exp-year','class' => 'form-control']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-2 col-sm-offset-7">
                            {{ Form::submit('Add Card',['class' => 'form-control btn btn-primary']) }}
                        </div>
                    </div>
                    
                    <div class="payment-errors"></div>
                    @if (session('message'))
                    <div class="flash_message">
                        {{ session('message') }}
                    </div>
                    @endif
                    {{ Form::close() }}

                </div>-->
            <!--hover color = #70E440-->
            <!--<div class="panel-heading">Your Current Plan</div>
            <div class="panel-body">
                <div class="row">
                    <div class="membership-level membership-3 col-md-4" id="3DAYSWEEK" price="105" style="width: 240px; height: 240px; background-color: #70E440;">
                        <h2>3 Days/Week</h2>
                        <p>Community Desks</p>
                        <h4>$105/Month</h4>
                    </div>
                </div>
                <div class="row" style="margin: 0 1em 2em;">
                    <button type="button" class="membership-level change-button">Change</button>
                    <button type="button" class="btn btn-success btn-lg membership-level cancel-button">Cancel</button>
                </div>
            </div>
            <div class="panel-heading hidden">Payment History</div>
            <div class="panel-body hidden">
                
            </div>
            </div>-->
</div>

@endsection