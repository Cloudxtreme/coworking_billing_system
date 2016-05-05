@extends('layouts.app')

@section('content')
<div class="container main">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
            	<div class="panel-heading">Available Plans</div>
            	<div class="panel-body">
                    <div class="row">
                        @if (Session::has('status'))
                        <div class="col-md-12">
                            <p>{{ Session::get('status') }}</p>
                        </div>
                        @endif
                        <div class="col-md-12">
                            {{ var_dump($errors->all()) }}
                            {{ Form::open(['id' => 'update-plan-form','url' => 'plan/update','class' => 'form-horizontal center-block']) }}
                            <input type="hidden" name="id" value="{{ $plan->id }}">
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-offset-3 control-label">Name</label>
                                <div class="col-sm-4">
                                    <input type="text" name="name" class="form-control" value="{{ $plan->name }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-offset-3 control-label">Stripe ID</label>
                                <div class="col-sm-4">
                                    <input type="text" name="stripe_id" class="form-control" value="{{ $plan->stripe_id }}" required disabled="disabled">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-offset-3 control-label">Amount</label>
                                <div class="input-group col-sm-2" style="padding-left: 15px;">
                                <span class="input-group-addon">$</span>
      <input type="text" name="amount" class="form-control" aria-label="Amount (to the nearest dollar)" value="{{ $plan->amount }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-offset-3 control-label">Description</label>
                                <div class="col-sm-4">
                                    <textarea name="description">{{ $plan->description }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-offset-3 control-label">Custom</label>
                                <div class="col-sm-4">
                                    <input type="checkbox" name="custom" class="form-control" value="{{ $plan->custom }}">
                                </div>
                            </div>
                            {{ Form::close() }}
                            <div class="row">
                                <div class="col-md-offset-8 col-md-2">
                                    <button id="update-plan" plan-id="{{ $plan->id }}" class="btn btn-success pull-right">Update Plan</button>
                                </div>
                            </div>
                        </div>
                    </div>
            	</div>
			</div>
		</div>
	</div>
</div>
<script src="js/bootstrap-multiselect.js"></script>
<script src="{{ url('/') }}/js/plans.js"></script>
@endsection