@extends('user._layout')
@section('content')
<div class="content-wrapper">
    <h3>{{ __('安全密码修改') }}</h3>
    <form method="POST" action="">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-horizontal">
            <input type="hidden" value="155" name="id"/>
                <fieldset>
                    <legend>{{ __('可改信息') }}</legend>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{ __('安全密码') }}</label>
                        <div class="col-sm-10">
                            <input name="sec_password" type="password" id="old" class="form-control input-sm" />
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{ __('新安全密码') }}</label>
                        <div class="col-sm-10">
                            <input name="password" type="password" 
                            id="newpwd"  class="form-control input-sm" />
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{ __('确认新安全密码') }}</label>
                        <div class="col-sm-10">
                            <input  name="password_confirmation" type="password"  id="newagin"  class="form-control input-sm" />
                        </div>
                    </div>
                </fieldset>
                    <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                                <label style="color: red"></label>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <input type="submit" value="{{ __('保存') }}" class="btn btn-primary" />
                            <input type="button" onclick="javascript:window.location.href='/toEmailSafe'"  value="{{ __('忘记安全密码') }}？" class="btn btn-primary" />
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
    </form>
</div>
@endsection