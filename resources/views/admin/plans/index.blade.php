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
                            {{ Form::open(['id' => 'create-plan-form','url' => 'plan/create','class' => 'form-horizontal center-block']) }}
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-offset-3 control-label">Name</label>
                                <div class="col-sm-4">
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-offset-3 control-label">Stripe ID</label>
                                <div class="col-sm-4">
                                    <input type="text" name="stripe_id" class="form-control" value="{{ old('stripe_id') }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-offset-3 control-label">Amount</label>
                                <div class="input-group col-sm-2" style="padding-left: 15px; padding-right: 15px;">
                                <span class="input-group-addon">$</span>
      <input type="text" name="amount" class="form-control" aria-label="Amount (to the nearest dollar)" value="{{ old('amount') }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-offset-3 control-label">Description</label>
                                <div class="col-sm-4">
                                    <textarea name="description">{{ old('description') }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-offset-3 control-label">Custom</label>
                                <div class="col-sm-4">
                                    <input type="checkbox" name="custom" class="form-control" value="1">
                                </div>
                            </div>
                            {{ Form::close() }}
                            <div class="row">
                                <div class="col-md-offset-8 col-md-2">
                                    <button id="create-plan" class="btn btn-success pull-right">Create Plan</button>
                                </div>
                            </div>


                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Are you sure you want to delete this plan?</h4>
                                  </div>
                                  <div class="modal-body">
                                    <h3><span id="users-on-plan-count"></span> users currently assigned to plan</h3>
                                    <table class="table" id="users-on-plan">
                                        <thead>
                                            <th>Name</th>
                                            <th>Email</th>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default delete-plan-cancel" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-danger delete-plan-confirm">Delete Plan</button>
                                  </div>
                                </div>
                              </div>
                            </div>

                            
                            <!-- loading display -->
                            <div id="modal-loader" class="hidden">
                                <h3>Deleting Plan</h3>
                                <div>
                                    <img src="{{ url('/') }}/images/preloader.gif">
                                </div>
                            </div>


                            <table class="table table-hover">
                                <thead>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Custom</th>
                                    <th>Created</th>
                                    <th></th>
                                </thead>
                                <tbody>  
                                @foreach($plans as $plan)
                                    <tr>
                                        <td><a href="plan/edit/{{$plan->id}}"><button id="edit-plan" class="btn btn-info pull-right">Edit</button></a></td>
                                        <td>{{$plan->name}}</td>
                                        <td>${{($plan->amount)}}</td>
                                        <td>{{($plan->custom) ? 'YES':'NO'}}</td>
                                        <td>{{$plan->created_at}}</td>
                                        <td><button plan-id="{{$plan->id}}" stripe-id="{{$plan->stripe_id}}" class="btn btn-danger delete-plan" token="{!! csrf_token() !!}">Delete</button></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

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