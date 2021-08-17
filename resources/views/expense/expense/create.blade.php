<div class="kt-portlet__body">
    <form action="{{route('expense.store')}}" method="post">
        @csrf
        <div class="form-group">
            <label>
                @translate(Select WareHouse)</label>
            <select class="form-control kt-select2 data width-full" id="kt_select2_3" name="warehouse_id">
                <option value="">
                    @translate(Select Warehouse)</option>
                @foreach($warehouses as $item)
                <option value="{{$item->id}}">{{$item->name }}</option>
                @endforeach
            </select>

        </div>

        <div class="form-group">
            <label>
                @translate(Select Category)</label>
            <select class="form-control kt-select2 data width-full select" name="category_id">
                <option value="">
                    @translate(Select Category)</option>
                @foreach($categories as $item)
                <option value="{{$item->id}}">{{$item->name }}({{$item->code}})</option>
                @endforeach
            </select>

        </div>
        <div class="form-group">
            <label>
                @translate(Amount)</label>
                <input class="form-control" min="0" step="0.01" name="amount" type="number" required>
        </div>
        <div class="form-group">
            <label>
                @translate(Note)</label>
                <input class="form-control" name="description" type="text">
        </div>
        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">
                @translate(Save)</button>
        </div>

    </form>
</div>
