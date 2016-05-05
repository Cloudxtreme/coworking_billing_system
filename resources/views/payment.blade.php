@extends('layouts.app')

@section('content')
<div class="container main">
            <div class="panel panel-default land" style="background-color: rgba(212, 125, 63,.75); color: white;/* border: solid 1px #46352f;*/">

                <!--<div class="panel-heading select-plan">Select Plan</div>-->
                <!--<div class="panel-body select-plan">-->
                                <div class="row">
                                    <div class="col-md-10 col-md-push-1" style="border: none;">
                                        <h3>Pay by the day.</h3>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-10 col-md-push-1">
                                        <table class="table table-bordered table-scheme" style="border: solid 1px #46352f;">
                                            <tbody>
                                                <tr>
                                                    <td>1 day</td>
                                                    <td>$15/day</td>
                                                </tr>
                                            </tbody>
                                        </table>  
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-7 col-md-push-2">
                                        <h3>1 day</h3>
                                    </div>
                                    <div class="col-md-3">
                                        <h3>$15/day</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-10 col-md-push-2" style="border: none;">
                                        <h3>How about saving money with a monthly plan?</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-7 col-md-push-2">
                                        <h3>½ a day a week</h3>
                                    </div>
                                    <div class="col-md-3">
                                        <h3>$25/month</h3>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-7 col-md-push-2">
                                        <h3>1 day a week</h3>
                                    </div>
                                    <div class="col-md-3">
                                        <h3>$45/month</h3>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-7 col-md-push-2">
                                        <h3>2 days a week</h3>
                                    </div>
                                    <div class="col-md-3">
                                        <h3>$75/month</h3>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-7 col-md-push-2">
                                        <h3>3 days a week</h3>
                                    </div>
                                    <div class="col-md-3">
                                        <h3>$105/month</h3>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-7 col-md-push-2">
                                        <h3>5 days a week</h3>
                                    </div>
                                    <div class="col-md-3">
                                        <h3>$150/month</h3>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-7 col-md-push-2">
                                        <h3>24/7 access with locking drawers</h3>
                                    </div>
                                    <div class="col-md-3">
                                        <h3>$215/month</h3>
                                    </div>
                                </div>

                                <div class="row">
                                    <button type="button" class="btn btn-success btn-lg center-block" id="subscribe" style="font-size: 4vw; margin-bottom: 10px;">Get A Free Trial Day</button>
                                </div>
                <!--</div>-->
        </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
                //plugin bootstrap minus and plus
        //http://jsfiddle.net/laelitenetwork/puJ6G/
        $('.btn-number').click(function(e){
            e.preventDefault();
            
            fieldName = $(this).attr('data-field');
            type      = $(this).attr('data-type');
            var input = $("input[name='"+fieldName+"']");
            var currentVal = parseInt(input.val());
            if (!isNaN(currentVal)) {
                if(type == 'minus') {
                    
                    if(currentVal > input.attr('min')) {
                        input.val(currentVal - 1).change();
                    } 
                    if(parseInt(input.val()) == input.attr('min')) {
                        $(this).attr('disabled', true);
                    }

                } else if(type == 'plus') {

                    //if(currentVal < input.attr('max')) {
                        input.val(currentVal + 1).change();
                    //}
                    /*if(parseInt(input.val()) == input.attr('max')) {
                        $(this).attr('disabled', true);
                    }*/

                }
            } else {
                input.val(0);
            }
        });
        $('.input-number').focusin(function(){
           $(this).data('oldValue', $(this).val());
        });
        $('.input-number').change(function() {
            
            minValue =  parseInt($(this).attr('min'));
            maxValue =  parseInt($(this).attr('max'));
            valueCurrent = parseInt($(this).val());
            
            name = $(this).attr('name');
            if(valueCurrent >= minValue) {
                $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
            } else {
                alert('Sorry, the minimum value was reached');
                $(this).val($(this).data('oldValue'));
            }
            if(valueCurrent <= maxValue) {
                $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
            }/* else {
                alert('Sorry, the maximum value was reached');
                $(this).val($(this).data('oldValue'));
            }*/
            
            
        });
        $(".input-number").keydown(function (e) {
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                     // Allow: Ctrl+A
                    (e.keyCode == 65 && e.ctrlKey === true) || 
                     // Allow: home, end, left, right
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                         // let it happen, don't do anything
                         return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
    });
</script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="{{ url('/') }}/js/billing.js"></script>
@endsection
