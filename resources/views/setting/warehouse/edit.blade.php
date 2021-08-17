<div class="kt-portlet__body">
    <form action="{{route('warehouses.update')}}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$warehouse->id}}">
        <div class="form-group">
            <label>@translate(Name)</label>
            <input class="form-control" value="{{$warehouse->name}}" name="name" required>
        </div>
        <div class="form-group">
            <label>@translate(Address)</label>
            <input class="form-control" value="{{$warehouse->address}}" name="address" >
        </div>
        <div class="form-group">
            <label>@translate(Phone)</label>
            <input class="form-control" value="{{$warehouse->phone}}" name="phone" >
        </div>
        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">@translate(Update)</button>
        </div>

    </form>
</div>
