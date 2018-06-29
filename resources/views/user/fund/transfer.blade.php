@extends('user._layout')
@section('content')
<div class="content-wrapper">
    <h3>{{__('会员转账')}}</h3>
    <div class="panel panel-default">
    <form method="POST" action="/deal_make">
    {{csrf_field()}}
        <div class="panel-body">
            <div class="form-horizontal">
                <input name="id" value="160" type="hidden" />
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            <label style="color:orangered"></label>{{__('激活币')}}</label>
                        <div class="col-sm-10">
                            <input type="text" id="hui_jh_jf" value="{{$account->register}}" disabled="disabled" style="background: black" class="aspNetDisabled form-control" /></div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            <label style="color:orangered"></label>{{__('注册币')}}</label>
                        <div class="col-sm-10">
                            <input  type="text" id="hui_zcjf" value="{{$account->agio}}" disabled="disabled" style="background: black" class="aspNetDisabled form-control" /></div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            <label style="color:orangered">*</label>{{__('会员编号')}}</label>
                        <div class="col-sm-10">
                            <input name="username" type="text" id="hui_number" class="form-control" placeholder="{{__('会员编号')}}" /></div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            <label style="color: orangered">*</label>{{__('转账类型')}}</label>
                        <div class="col-sm-10">
                            <select name="type" id="ContentPlaceHolder1_ddl_type" class="form-control">
                                <option value="0">{{__('激活币')}}</option>
                                <option value="1">{{__('注册币')}}</option></select>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            <label style="color:orangered">*</label>{{__('转账金额')}}</label>
                        <div class="col-sm-10">
                            <input name="money" type="text" id="zhmoney" class="form-control" placeholder="{{__('转账金额')}}" /></div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            <label style="color:orangered">*</label>{{__('安全密码')}}</label>
                        <div class="col-sm-10">
                            <input name="sec_password" type="password" class="form-control" placeholder="{{__('安全密码')}}" /></div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <input type="submit" name=""  value="{{__('确认转账')}}"  class="btn btn-primary" /></div>
                    </div>
                </fieldset>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection