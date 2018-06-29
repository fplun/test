@extends('user._layout')
@section('content')

<div class="content-wrapper">
    <h3>{{__('提币')}}</h3>
    <form method="POST" action="/extracts_make">
    {{csrf_field()}}
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-horizontal">

            <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            <label style="color: orangered"></label>{{__('众易链数量')}}</label>
                        <div class="col-sm-10">
                            <input value="{{$account->zyl_money}}" id="ho_tb_jj" type="text" class="form-control" style="background: black" placeholder="" disabled="disabled" /></div>
                    </div>
                </fieldset>

            <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            <label style="color: orangered">*</label>{{__('提币到')}}</label>
                        <div class="col-sm-10">
                            <select name="type" id="ContentPlaceHolder1_ddl_type" style="background: black" class="form-control">
                            <option value='1'>{{__('以太坊电子钱包')}}</option>
                            <option value='2'>{{__('众易链电子钱包')}}</option>
                            </select>
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            <label style="color: orangered">*</label><span id="address_name">{{__('以太坊')}}</span>{{__('接收地址')}}</label>
                        <div class="col-sm-10">
                            <input name="address" type="text" id="ho_js_address" value="{{old('address')}}" class="aspNetDisabled form-control" /></div>
                    </div>
                </fieldset>

<script>
$("#ContentPlaceHolder1_ddl_type").change(function(){
    $("#ho_js_address").val('');
    var address_name=$("#address_name").html();
    if(address_name=="{{__('以太坊')}}"){
        $("#address_name").html("{{__('众易链')}}");
    }else{
        $("#address_name").html("{{__('以太坊')}}");
    }
});
</script>

                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            <label style="color: orangered">*</label>{{__('提币数量')}}</label>
                        <div class="col-sm-10">
                            <input name="money" id="ho_tb_jj" type="text" class="form-control" placeholder="{{__('提币数量')}}" /></div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            <label style="color: orangered">*</label>{{__('安全密码')}}</label>
                        <div class="col-sm-10">
                            <input name="sec_password" type="password" class="form-control" placeholder="{{__('安全密码')}}" /></div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <input type="submit"  value="{{__('提交申请')}}" class="btn btn-primary" /></div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
    </form>
</div>
@endsection