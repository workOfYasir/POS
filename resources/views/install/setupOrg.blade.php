@extends('install.app')
@section('content')

    <div class="card-body">
        <h3 class="text-lg-center p-3">@translate(Setup Organization)</h3>
        <form action="{{route('org.setup')}}" method="post" enctype="multipart/form-data">
            @csrf

            <div>
                <div class="form-group">
                    <label class="col-form-label text-md-right">@translate(Organization Name)</label>
                    <div>
                        <input class="form-control" name="name" type="text" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-form-label text-md-right">@translate(Organization Email)</label>
                    <div>
                        <input class="form-control" name="email" required type="email">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-form-label text-md-right">@translate(Organization Phone)</label>
                    <div>
                        <input class="form-control" name="phone" type="text">
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-form-label text-md-right">@translate(Currency Symbol)</label>
                    <div>
                        <input class="form-control" name="symbol" value="$" type="text">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-form-label text-md-right">@translate(Currency Style)</label>
                    <div>
                        <select class="form-control" name="align">
                            <option value="0">$ 100</option>
                            <option value="1">100 $</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-form-label text-md-right">@translate(Logo)</label>
                    <div>
                        <input class="form-control-file" name="newLogo" required type="file">
                    </div>
                </div>
                <hr/>
                <hr>
            </div>
            <div>
                <button class="btn btn-primary btn-block btn-block" type="submit">@translate(Save)</button>
            </div>
        </form>
    </div>
@endsection
