<div class="kt-portlet__body">
    <form action="{{route('customers.update')}}" method="post">
        <input name="id" value="{{$customer->id}}" type="hidden">
        @csrf
        <div class="form-group">
            <label>
                @translate(Name)</label>
                <input class="form-control" value="{{$customer->name}}" name="name" required>
        </div>
        <div class="form-group">
            <label>
                @translate(Phone Number)</label>
            <input class="form-control" name="number" value="{{$customer->number}}">
        </div>

        <div class="form-group">
            <label>
                @translate(Email)</label>
                <input class="form-control" type="email" name="email" value="{{$customer->email}}">
        </div>
        <div class="form-group">
            <label>
                @translate(Address)</label>
                <input class="form-control" name="address" value="{{$customer->address}}">
        </div>
        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">
                @translate(Save)</button>
        </div>

    </form>
</div>
