@extends('user._layout')
@section('content')
<div class="content-wrapper">
    <h3>{{__('发送邮件')}}</h3>
    <div class="panel panel-default">
        <form action="" id="test_form" method="POST">
            <div class="panel-body">
                <div class="form-horizontal">
                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">
                                <label style="color: orangered">*</label>{{__('标题')}}</label>
                            <div class="col-sm-10">
                                <input name="title" type="text" id="tz_titleinput" class="form-control" placeholder="{{__('标题')}}" />
                                <label style="color: orangered;display: none" id="tz_title">*</label></div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">
                                <label style="color: orangered">*</label>{{__('内容')}}</label>
                            <div class="col-sm-10">
                                <textarea name="content" rows="10" cols="20" id="tz_contentinput" class="form-control" placeholder="{{__('内容')}}" style="margin:0px;"></textarea>
                                <label style="color: orangered;display: none" id="tz_content">*</label></div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-1">
                                <input type="submit"  value="{{__('立即发送')}}" class="btn btn-primary" /></div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection