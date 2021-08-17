<div class="kt-portlet__body">
    <form action="{{route('suppliers.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>
                @translate(Name)</label>
                <input class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label>
                @translate(Organization)</label>
                <input class="form-control" name="org">
        </div>
        <div class="form-group">
            <label>
                @translate(Email)</label>
                <input class="form-control" name="email">
        </div>
        <div class="form-group">
            <label>
                @translate(Phone)</label>
                <input class="form-control" name="phone">
        </div>
        <div class="form-group">
            <label>
                @translate(Address)</label>
                <input class="form-control" name="address">
        </div>
        <div class="form-group">
            <label>
                @translate(Image)</label>
                <input class="form-control-file" name="image" type="file">
        </div>
        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">
                @translate(Save)</button>
        </div>

    </form>
</div>
