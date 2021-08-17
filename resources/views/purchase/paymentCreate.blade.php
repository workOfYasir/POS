<div class="kt-portlet__body">
    <form action="{{route('purchases.payment.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div>
            <input type="hidden" name="purchase_id" value="{{$purchase->id}}">
            <hr>

            <p class="text-primary"><strong>
                    @translate(Total Amount)</strong> : {{$purchase->total_amount}}</p>
            <p class="text-success"><strong>
                    @translate(Total Paid)</strong> : {{$purchase->total_paid}}</p>
            <p class="text-danger"><strong>
                    @translate(Now Due)</strong> : {{$purchase->total_due}}</p>

            <div>
                <div class="form-group">
                    <label class="col-form-label text-md-right">
                        @translate(Paid Amount) </label>
                    <div>
                        <input step="0.01" class="form-control" min="0" name="paid_amount" type="number" required>
                    </div>
                </div>
            </div>

        </div>
        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">
                @translate(Save)</button>
        </div>

    </form>
</div>
