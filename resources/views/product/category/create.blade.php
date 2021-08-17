<div class="kt-portlet__body">
    <form action="{{route('categories.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>@translate(Name)</label>
            <input class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label class="col-form-label text-md-right">@translate(Icon/Image)</label>
            <div class="custom-file">
                <input class="custom-file-input" id="customFile" name="icon" type="file" >
                <label class="custom-file-label">Choose File</label>
            </div>
        </div>
        <div class="form-group">
            <label>@translate(Parent Category)</label>
            <select class="form-control kt-select2 width-full select" name="parent_category_id">
                <option value="0">@translate(No Parent Category Select)</option>
                @foreach($categories as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">@translate(Save)</button>
        </div>

    </form>
</div>



