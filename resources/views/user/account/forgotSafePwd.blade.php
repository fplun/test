@extends('user._layout')
@section('content')
<div class="content-wrapper">
    <h3>{{ __('安全密码修改') }}</h3>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-horizontal">
            <input type="hidden" value="155" name="id"/>
                <fieldset>
                    <legend>{{ __('安全密码找回') }}</legend>
                    <div class="form-group">
                        <div class="col-sm-3">
                                <a href="/toEmailSafe"  class="btn btn-primary btn-block" style="margin-top:1em;" / >{{ __('邮箱找回') }}</a>
                                <a href="/toPhoneSafe"  class="btn btn-primary btn-block" style="margin-top:1em;" / >{{ __('手机找回') }}</a>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</div>
@endsection