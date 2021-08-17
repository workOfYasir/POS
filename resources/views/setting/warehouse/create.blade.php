<div class="kt-portlet__body">
    <form action="{{route('warehouses.store')}}" method="post">
        @csrf
        <div class="form-group">
            <label>@translate(Name)</label>
            <input class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label>@translate(Address)</label>
            <input class="form-control" name="address" >
        </div>
        <div class="form-group">
            <label>@translate(Phone)</label>
            <input class="form-control" name="phone" >
        </div>
        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">@translate(Save)</button>
        </div>

    </form>
</div>

