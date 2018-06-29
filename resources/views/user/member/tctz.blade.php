@extends('user._layout')
@section('content')
    <div class="content-wrapper">
        <h3>{{__('增加配套')}}</h3>
        <div class="panel panel-default">
            <form method="POST" action="/lock_add">
            {{csrf_field()}}
            <div class="panel-body">
                <div class="form-horizontal">
                    <fieldset>
                        <input type="hidden" value="148"  name="id"/>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{__('会员编号')}}</label>
                            <div class="col-sm-10">
                                <input name="" type="text" id=""   style="background: black"  value="{{$user->username}}"  class="aspNetDisabled form-control"  disabled="disabled"/>
                                <input type="hidden" name="" id="" />
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{__('会员姓名')}}</label>
                            <div class="col-sm-10">
                                <input name="" type="text" id=""  value="{{$user->name}}"   style="background: black"   disabled="disabled"      class="form-control"  />
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{ __('众易链价格') }}</label>
                            <div class="col-sm-10">
                                <input name="" type="text" id=""  value="{{$zyl_price}}"   style="background: black"   disabled="disabled"      class="form-control"  />
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{ __('锁仓天数') }}</label>
                            <div class="col-sm-10">
                                <input name="" type="text" id=""  value="{{$matching_day}}"   style="background: black"   disabled="disabled"      class="form-control"/>
                            </div>
                        </div>
                    </fieldset>


                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{ __('激活币数量') }}</label>
                            <div class="col-sm-10">
                                <input name="" type="text" id=""  value="{{$account->register}}"   style="background: black"   disabled="disabled"      class="form-control"/>
                            </div>
                        </div>
                    </fieldset>


                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{ __('增加配套') }}</label>
                            <div class="col-sm-10">
                                    <input name="money" type="num" id="" style="background: black"   class="form-control" placeholder="{{ __('100美金倍数上不封顶复投') }}" />
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <input type="submit"  value="{{ __('确认投资') }}" class="btn btn-primary" />
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>

            </form>
        </div>

    </div>
@endsection