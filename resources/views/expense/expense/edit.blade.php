<div class="kt-portlet__body">
    <form action="{{route('expense.update')}}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$expense->id}}">
        <div class="form-group">
            <label>
                @translate(Select WareHouse)</label>
            <select class="form-control kt-select2 data width-full" id="kt_select2_3" name="warehouse_id">
                @foreach($warehouses as $item)
                <option value="{{$item->id}}" {{$expense->warehouse->id == $item->id ? 'selected' : null}}>{{$item->name }}</option>
                @endforeach
            </select>

        </div>

        <div class="form-group">
            <label>
                @translate(Select Category)</label>
            <select class="form-control kt-select2 data width-full" id="kt_select2_3" name="category_id">
                @foreach($categories as $item)
                <option value="{{$item->id}}" {{$expense->category->id == $item->id ? 'selected' : null}}>{{$item->name }}({{$item->code}})</option>
                @endforeach
            </select>

        </div>
        <div class="form-group">
            <label>
                @translate(Amount)</label>
                <input class="form-control" step="0.01" min="0" name="amount" value="{{$expense->amount}}" type="number" required>
        </div>
        <div class="form-group">
            <label>
                @translate(Note)</label>
                <input class="form-control" name="description" type="text" value="{{$expense->description}}">
        </div>
        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">
                @translate(Update)</button>
        </div>

    </form>
</div>
