@extends('user._layout')
@section('content')
<div class="content-wrapper">
    <h3>{{ __('资料修改') }}</h3>
    <form action="" method="POST">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-horizontal">
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{ __('会员编号') }}</label>
                        <div class="col-sm-10">
                            <input name="huiNumber" type="text" id="{{ $user->username }}" disabled="disabled"   style="background: black"   value="a4"  class="aspNetDisabled form-control" />
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{ __('会员姓名') }}</label>
                        <div class="col-sm-10">
                            <input name="name"      value="{{ $user->name }}"       type="text" id="ContentPlaceHolder1_txt_name" class="form-control" placeholder="{{ __('请输入会员姓名') }}" />

                        </div>
                    </div>
                </fieldset>
                {{-- <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{ __('套餐级别') }}</label>
                        <div class="col-sm-10">
                            <select name="huiLevelAbcd"  style="background: black"  disabled="disabled" id="huiLevelAbcd" class="form-control">
                                        <option value="A{{ __('套餐') }}1000{{ __('美金到') }}4999{{ __('美金') }}"
                                                selected=""
                                        >A{{ __('套餐') }}1000{{ __('美金到') }}4999{{ __('美金') }}</option>
                                        <option value="B{{ __('套餐') }}5000{{ __('美金到') }}19999{{ __('美金') }}"
                                        >B{{ __('套餐') }}5000{{ __('美金到') }}19999{{ __('美金') }}</option>
                                        <option value="C{{ __('套餐') }}20000{{ __('美金到') }}49999{{ __('美金') }}"
                                        >C{{ __('套餐') }}20000{{ __('美金到') }}49999{{ __('美金') }}</option>
                                        <option value="D{{ __('套餐') }}50000{{ __('美金以上') }}"
                                        >D{{ __('套餐') }}50000{{ __('美金以上') }}</option>
                            </select>
                        </div>
                    </div>
                </fieldset> --}}
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{ __('会员级别') }}</label>
                        <div class="col-sm-10">
                            <input name="huiLevel" type="text" id="" disabled="disabled"   style="background: black"   value="{{$matching_init}}"  class="aspNetDisabled form-control" />
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{ __('邮箱') }}</label>
                        <div class="col-sm-10">
                            <input name="email"  value="{{ $user->email }} "  type="text" id="ContentPlaceHolder1_txt_mob" class="form-control" placeholder="{{ __('请输入邮箱') }}" />
                        </div>
                    </div>
                </fieldset>

                <!-- <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{ __('提币种类') }}</label>
                        <div class="col-sm-10">
                            <input name="extract_type" value="{{ optional($user->account)->extract_type }}" type="text" id="ContentPlaceHolder1_txt_yinhang" class="form-control" placeholder="{{ __('请输入提币种类') }}" />
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{ __('接收地址') }}</label>
                        <div class="col-sm-10">
                            <input name="extract_address" value="{{ optional($user->account)->extract_address }}" type="text" id="ContentPlaceHolder1_txt_yinhang_zh" class="form-control" placeholder="{{ __('请输入接收地址') }}" />
                        </div>
                    </div>
                </fieldset> -->

                <fieldset>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <input type="submit" name="ctl00$ContentPlaceHolder1$btn_enter"
                                value="{{ __('确认修改') }}"  class="btn btn-primary" />
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
    </form>
</div>
@endsection