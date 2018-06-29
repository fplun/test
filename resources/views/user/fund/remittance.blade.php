@extends('user._layout')
@section('content')
<div class="content-wrapper">
  <h3>{{ __('申请充值') }}</h3>
  <form action="" method="POST" enctype="multipart/form-data">
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="form-horizontal">
        <input name="id" value="162" type="hidden" />
        <fieldset>
          <div class="form-group">
            <label class="col-sm-2 control-label">
              <label style="color: orangered"></label>
            </label>
            <div class="col-sm-10">
              <font color="#CCCCCC">{{ __('币种') }}：{{$recharge_address['type']}}，{{ __('接收地址') }}：{{$recharge_address['address']}}</font></div>
          </div>
        </fieldset>
        <fieldset>
          <div class="form-group">
            <label class="col-sm-2 control-label">
              <label style="color: orangered"></label>{{ __('激活币') }}</label>
            <div class="col-sm-10">
              <input name="huiJhJf" id="hui_jh_jf" value="{{ $user->account->register }}" disabled="disabled" style="background: black" type="text" class="aspNetDisabled form-control" /></div>
          </div>
        </fieldset>
        <fieldset>
          <div class="form-group">
            <label class="col-sm-2 control-label">
              <label style="color: orangered">*</label>{{ __('充值金额') }}</label>
            <div class="col-sm-10">
              <input name="money" id="czmoney" type="text" class="form-control" placeholder="{{ __('申请充值金额') }}" /></div>
          </div>
        </fieldset>
        <fieldset>
          <div class="form-group">
            <label class="col-sm-2 control-label">
              <label style="color: orangered">*</label>{{ __('凭据图片') }}</label>
            <div class="col-sm-10">
              <input type="file" name="img" />
              <br/></div>
          </div>
        </fieldset>
        <fieldset>
          <div class="form-group">
            <label class="col-sm-2 control-label">
              <label style="color: orangered">*</label>{{ __('安全密码') }}</label>
            <div class="col-sm-10">
              <input name="sec_password" type="password" id="ContentPlaceHolder1_txt_pass_two" class="form-control" placeholder="{{ __('安全密码') }}" /></div>
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
              <input type="submit" value="{{ __('提交申请') }}" class="btn btn-primary" /></div>
          </div>
        </fieldset>
      </div>
    </div>
  </div>
  </form>
</div>
@endsection