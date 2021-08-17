<div class="kt-portlet__body">
    <form action="{{route('units.store')}}" method="post">
        @csrf
        <div class="form-group">
            <label>@translate(Code)</label>
            <input class="form-control" name="code" required>
        </div>
        <div class="form-group">
            <label>@translate(Name)</label>
            <input class="form-control" name="name" required>
        </div>
        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">@translate(Save)</button>
        </div>

    </form>
</div>
