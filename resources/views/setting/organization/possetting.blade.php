@extends('admin.master')

@section('content')
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">@translate(Pos Settings)</h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="{{ route('env_key_update.update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="types[]" value="POSTOP">
                            <div class="col-lg-3">
                                <label class="control-label">
                                    @translate(Pos Shortcut Section)</label>
                            </div>
                            <div class="col-lg-12">
                                <select class="form-control" name="POSTOP">
                                    <option value="Show" @if (env('POSTOP') == "Show") selected @endif>Show</option>
                                    <option value="Hide" @if (env('POSTOP') == "Hide") selected @endif>Hide</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="hidden" name="types[]" value="BARCODE">
                            <div class="col-lg-3">
                                <label class="control-label">
                                    @translate(Barcode Feature)</label>
                            </div>
                            <div class="col-lg-12">
                                <select class="form-control" name="BARCODE">
                                    <option value="Show" @if (env('BARCODE') == "Show") selected @endif>Active</option>
                                    <option value="Hide" @if (env('BARCODE') == "Hide") selected @endif>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12 text-right">
                                <button class="btn btn-primary btn-block" type="submit">
                                    @translate(Save)</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
