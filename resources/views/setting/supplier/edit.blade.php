<div class="kt-portlet__body">
    <form action="{{route('suppliers.update')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$supplier->id}}">
        <div class="form-group">
            <label>
                @translate(Name)</label>
                <input class="form-control" name="name" value="{{$supplier->name}}" required>
        </div>
        <div class="form-group">
            <label>
                @translate(Organization)</label>
                <input class="form-control" name="org" value="{{$supplier->org}}">
        </div>
        <div class="form-group">
            <label>
                @translate(Email)</label>
                <input class="form-control" name="email" value="{{$supplier->email}}">
        </div>
        <div class="form-group">
            <label>
                @translate(Phone)</label>
                <input class="form-control" name="phone" value="{{$supplier->phone}}">
        </div>
        <div class="form-group">
            <label>
                @translate(Address)</label>
                <input class="form-control" name="address" value="{{$supplier->address}}">
        </div>
        <input name="image" value="{{$supplier->image}}" type="hidden">
        @if($supplier->image)
            <img src="{{asset('uploads/supplier/'.$supplier->image)}}" width="80" height="80" class="img-thumbnail">
            @endif
            <div class="form-group">
                <label>
                    @translate(Image)</label>
                    <input class="form-control-file" name="newImage" type="file">
            </div>
            <div class="float-right">
                <button class="btn btn-primary float-right" type="submit">
                    @translate(Update)</button>
            </div>

    </form>
</div>
