@extends('user._layout')
@section('content')
<div class="content-wrapper">
    <h3>{{__('币种转换')}}</h3>
    <form method="POST" action="/turn_money">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-horizontal">
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            <label style="color:orangered"></label>{{__('众易链价格')}}</label>
                        <div class="col-sm-10">
                            <input  value="{{$set['zyl_price']}}" type="text" id="" class="form-control" placeholder="" style="background: black"  disabled="disabled"/></div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            <label style="color: orangered">*</label>{{__('转换类型')}}</label>
                        <div class="col-sm-10">
                            <select name="out_type" id="out_money_type" style="background: black" class="form-control">
                            <option value="1">{{__('ATEC(众易链)')}}</option>
                            <option value="2">{{__('激活币')}}</option>
                            <option value="3">{{__('消费币')}}</option>
                            </select>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            <label style="color:orangered"></label>{{__('可转换数量')}}</label>
                        <div class="col-sm-10">
                            <input  id="out_money" value="{{$account->zyl_money}}" type="text"  class="form-control" placeholder="" style="background: black"  disabled="disabled"/></div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            <label style="color: orangered">*</label>{{__('转换类型')}}</label>
                        <div class="col-sm-10">
                            <select name="in_type" id="in_money_type" style="background: black" class="form-control">
                            <option value="1">{{__('激活币')}}</option>
                            </select>
                        </div>
                    </div>
                </fieldset>
<script>
var zyl_money="{{$account->zyl_money}}";
var register="{{$account->register}}";
var consume="{{$account->consume}}";
var zyl_price="{{$set['zyl_price']}}";

    $("#out_money_type").change(function(){
        var money_type=$("#out_money_type").val();
        var money_html;
        if(money_type=='1'){
            $("#out_money").val(zyl_money);
            var num=(zyl_money*zyl_price).toFixed(2);
            $("#in_money").val(num);
            money_html="<option value='1'>{{__('激活币')}}</option>";
        }else if(money_type=='2'){
            $("#out_money").val(register);
            $("#in_money").val(register);
            money_html="<option value='2'>{{__('注册币')}}</option>";
        }else if(money_type=='3'){
            $("#out_money").val(consume);
            var num=(consume*zyl_price).toFixed(2);
            $("#in_money").val(num);
            money_html="<option value='2'>{{__('注册币')}}</option>";
        }
        $("#in_money_type").html(money_html);
    });
</script>
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            <label style="color:orangered"></label>{{__('可获得数量')}}</label>
                        <div class="col-sm-10">
                            <input  type="text" value="{{round($account->zyl_money*$set['zyl_price'],2)}}" id="in_money" class="form-control" placeholder=""style="background: black" disabled="disabled" /></div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            <label style="color:orangered">*</label>{{__('转换数量')}}</label>
                        <div class="col-sm-10">
                            <input name="money" type="text" value=""  class="form-control" placeholder="{{__('请输入转换数量')}}"/></div>
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
                            <input type="submit"   value="{{__('确认转换')}}"  class="btn btn-primary" /></div>
                    </div>
                </fieldset>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection