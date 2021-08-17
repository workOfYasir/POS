<div class="kt-portlet__body">
    <form action="{{route('taxes.store')}}" method="post">
        @csrf
        <div class="form-group">
            <label>@translate(Name)</label>
            <input class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label>@translate(Rate(%))</label>
            <input step="0.01" class="form-control" min="0" type="number" name="rate" required>
        </div>
        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">@translate(Save)</button>
        </div>

    </form>
</div>

