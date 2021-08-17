<div class="kt-portlet__body">
    <form action="{{route('taxes.update')}}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$tax->id}}">
        <div class="form-group">
            <label>@translate(Name)</label>
            <input class="form-control" value="{{$tax->name}}" name="name" required>
        </div>
        <div class="form-group">
            <label>@translate(Rate(%))</label>
            <input step="0.01" class="form-control" min="0" type="number" value="{{$tax->rate}}" name="rate" required>
        </div>
        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">@translate(Update)</button>
        </div>

    </form>
</div>

