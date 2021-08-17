<div class="kt-portlet__body">
    <form action="{{route('units.update')}}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$unit->id}}">
        <div class="form-group">
            <label>@translate(Code)</label>
            <input class="form-control" value="{{$unit->code}}" name="code" required>
        </div>
        <div class="form-group">
            <label>@translate(Name)</label>
            <input class="form-control" name="name" value="{{$unit->name}}" required>
        </div>
        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">@translate(Update)</button>
        </div>

    </form>
</div>
