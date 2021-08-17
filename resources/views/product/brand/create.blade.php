<div class="kt-portlet__body">
    <form action="{{route('brands.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>@translate(Name)</label>
            <input class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label>@translate(Image)</label>
            <input class="form-control-file" name="image" type="file" required>
        </div>
        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">@translate(Save)</button>
        </div>
    </form>
</div>
