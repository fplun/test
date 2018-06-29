@extends('user._layout')
@section('content')
<div class="content-wrapper">
    <h3>{{__('算力转换')}}</h3>
    <form method="POST" action="/profit_transform">
    {{csrf_field()}}
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-horizontal">
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            <label style="color:orangered"></label>{{__('众易链价格')}}</label>
                        <div class="col-sm-10">
                            <input  type="text"  value="{{$zyl_price}}" class="form-control" style="background: black" disabled="disabled" placeholder="" /></div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            <label style="color:orangered"></label>{{__('静态收益')}}</label>
                        <div class="col-sm-10">
                            <input  type="text"  value="{{$static_profit}}" class="form-control" style="background: black" disabled="disabled" placeholder="" /></div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            <label style="color:orangered"></label>{{__('动态收益')}}</label>
                        <div class="col-sm-10">
                            <input  type="text" value="{{$dynamic_profit}}" class="form-control" style="background: black" disabled="disabled" placeholder="" /></div>
                    </div>
                </fieldset>


                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            <label style="color: orangered">*</label>{{__('转换类型')}}</label>
                        <div class="col-sm-10">
                            <select name="type" id="ContentPlaceHolder1_ddl_type" style="background: black" class="form-control">
                            <option value='0'>{{__('静态收益')}}</option>
                            <option value='1'>{{__('动态收益')}}</option>
                            <option value='2'>{{__('全部转换')}}</option>
                            </select>
                        </div>
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
                            <input type="submit" name=""  value="{{__('确认转换')}}"  class="btn btn-primary" /></div>
                    </div>
                </fieldset>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection