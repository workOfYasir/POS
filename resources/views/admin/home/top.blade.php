
<?php
$total_item=0.00;
$total_amount=0.00;
$expanse_amount=0.00;
?>
@foreach($sales as $item)
    <input type="hidden" value="{{$total_item +=$item->total_item}}">
    <input type="hidden" value="{{$total_amount +=$item->total_price}}">
@endforeach

@foreach($expense as $item)
    <input type="hidden" value="{{$expanse_amount +=$item->amount}}">
@endforeach

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-4 h-auto">
        <div class="kt-portlet kt-portlet--border-bottom-success">
            <div class="kt-portlet__body kt-portlet__body--fluid">
                <div class="kt-widget26">
                    <div class="kt-widget26__content">
                        <span class="kt-widget26__number"> {{ $total_item}}</span>
                        <span class="kt-widget26__desc">@translate(Sales Item)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-4 h-auto">
        <div
            class="kt-portlet kt-portlet--border-bottom-brand">
            <div class="kt-portlet__body kt-portlet__body--fluid">
                <div class="kt-widget26">
                    <div class="kt-widget26__content">
                        <span class="kt-widget26__number"> {{ formatePrice($total_amount) }}</span>
                        <span class="kt-widget26__desc">@translate(Sales Amount)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-4 h-auto">
        <div class="kt-portlet kt-portlet--border-bottom-danger">
            <div class="kt-portlet__body kt-portlet__body--fluid">
                <div class="kt-widget26">
                    <div class="kt-widget26__content">
                        <span class="kt-widget26__number"> {{ formatePrice($expanse_amount) }}</span>
                        <span class="kt-widget26__desc">@translate(Expense)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
