@extends('admin.master')

@section('content')
<div class="row">
    <div class="col-lg-6 col-sm-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title text-center">
                    @translate(SMTP Settings)</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" action="{{ route('env_key_update.update') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="MAIL_DRIVER">
                        <div class="col-lg-3">
                            <label class="control-label">
                                @translate(MAIL DRIVER)</label>
                        </div>
                        <div class="col-lg-12">
                            <select class="form-control" name="MAIL_DRIVER">
                                <option value="sendmail" @if (env('MAIL_DRIVER') == "sendmail") selected @endif>Sendmail</option>
                                    <option value="smtp" @if (env('MAIL_DRIVER') == "smtp") selected @endif>SMTP</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="MAIL_HOST">
                        <div class="col-lg-3">
                            <label class="control-label">
                                @translate(MAIL HOST)</label>
                        </div>
                        <div class="col-lg-12">
                            <input type="text" class="form-control" name="MAIL_HOST" value="{{  env('MAIL_HOST') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="MAIL_PORT">
                        <div class="col-lg-3">
                            <label class="control-label">
                                @translate(MAIL PORT)</label>
                        </div>
                        <div class="col-lg-12">
                            <input type="text" class="form-control" name="MAIL_PORT" value="{{  env('MAIL_PORT') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="MAIL_USERNAME">
                        <div class="col-lg-3">
                            <label class="control-label">
                                @translate(MAIL USERNAME)</label>
                        </div>
                        <div class="col-lg-12">
                            <input type="text" class="form-control" name="MAIL_USERNAME" value="{{  env('MAIL_USERNAME') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="MAIL_PASSWORD">
                        <div class="col-lg-3">
                            <label class="control-label">
                                @translate(MAIL PASSWORD)</label>
                        </div>
                        <div class="col-lg-12">
                            <input type="password" class="form-control" name="MAIL_PASSWORD" value="{{  env('MAIL_PASSWORD') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="MAIL_ENCRYPTION">
                        <div class="col-lg-3">
                            <label class="control-label">
                                @translate(MAIL ENCRYPTION)</label>
                        </div>
                        <div class="col-lg-12">
                            <input type="text" class="form-control" name="MAIL_ENCRYPTION" value="{{  env('MAIL_ENCRYPTION') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="MAIL_FROM_ADDRESS">
                        <div class="col-lg-3">
                            <label class="control-label">
                                @translate(MAIL FROM ADDRESS)</label>
                        </div>
                        <div class="col-lg-12">
                            <input type="text" class="form-control" name="MAIL_FROM_ADDRESS" value="{{  env('MAIL_FROM_ADDRESS') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="MAIL_FROM_NAME">
                        <div class="col-lg-3">
                            <label class="control-label">
                                @translate(MAIL FROM NAME)</label>
                        </div>
                        <div class="col-lg-12">
                            <input type="text" class="form-control" name="MAIL_FROM_NAME" value="{{  env('MAIL_FROM_NAME') }}" required>
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
    <div class="col-lg-6 col-sm-12">
        <div class="panel bg-gray-light">
            <div class="panel-body">
                <h4>
                    @translate(Instruction)</h4>
                    <p class="text-danger">
                        @translate(Please be carefull when you are configuring SMTP.)
                        @translate(For incorrect configuration you will get error)</p>
                    <hr>
                    <p>
                        @translate(For Non-SSL)</p>
                    <ul class="list-group">
                        <li class="list-group-item text-dark">
                            @translate(Select 'sendmail' for Mail Driver if you face any issue after configuring 'smtp' as Mail Driver )</li>
                        <li class="list-group-item text-dark">
                            @translate(Set Mail Host according to your server Mail Client Manual Settings)</li>
                        <li class="list-group-item text-dark">
                            @translate(Set Mail port as '587')</li>
                        <li class="list-group-item text-dark">
                            @translate(Set Mail Encryption as 'ssl' if you face issue with 'tls')</li>
                    </ul>
                    <hr>
                    <p>
                        @translate(For SSL)</p>
                    <ul class="list-group mar-no">
                        <li class="list-group-item text-dark">
                            @translate(Select 'sendmail' for Mail Driver if you face any issue after configuring 'smtp' as Mail Driver)</li>
                        <li class="list-group-item text-dark">
                            @translate(Set Mail Host according to your server Mail Client Manual Settings)</li>
                        <li class="list-group-item text-dark">
                            @translate(Set Mail port as '465')</li>
                        <li class="list-group-item text-dark">
                            @translate(Set Mail Encryption as 'ssl')</li>
                    </ul>
            </div>
        </div>
    </div>
</div>

@endsection
