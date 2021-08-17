<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
   
</head>
<body>
    <div class="kt-portlet__body">
        <h4><strong>Name: </strong>{{$installmentData->customer->name}}</h4>
        <br>
        <h5><strong>Remaining Money: </strong>{{$installmentData->balance}}</h5>
        
        <h5><strong> Status: </strong> {{$installmentData->status}}</h5>
        <form action="{{route('pos.storeInstallment')}}" method="post">
            @csrf
            <input name="sale_id" value="{{ $installmentData->id }}" type="hidden">
            @csrf
           @if($installmentData->status=='reciveable' || $installmentData->status=='Pending' )
            <label>Payment</label>
            <input name="customer_id" value="{{ $installmentData->customer_id }}" type="hidden">
            <input name="balance" value="{{ $installmentData->balance }}" type="hidden">
            <input type="text" name="debit" class="form-control" id="debit">
@endif
            <div class="float-right">
                <button class="btn btn-primary float-right" type="submit">
                    @translate(Save)</button>
            </div>
    
        </form>
    </div>
</body>
</html>

@section('script')
    
    
    

@endsection
