<div class="kt-portlet__body">
    <form action="{{route('brands.update')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$brand->id}}">
        <input type="hidden" name="image" value="{{$brand->image}}">
        <div class="form-group">
            <label>@translate(Name)</label>
            <input class="form-control" name="name" required value="{{$brand->name}}">
        </div>
        <img src="{{asset('uploads/brand/'.$brand->image)}}" width="80" height="80" class="img-thumbnail">
        <div class="form-group">
            <label>@translate(New Image)</label>
            <input class="form-control-file" name="newImage" type="file" >
        </div>

        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">@translate(Update)</button>
        </div>

    </form>
</div>
