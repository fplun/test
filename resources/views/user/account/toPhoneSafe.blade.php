@extends('user._layout')
@section('content')
<div class="content-wrapper">
    <h3>{{ __('安全密码找回') }}-{{ __('邮箱') }}</h3>
    <form action="" method="POST">
    <div class="account-box">
        <div class="form-group">
            <input name="huiNumber" type="hidden" id="login" lay-verify="huiNumber" class="form-control" value="a4" placeholder="{{ __('请输入会员编号') }}" />												
            <input name="huiPhone" type="text" id="login" lay-verify="huiEmail" class="form-control" placeholder="{{ __('请输入您的手机号') }}" />
        </div>
        <div class="form-group">
            <table cellpadding="0" cellspacing="0" style="width:100%;">
                <tr>
                    <td style="width:60%;">
                        <input name="code" type="text" id="" lay-verify="required" class="form-control" placeholder="{{ __('手机验证码') }}" />
                    </td>
                    <td >
                        <!-- <img id="checkimg" src="images/yzm.jpg" style="cursor:pointer;margin-right:2px;border-radius:3px;width:97%;height:38px;display:block;float:right;" /> -->
                            <div class='validation' style="opacity: 1; right: 31px;top: 8px;">
                                <input type="button" id="btn"   class="btn btn-primary btn-block" 
                                style="border: 0;right: -3px;top: 7px;cursor: pointer;width: 200px;"
                                value="{{ __('免费获取验证码') }}" 
                                onclick="settime(this);sendcode();" /> 
                            </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="other-login" style="text-align:left;color: #fff;">
            <i></i>
            <a href="javascript:window.history.go(-1)"  style="color: #fff;">{{ __('返回') }}</a>
        </div>
        <div class='success' style="color:#fff;"></div>
        <input type="submit"   name="Button1"  lay-submit="" lay-filter="login" 
            id="loginbtn"  value="{{ __('找回密码') }}" class="btn btn-primary btn-block" style="margin-top:1em;" />
                                
        <div class="row-block">
            <div class="row" style="text-align:center;margin-top:2em;cursor:pointer;letter-spacing:0.8px;">
            </div>
        </div>
    </div>
    </form>
</div>

<script type="text/javascript"> 
    var countdown=60; 
    function settime(obj) { 
            var login = $('input[name="huiPhone"]').val();
            if(isPoneAvailable(login)){
                if (countdown == 0) { 
                    obj.removeAttribute("disabled");    
                    obj.value="{{ __('免费获取验证码') }}"; 
                    countdown = 60; 
                    return;
                } else { 
                    obj.setAttribute("disabled", true); 
                    obj.value="{{ __('重新发送') }}(" + countdown + ")"; 
                    countdown--; 
                } 
            setTimeout(function() { 
                settime(obj) }
                ,1000) 
            }else{
                // alert("{{ __('请输入正确的手机号') }}");
            }
        
    }
    function sendcode(){
            var login = $('input[name="huiPhone"]').val();
            if(isPoneAvailable(login)){
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    async:false,
                    url: "/sendcodesafe",
                    data: {
                        phone:login
                    },
                    success: function (obj) {
                            if(obj.Status=='ok'){
                                alert("{{ __('发送成功') }},{{ __('请注意查收') }}");
                            }else{
                                alert("{{ __('发送失败') }}："+obj.Erro);
                                return false;
                            }
                    },
                    error: function(data) {
                        alert("{{ __('网络错误') }}");
                    }
                });
            }else{
                alert("{{ __('请输入正确的手机号') }}");
            }
    }
    function isPoneAvailable(str) {
        var myreg=/^[1][3,4,5,7,8][0-9]{9}$/;
        if (!myreg.test(str)) {
            return false;
        } else {
            return true;
        }
    }
</script>
@endsection