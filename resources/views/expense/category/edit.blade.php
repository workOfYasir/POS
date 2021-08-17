<div class="kt-portlet__body">
    <form action="{{route('expense.categories.update')}}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$category->id}}">
        <div class="form-group">
            <label>@translate(Code)</label>
            <input class="form-control" value="{{$category->code}}" name="code" required>
        </div>
        <div class="form-group">
            <label>@translate(Name)</label>
            <input class="form-control" name="name" value="{{$category->name}}" required>
        </div>
        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">@translate(Update)</button>
        </div>

    </form>
</div>

