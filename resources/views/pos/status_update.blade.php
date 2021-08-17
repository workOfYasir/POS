<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script type="text/javascript">
       
        
        $("#field-status").change(function() {
            if ($(this).val() == "reciveable") {
                $('#commentDiv').show();
                $('#paymentDiv').hide();
                
            }else if ($(this).val() == "paid") {
                $('#paymentDiv').show();
                $('#commentDiv').hide();
                
            }
             else {
                $('#commentDiv').hide();
                $('#comment').removeAttr('required');
                $('#comment').removeAttr('data-error');
                $('#paymentDiv').hide();
                $('#payment').removeAttr('required');
                $('#payment').removeAttr('data-error');
                $('#refrence').removeAttr('required');
                $('#refrence').removeAttr('data-error');
            }
        });
$("#field-status").trigger("change");
   </script>
    
</head>
<body>
    <div class="kt-portlet__body">
        <form action="{{route('status.update')}}" method="post">
            @csrf
            <input name="id" value="{{ $status->id }}" type="hidden">
            @csrf
            
            <label for="field-status">Add Status</label>
                                    <select class="form-control" id="field-status" name="status" aria-label="Default select example"  >
                                        <option value =" " selected disabled >{{ $status->status }}</option>
                                        <option value="reciveable">Reciveable</option>
                                        <option value="paid">Paid</option>
                                        
                                    </select>
                                    <div class="form-group" id="commentDiv">
                                        <label for="comment">Comment:</label>
                                        <textarea class="form-control" name="followComment" rows="5" id="comment">{{ $status->follow_comment }}</textarea>
                                    </div>
                                   <div class="form-group" >
                                    <div class="row" id="paymentDiv">
                                      <div class="col-6">
                                        <label for="otherField1">Add payment Method</label>
                                            <select class="form-control" id="payment" name="payment" aria-label="Default select example" >
                                                <option value =" " selected>Open this select menu</option>
                                                <option value="cash">Cash</option>
                                                <option value="bank">Bank</option>
                                                
                                            </select>
                                      </div>
                                      
                                      <div class="form-group col-6">
                                        <label for="otherField1">Add Reference</label>
                                            <input type="text" name="reference" class="form-control" id="refrence" placeholder="Add Refrence Number">
                                      </div>
                                      
                                    </div>
            
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
