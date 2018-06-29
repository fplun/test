@extends('user._layout')
@section('content')
<div class="content-wrapper">
    <h3>{{ __('登录密码修改') }}</h3>
    <form method="post" action="">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-horizontal">
                <fieldset>
                    <legend>{{ __('可改信息') }}</legend>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{ __('安全密码') }}</label>
                        <div class="col-sm-10">
                            <input name="sec_password" type="password" class="form-control input-sm" />
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{ __('新登录密码') }}</label>
                        <div class="col-sm-10">
                            <input name="password" type="password" 
                             class="form-control input-sm" />
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{ __('确认登录密码') }}</label>
                        <div class="col-sm-10">
                            <input name="password_confirmation" type="password"   class="form-control input-sm" />
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
                            <input type="submit"
                                value="{{ __('保存') }}" id="ContentPlaceHolder1_btn_enter" class="btn btn-primary" />
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
    </form>
</div>
@endsection