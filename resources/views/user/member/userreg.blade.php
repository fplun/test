@extends('user._layout')
@section('content')
<div class="content-wrapper">
    <h3>{{ __('注册会员') }}</h3>
    <div class="panel panel-default">
    
        <!-- 当前会员 -->
        <form action="" method="POST">   
        <div class="panel-body">
            <div class="form-horizontal">
                <fieldset>
                    <legend>{{ __('基本信息') }}</legend>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
            <label style="color: orangered">
                *</label>{{ __('会员编号') }}</label>
                        <div class="col-sm-10">
                            <input
                            name="username" 
                                type="text" id="huiNumber" 
                            class="form-control"
                            value="{{ $username }}"
                                placeholder="{{ __('请输入会员编号') }}" 
                                onkeyup="value=value.replace(/[^\w\.\/]/ig,&#39;&#39;)" />
                            <input type="hidden" name="ctl00$ContentPlaceHolder1$hf_huiyuan_id" id="ContentPlaceHolder1_hf_huiyuan_id" />
                        </div>
                    </div>
                </fieldset>

               <!--  <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
            <label style="color: orangered">
                *</label>{{ __('会员姓名') }}</label>
                        <div class="col-sm-10">
                            <input name="name" type="text" id="huiName" class="form-control" placeholder="{{ __('请输入会员姓名') }}" />

                        </div>
                    </div>
                </fieldset> -->
                {{-- <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                        <label style="color: orangered">*</label>{{ __('套餐级别') }}</label>
                        <div class="col-sm-10">
                            <select name="huiLevelAbcd" id="huiLevelAbcd" class="form-control">
                                        <option value="A套餐1000美金到4999美金">A套餐1000美金到4999美金</option>
                                        <option value="B套餐5000美金到19999美金">B套餐5000美金到19999美金</option>
                                        <option value="C套餐20000美金到49999美金">C套餐20000美金到49999美金</option>
                                        <option value="D套餐50000美金以上">D套餐50000美金以上</option>
                            </select>
                        </div>
                    </div>
                </fieldset> --}}
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                        <label style="color: orangered">*</label>{{ __('投资额度') }}</label>
                        <div class="col-sm-10">
                            <input name="money" type="text" id="huiLevel" class="form-control" placeholder="{{ __('请输入投资额度') }}" />
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
            <label style="color: orangered">
                *</label>{{ __('推荐人编号') }}</label>
                        <div class="col-sm-10">
                            <input name="recommend" 
                            type="text" 
                            id="ContentPlaceHolder1_txt_tuijian" 
                            class="form-control" 
                            value="{{ $user->username }}"
                            placeholder="{{ __('请输入会员编号') }}" 
                            onkeyup="value=value.replace(/[^\w\.\/]/ig,&#39;&#39;)" />
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
            <label style="color: orangered">
                *</label>{{ __('接点人编号') }}</label>
                        <div class="col-sm-10">
                            <input 
                                    value="{{ $top_user ? $top_user : $user->username }}"
                            name="contact" 
                            type="text" id="ContentPlaceHolder1_txt_jiedian" 
                            class="form-control" 
                            placeholder="{{ __('请输入接点人编号') }}" 
                            onkeyup="value=value.replace(/[^\w\.\/]/ig,&#39;&#39;)" />

                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
            <label style="color: orangered">
                *</label>{{ __('位置') }}</label>
                        <div class="col-sm-10">
                            <select name="position" id="ContentPlaceHolder1_ddl_weizhi" class="form-control">
                                <option value="1" {{ $position==1 ? 'selected' : '' }}>A{{ __('区') }}</option>
                                <option value="2" {{ $position==2 ? 'selected' : '' }}>B{{ __('区') }}</option>
                            </select>
                        </div>
                    </div>
                </fieldset>

                {{-- <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
            <label style="color: orangered">
                *</label>{{ __('手机号码') }}</label>
                        <div class="col-sm-10">
                            <input name="phone" type="text" id="huiPhone" class="form-control" placeholder="{{ __('请输入您的手机号') }}" />

                        </div>
                    </div>
                </fieldset> --}}
                
                
                    <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
            <label style="color: orangered">
                *</label>{{ __('邮箱') }}</label>
                        <div class="col-sm-10">
                            <input name="email" type="text" id="huiEmail" class="form-control" placeholder="{{ __('请输入您的邮箱') }}" />
                        </div>
                    </div>
                </fieldset>
                

                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
            <label style="color: orangered">
                *</label>{{ __('一级密码') }}</label>
                        <div class="col-sm-10">
                            <input name="password" type="text"
                                value="111111"
                                    id="ContentPlaceHolder1_txt_pass" class="form-control" placeholder="{{ __('请输入一级密码') }}" />
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            <label style="color: orangered">
                            *</label>{{ __('二级密码') }}</label>
                        <div class="col-sm-10">
                            <input name="sec_password" 
                            value="222222"
                            type="text" id="ContentPlaceHolder1_txt_pass_two" class="form-control" placeholder="{{ __('请输入二级密码') }}" />

                        </div>
                    </div>
                </fieldset>
             <!--    <fieldset>
                    <legend>{{ __('会员帐号信息') }}</legend>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
            <label style="color: orangered">
                *</label>{{ __('提币种类') }}</label>
                        <div class="col-sm-10">
                            <input name="extract_type" type="text" value="1" id="ContentPlaceHolder1_txt_yinhang" class="form-control" placeholder="{{ __('请输入提币种类') }}" />
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                        <label style="color: orangered">
                            *</label>{{ __('接收地址') }}</label>
                        <div class="col-sm-10">
                            <input name="extract_address"  value="1" type="text" id="ContentPlaceHolder1_txt_yinhang_zh" class="form-control" placeholder="{{ __('请输入接收地址') }}" />
                        </div>
                    </div>
                </fieldset> -->

                <fieldset>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <input type="submit"  value="{{ __('确认注册') }}" class="btn btn-primary" />
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        </form>
    </div>
</div>

@endsection