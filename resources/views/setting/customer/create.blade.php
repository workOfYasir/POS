<div class="kt-portlet__body">
    <form action="{{route('customers.store')}}" method="post" >
        @csrf
        <div class="col-12 form-group d-flex">
            <div class=" col-md-6">
                <label>
                    @translate(Name)</label>
                    <input class="form-control" name="name" required>
            </div>
            <div class=" col-md-6">
                <label>
                    @translate(Phone Number)</label>
                <input class="form-control" name="number">
            </div>
        </div>
        <div class="col-12 form-group d-flex">
            <div class="col-md-6">
                <label>
                    @translate(Email)</label>
                    <input class="form-control" type="email" name="email">
            </div>
            <div class="col-md-6">
                <label>
                    @translate(Address)</label>
                    <input class="form-control" name="address">
            </div>
        </div>
        <div class="col-12 form-group d-flex">
            <div class=" col-md-6">
                <label>
                    @translate(Opening Balance)</label>
                    <input type="number" class="form-control" name="balance">
            </div>
        
        
        <div class="col-md-6">
            <label>
                @translate(Customer Type)</label>
            <select class="form-control select2 customer width-full" id="customer"
                    name="type_id">
                <option value="0">@translate(Select Customer)</option>
                @foreach($customerType as $item)
                    <option value="{{$item->id}}">{{$item->name }}
                        
                    </option>
                @endforeach
            </select>
        </div>
    </div>
        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">
                @translate(Save)</button>
        </div>

    </form>
</div>
