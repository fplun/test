<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="bb">
          <div class="page-content">
            <div class="container-fluid">
              <div class="row-fluid">
                <div class="span12">
                  <div class="portlet box grey">
                    <div class="portlet-body" style="overflow: auto;">
                      <table cellspacing="0" cellpadding="0" width="100%">
                        <tbody>
                          <tr>
                            <td valign="top" align="middle" width="100%" colspan="0">
                              <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="content">
                                <tr>
                                  <td align="center">
                                  <br> 请输入会员编号： <input style="border-radius: 5px; height: 32px; padding-left: 10px; line-height: 32px; color: #333; border: none;" name="username" value="" type="text" maxlength="20" class="span3 m-wrap"> 
																			
                                      <input style="color: #666; font-size: 14px; border: none; border-radius: 5px;" type="submit"  value="查 询 " class="btn blue"> <a href="#" class="col-xs-12">
                                          ＊友情提示：输入框中，不输入即为抵达网络图顶端 </a>
                                    <table width="100" align="center" cellpadding="0" cellspacing="0" class="add_node_table">
                                      <tbody>
                                        <tr class="fir_level">
                                          <td valign="top" align="middle" width="100%" colspan="2">
                                            <table cellspacing="1" cellpadding="0" bgcolor="#517db1" border="0" class="yeah">
                                              <tbody>
                                                <tr>
                                                  <td>
                                                    <!-- 获取自己本身 -->
                                                    <table border="0" width="200" align="center" bordercolor="#cae2f7" bgcolor="#ffffff" class="Table1">
                                                      <tbody>
                                                        <tr align="middle">
                                                          <td colspan="3" valign="middle">
                                                            <span style="font-weight: bold; color: white;">
                                                              <a href="/networkDiagram?username={{ $user->username }}" class="yeah-tab-a" level="1" offset="left">
                                                                <font color="#ffffff">{{ $user->username }}
                                                                    @php
                                                                    $pid = $user->username;
                                                                    @endphp
                                                                  <br>{{ $user->name }}</font></a>
                                                            </span>
                                                          </td>
                                                        </tr>
                                                        <tr align="middle">
                                                          <td valign="center">
                                                             <font color="#ffffff">{{$user->A}}$</font></td> 
                                                          <td valign="center">
                                                             <font color="#ffffff">总</font></td> 
                                                          <td valign="center">
                                                             <font color="#ffffff">{{$user->B}}$</font></td> 
                                                        </tr>
                                                        <tr align="middle" bgcolor="">
                                                          <td align="center" valign="center">
                                                             <font color="#ffffff">{{$user->A_count}}</font></td> 
                                                          <td align="center" valign="center">
                                                             <font color="#ffffff">人</font></td> 
                                                          <td align="center" valign="center">
                                                             <font color="#ffffff">{{$user->B_count}}</font></td> 
                                                        </tr>
                                                      </tbody>
                                                    </table>
                                                  </td>
                                                </tr>
                                              </tbody>
                                            </table>
                                          </td>
                                        </tr>
                                        <tr class="sec_level_tr">
                                          <td valign="top" class="left">
                                            <table cellspacing="0" cellpadding="0">
                                              <tbody>
                                                <tr class="sec_level_con">
                                                  <td valign="top" align="middle" width="100%" colspan="2">
                                                    <table cellspacing="1" cellpadding="0" bgcolor="#517db1" border="0" class="yeah">
                                                      <tbody>
                                                        <tr>
                                                          <td>
                                                            <table border="0" width="200" align="center" bordercolor="#cae2f7" bgcolor="#ffffff" class="Table1">
                                                              <tbody>
                                                                @if(isset($list[1][0]))
                                                                <tr align="middle">
                                                                  <td colspan="3" valign="middle">
                                                                    <span style="font-weight: bold; color: white;">
                                                                      <a href="#" class="yeah-tab-a" level="2" offset="left">
                                                                        <font color="#ffffff">{{ $list[1][0]->user->username }} 
                                                                          <br>{{ $list[1][0]->user->name }}</font></a>
                                                                    </span>
                                                                  </td>
                                                                </tr>
                                                                <tr align="middle">
                                                                  <td valign="center">
                                                                     <font color="#ffffff">{{$list[1][0]->A}}$</font></td> 
                                                                  <td valign="center">
                                                                     <font color="#ffffff">总</font></td> 
                                                                  <td valign="center">
                                                                     <font color="#ffffff">{{$list[1][0]->B}}$</font></td> 
                                                                </tr>
                                                                <tr align="middle" bgcolor="">
                                                                  <td align="center" valign="center">
                                                                     <font color="#ffffff">{{$list[1][0]->A_count}}</font></td> 
                                                                  <td align="center" valign="center">
                                                                     <font color="#ffffff">人</font></td> 
                                                                  <td align="center" valign="center">
                                                                     <font color="#ffffff">{{$list[1][0]->B_count}}</font></td> 
                                                                </tr>
                                                                @else
                                                                <tr align="middle">
                                                                    <td colspan="3" align="center" valign="center">
                                                                    <a href="/userreg?position=1&top_uid={{ $list[0]->id }}">注册</a></td>
                                                                </tr>
                                                                @endif
                                                              </tbody>
                                                            </table>
                                                          </td>
                                                        </tr>
                                                      </tbody>
                                                    </table>
                                                  </td>
                                                  <td valign="top" align="middle" width="100%" colspan="2">
                                                    <table cellspacing="1" cellpadding="0" bgcolor="#517db1" border="0" class="yeah">
                                                      <tbody>
                                                          <tr>
                                                              <td>
                                                                  <table border="0" width="200" align="center" bordercolor="#cae2f7" bgcolor="#ffffff" class="Table1">
                                                                      <tbody>
                                                                @if(isset($list[1][1]))
                                                                <tr align="middle">
                                                                  <td colspan="3" valign="middle">
                                                                    <span style="font-weight: bold; color: white;">
                                                                      <a href="#" class="yeah-tab-a" level="2" offset="left">
                                                                        <font color="#ffffff">{{ $list[1][1]->user->username }}
                                                                          <br>{{ $list[1][1]->user->name }}</font></a>
                                                                    </span>
                                                                  </td>
                                                                </tr>
                                                                <tr align="middle">
                                                                  <td valign="center">
                                                                     <font color="#ffffff">{{ $list[1][1]->A }}$</font></td> 
                                                                  <td valign="center">
                                                                     <font color="#ffffff">总</font></td> 
                                                                  <td valign="center">
                                                                     <font color="#ffffff">{{ $list[1][1]->B }}$</font></td> 
                                                                </tr>
                                                                <tr align="middle" bgcolor="">
                                                                  <td align="center" valign="center">
                                                                     <font color="#ffffff">{{ $list[1][1]->A_count }}</font></td> 
                                                                  <td align="center" valign="center">
                                                                     <font color="#ffffff">人</font></td> 
                                                                  <td align="center" valign="center">
                                                                     <font color="#ffffff">{{ $list[1][1]->B_count }}</font></td> 
                                                                </tr>
                                                                @else
                                                                <tr align="middle">
                                                                    <td colspan="3" align="center" valign="center">
                                                                    <a href="/userreg?position=2&top_uid={{ $list[0]->id }}">注册</a></td>
                                                                </tr>
                                                                @endif
                                                              </tbody>
                                                            </table>
                                                          </td>
                                                        </tr>
                                                      </tbody>
                                                    </table>
                                                  </td>
                                                </tr>
                                                <tr class="sec_level_thr_tr">
                                                  @if(isset($list[1][0]))
                                                  <td valign="top">
                                                    <table cellspacing="0" cellpadding="0">
                                                      <tbody class="add_node_l">
                                                        <tr class="sec_level_thr_l_tr_con">
                                                          <td valign="top" align="middle" width="100%" colspan="2">
                                                            <table cellspacing="1" cellpadding="0" bgcolor="#517db1" border="0" class="yeah">
                                                              <tbody>
                                                                <tr>
                                                                  <td>
                                                                    <table border="0" width="200" align="center" bordercolor="#cae2f7" bgcolor="#ffffff" class="Table1">
                                                                      <tbody>
                                                                        @if(isset($list[2][0]))
                                                                            <tr align="middle">
                                                                            <td colspan="3" valign="middle">
                                                                                <span style="font-weight: bold; color: white;">
                                                                                <a href="#" class="yeah-tab-a" level="2" offset="left">
                                                                                    <font color="#ffffff">{{ $list[2][0]->user->username }}
                                                                                    <br>{{ optional($list[2][0]->user)->name }}</font></a>
                                                                                </span>
                                                                            </td>
                                                                            </tr>
                                                                            <tr align="middle">
                                                                            <td valign="center">
                                                                                 <font color="#ffffff">{{ $list[2][0]->A }}$</font></td> 
                                                                            <td valign="center">
                                                                                 <font color="#ffffff">总</font></td> 
                                                                            <td valign="center">
                                                                                 <font color="#ffffff">{{ $list[2][0]->B }}$</font></td> 
                                                                            </tr>
                                                                            <tr align="middle" bgcolor="">
                                                                            <td align="center" valign="center">
                                                                                 <font color="#ffffff">{{ $list[2][0]->A_count }}</font></td> 
                                                                            <td align="center" valign="center">
                                                                                 <font color="#ffffff">人</font></td> 
                                                                            <td align="center" valign="center">
                                                                                 <font color="#ffffff">{{ $list[2][0]->B_count }}</font></td> 
                                                                            </tr>
                                                                            @else
                                                                            <tr align="middle">
                                                                                <td colspan="3" align="center" valign="center">
                                                                                <a href="/userreg?position=1&top_uid={{ $list[1][0]->user->username }}">注册</a></td>
                                                                            </tr>
                                                                            @endif
                                                                      </tbody>
                                                                    </table>
                                                                  </td>
                                                                </tr>
                                                              </tbody>
                                                            </table>
                                                          </td>
                                                        </tr>
                                                        <tr class="four_level_l">
                                                          @if(isset($list[2][0]))
                                                          <td valign="top" class="right_reg">
                                                            <table cellspacing="0" cellpadding="0">
                                                              <tbody>
                                                                <tr>
                                                                  <td valign="top" align="middle" width="100%" colspan="2">
                                                                    <table cellspacing="1" cellpadding="0" width="82" bgcolor="#517dbf" border="0">
                                                                      <tbody>
                                                                        <tr>
                                                                          <td>
                                                                            <table class="Table1" bordercolor="#cae2f7" cellspacing="1" cellpadding="1" width="200" align="center" bgcolor="#ffffff" border="0">
                                                                              <tbody>
                                                                                @if(isset($list[3][0]))
                                                                                    <tr align="middle">
                                                                                    <td colspan="3" valign="middle">
                                                                                        <span style="font-weight: bold; color: white;">
                                                                                        <a href="#" class="yeah-tab-a" level="2" offset="left">
                                                                                            <font color="#ffffff">{{ $list[3][0]->user->username }}
                                                                                            <br>{{ optional($list[3][0]->user)->username }}</font></a>
                                                                                        </span>
                                                                                    </td>
                                                                                    </tr>
                                                                                    <tr align="middle">
                                                                                    <td valign="center">
                                                                                         <font color="#ffffff">{{$list[3][0]->A}}$</font></td> 
                                                                                    <td valign="center">
                                                                                         <font color="#ffffff">总</font></td> 
                                                                                    <td valign="center">
                                                                                         <font color="#ffffff">{{$list[3][0]->B}}$</font></td> 
                                                                                    </tr>
                                                                                    <tr align="middle" bgcolor="">
                                                                                    <td align="center" valign="center">
                                                                                         <font color="#ffffff">{{$list[3][0]->A_count}}</font></td> 
                                                                                    <td align="center" valign="center">
                                                                                         <font color="#ffffff">人</font></td> 
                                                                                    <td align="center" valign="center">
                                                                                         <font color="#ffffff">{{$list[3][0]->B_count}}</font></td> 
                                                                                    </tr>
                                                                                    @else
                                                                                    <tr align="middle">
                                                                                        <td colspan="3" align="center" valign="center">
                                                                                        <a href="/userreg?position=1&top_uid={{ $list[2][0]->user->username }}">注册</a></td>
                                                                                    </tr>
                                                                                    @endif
                                                                              </tbody>
                                                                            </table>
                                                                          </td>
                                                                        </tr>
                                                                      </tbody>
                                                                    </table>
                                                                  </td>
                                                                </tr>
                                                              </tbody>
                                                            </table>
                                                          </td>
                                                          @endif

                                                          @if(isset($list[2][0]))
                                                          <td valign="top" class="right_reg">
                                                            <table cellspacing="0" cellpadding="0">
                                                              <tbody>
                                                                <tr>
                                                                  <td valign="top" align="middle" width="100%" colspan="2">
                                                                    <table cellspacing="1" cellpadding="0" width="82" bgcolor="#517dbf" border="0">
                                                                      <tbody>
                                                                        <tr>
                                                                          <td>
                                                                            <table class="Table1" bordercolor="#cae2f7" cellspacing="1" cellpadding="1" width="200" align="center" bgcolor="#ffffff" border="0">
                                                                              <tbody>
                                                                                @if(isset($list[3][1]))
                                                                                    <tr align="middle">
                                                                                    <td colspan="3" valign="middle">
                                                                                        <span style="font-weight: bold; color: white;">
                                                                                        <a href="#" class="yeah-tab-a" level="2" offset="left">
                                                                                            <font color="#ffffff">{{ $list[3][1]->username }}
                                                                                            <br>{{ optional($list[3][1]->user)->username }}</font></a>
                                                                                        </span>
                                                                                    </td>
                                                                                    </tr>
                                                                                    <tr align="middle">
                                                                                    <td valign="center">
                                                                                         <font color="#ffffff">{{ $list[3][1]->A }}$</font></td> 
                                                                                    <td valign="center">
                                                                                         <font color="#ffffff">总</font></td> 
                                                                                    <td valign="center">
                                                                                         <font color="#ffffff">{{ $list[3][1]->B }}$</font></td> 
                                                                                    </tr>
                                                                                    <tr align="middle" bgcolor="">
                                                                                    <td align="center" valign="center">
                                                                                         <font color="#ffffff">{{ $list[3][1]->A_count }}</font></td> 
                                                                                    <td align="center" valign="center">
                                                                                         <font color="#ffffff">人</font></td> 
                                                                                    <td align="center" valign="center">
                                                                                         <font color="#ffffff">{{ $list[3][1]->B_count }}</font></td> 
                                                                                    </tr>
                                                                                    @else
                                                                                    <tr align="middle">
                                                                                        <td colspan="3" align="center" valign="center">
                                                                                        <a href="/userreg?position=2&top_uid={{ $list[2][0]->user->username }}">注册</a></td>
                                                                                    </tr>
                                                                                    @endif
                                                                              </tbody>
                                                                            </table>
                                                                          </td>
                                                                        </tr>
                                                                      </tbody>
                                                                    </table>
                                                                  </td>
                                                                </tr>
                                                              </tbody>
                                                            </table>
                                                          </td>
                                                         @endif
                                                        </tr>
                                                      </tbody>
                                                    </table>
                                                  </td>
                                                  @endif

                                                  @if(isset($list[1][0]))
                                                  <td valign="top">
                                                    <table cellspacing="0" cellpadding="0">
                                                      <tbody class="add_node_l">
                                                        <tr class="sec_level_thr_l_tr_con">
                                                          <td valign="top" align="middle" width="100%" colspan="2">
                                                            <table cellspacing="1" cellpadding="0" bgcolor="#517db1" border="0" class="yeah">
                                                              <tbody>
                                                                <tr>
                                                                  <td>
                                                                    <table border="0" width="200" align="center" bordercolor="#cae2f7" bgcolor="#ffffff" class="Table1">
                                                                      <tbody>
                                                                        @isset($list[2][1])
                                                                        <tr align="middle">
                                                                          <td colspan="3" valign="middle">
                                                                            <span style="font-weight: bold; color: white;">
                                                                              <a href="#" class="yeah-tab-a" level="3" offset="left">
                                                                                <font color="#ffffff">{{ $list[2][1]->user->username }}
                                                                                  <br>{{ $list[2][1]->user->name }}</font></a>
                                                                            </span>
                                                                          </td>
                                                                        </tr>
                                                                        <tr align="middle">
                                                                          <td valign="center">
                                                                             <font color="#ffffff">{{ $list[2][1]->A }}$</font></td> 
                                                                          <td valign="center">
                                                                             <font color="#ffffff">总</font></td> 
                                                                          <td valign="center">
                                                                             <font color="#ffffff">{{ $list[2][1]->B }}$</font></td> 
                                                                        </tr>
                                                                        <tr align="middle" bgcolor="">
                                                                          <td align="center" valign="center">
                                                                             <font color="#ffffff">{{ $list[2][1]->A_count }}</font></td> 
                                                                          <td align="center" valign="center">
                                                                             <font color="#ffffff">人</font></td> 
                                                                          <td align="center" valign="center">
                                                                             <font color="#ffffff">{{ $list[2][1]->B_count }}</font></td> 
                                                                        </tr>
                                                                        @else
                                                                        <tr align="middle">
                                                                            <td colspan="3" align="center" valign="center">
                                                                            <a href="/userreg?position=1&top_uid={{ $list[1][0]->user->username }}">注册</a></td>
                                                                        </tr>
                                                                        @endif
                                                                      </tbody>
                                                                    </table>
                                                                  </td>
                                                                </tr>
                                                              </tbody>
                                                            </table>
                                                          </td>
                                                        </tr>
                                                        <tr class="four_level_l">
                                                          @if(isset($list[2][1]))
                                                          <td valign="top" class="right_reg">
                                                            <table cellspacing="0" cellpadding="0">
                                                              <tbody>
                                                                <tr>
                                                                  <td valign="top" align="middle" width="100%" colspan="2">
                                                                    <table cellspacing="1" cellpadding="0" width="82" bgcolor="#517dbf" border="0">
                                                                      <tbody>
                                                                        <tr>
                                                                          <td>
                                                                            <table class="Table1" bordercolor="#cae2f7" cellspacing="1" cellpadding="1" width="200" align="center" bgcolor="#ffffff" border="0">
                                                                              <tbody>
                                                                                @isset($list[3][2])
                                                                                    <tr align="middle">
                                                                                    <td colspan="3" valign="middle">
                                                                                        <span style="font-weight: bold; color: white;">
                                                                                        <a href="#" class="yeah-tab-a" level="3" offset="left">
                                                                                            <font color="#ffffff">{{ $list[3][2]->user->username }}
                                                                                            <br>{{ $list[3][2]->user->name }}</font></a>
                                                                                        </span>
                                                                                    </td>
                                                                                    </tr>
                                                                                    <tr align="middle">
                                                                                    <td valign="center">
                                                                                         <font color="#ffffff">{{ $list[3][2]->A }}$</font></td> 
                                                                                    <td valign="center">
                                                                                         <font color="#ffffff">总</font></td> 
                                                                                    <td valign="center">
                                                                                         <font color="#ffffff">{{ $list[3][2]->B }}$</font></td> 
                                                                                    </tr>
                                                                                    <tr align="middle" bgcolor="">
                                                                                    <td align="center" valign="center">
                                                                                         <font color="#ffffff">{{ $list[3][2]->A_count }}</font></td> 
                                                                                    <td align="center" valign="center">
                                                                                         <font color="#ffffff">人</font></td> 
                                                                                    <td align="center" valign="center">
                                                                                         <font color="#ffffff">{{ $list[3][2]->B_count }}</font></td> 
                                                                                    </tr>
                                                                                    @else
                                                                                    <tr align="middle">
                                                                                        <td colspan="3" align="center" valign="center">
                                                                                        <a href="/userreg?position=1&top_uid={{ $list[2][1]->user->username }}">注册</a></td>
                                                                                    </tr>
                                                                                    @endif
                                                                              </tbody>
                                                                            </table>
                                                                          </td>
                                                                        </tr>
                                                                      </tbody>
                                                                    </table>
                                                                  </td>
                                                                </tr>
                                                              </tbody>
                                                            </table>
                                                          </td>
                                                          <td valign="top" class="right_reg">
                                                            <table cellspacing="0" cellpadding="0">
                                                              <tbody>
                                                                <tr>
                                                                  <td valign="top" align="middle" width="100%" colspan="2">
                                                                    <table cellspacing="1" cellpadding="0" width="82" bgcolor="#517dbf" border="0">
                                                                      <tbody>
                                                                        <tr>
                                                                          <td>
                                                                            <table class="Table1" bordercolor="#cae2f7" cellspacing="1" cellpadding="1" width="200" align="center" bgcolor="#ffffff" border="0">
                                                                              <tbody>
                                                                                @isset($list[3][3])
                                                                                    <tr align="middle">
                                                                                    <td colspan="3" valign="middle">
                                                                                        <span style="font-weight: bold; color: white;">
                                                                                        <a href="#" class="yeah-tab-a" level="3" offset="left">
                                                                                            <font color="#ffffff">{{ $list[3][3]->user->username }}
                                                                                            <br>{{ $list[3][3]->user->name }}</font></a>
                                                                                        </span>
                                                                                    </td>
                                                                                    </tr>
                                                                                    <tr align="middle">
                                                                                    <td valign="center">
                                                                                         <font color="#ffffff">{{ $list[3][3]->A }}$</font></td> 
                                                                                    <td valign="center">
                                                                                         <font color="#ffffff">总</font></td> 
                                                                                    <td valign="center">
                                                                                         <font color="#ffffff">{{ $list[3][3]->B }}$</font></td> 
                                                                                    </tr>
                                                                                    <tr align="middle" bgcolor="">
                                                                                    <td align="center" valign="center">
                                                                                         <font color="#ffffff">{{ $list[3][3]->A_count }}</font></td> 
                                                                                    <td align="center" valign="center">
                                                                                         <font color="#ffffff">人</font></td> 
                                                                                    <td align="center" valign="center">
                                                                                         <font color="#ffffff">{{ $list[3][3]->B_count }}</font></td> 
                                                                                    </tr>
                                                                                    @else
                                                                                    <tr align="middle">
                                                                                        <td colspan="3" align="center" valign="center">
                                                                                        <a href="/userreg?position=1&top_uid={{ $list[2][1]->user->username }}">注册</a></td>
                                                                                    </tr>
                                                                                    @endif
                                                                              </tbody>
                                                                            </table>
                                                                          </td>
                                                                        </tr>
                                                                      </tbody>
                                                                    </table>
                                                                  </td>
                                                                </tr>
                                                              </tbody>
                                                            </table>
                                                          </td>
                                                          @endif
                                                        </tr>
                                                      </tbody>
                                                    </table>
                                                  </td>
                                                  @endif

                                                  @if(isset($list[1][1]))
                                                  <td valign="top">
                                                    <table cellspacing="0" cellpadding="0">
                                                      <tbody class="add_node_l">
                                                        <tr class="sec_level_thr_l_tr_con">
                                                          <td valign="top" align="middle" width="100%" colspan="2">
                                                            <table cellspacing="1" cellpadding="0" bgcolor="#517db1" border="0" class="yeah">
                                                              <tbody>
                                                                <tr>
                                                                  <td>
                                                                
                                                                    <table border="0" width="200" align="center" bordercolor="#cae2f7" bgcolor="#ffffff" class="Table1">
                                                                      <tbody>
                                                                        @isset($list[2][2])
                                                                        <tr align="middle">
                                                                          <td colspan="3" valign="middle">
                                                                            <span style="font-weight: bold; color: white;">
                                                                              <a href="#" class="yeah-tab-a" level="3" offset="left">
                                                                                <font color="#ffffff">{{ $list[2][2]->user->username }}
                                                                                  <br>{{ $list[2][2]->user->name }}</font></a>
                                                                            </span>
                                                                          </td>
                                                                        </tr>
                                                                        <tr align="middle">
                                                                          <td valign="center">
                                                                             <font color="#ffffff">{{ $list[2][2]->A }}$</font></td> 
                                                                          <td valign="center">
                                                                             <font color="#ffffff">总</font></td> 
                                                                          <td valign="center">
                                                                             <font color="#ffffff">{{ $list[2][2]->B }}$</font></td> 
                                                                        </tr>
                                                                        <tr align="middle" bgcolor="">
                                                                          <td align="center" valign="center">
                                                                             <font color="#ffffff">{{ $list[2][2]->A_count }}</font></td> 
                                                                          <td align="center" valign="center">
                                                                             <font color="#ffffff">人</font></td> 
                                                                          <td align="center" valign="center">
                                                                             <font color="#ffffff">{{ $list[2][2]->B_count }}</font></td> 
                                                                        </tr>
                                                                        @else
                                                                        <tr align="middle">
                                                                            <td colspan="3" align="center" valign="center">
                                                                            <a href="/userreg?position=1&top_uid=">注册</a></td>
                                                                        </tr>
                                                                        @endif
                                                                      </tbody>
                                                                    </table>
                                                                  </td>
                                                                </tr>
                                                              </tbody>
                                                            </table>
                                                          </td>
                                                        </tr>
                                                        <tr class="four_level_l">
                                                          @if(isset($list[2][2]))
                                                          <td valign="top" class="right_reg">
                                                            <table cellspacing="0" cellpadding="0">
                                                              <tbody>
                                                                <tr>
                                                                  <td valign="top" align="middle" width="100%" colspan="2">
                                                                    <table cellspacing="1" cellpadding="0" width="82" bgcolor="#517dbf" border="0">
                                                                      <tbody>
                                                                        <tr>
                                                                          <td>
                                                                            <table class="Table1" bordercolor="#cae2f7" cellspacing="1" cellpadding="1" width="200" align="center" bgcolor="#ffffff" border="0">
                                                                              <tbody>
                                                                                @isset($list[3][4])
                                                                                    <tr align="middle">
                                                                                    <td colspan="3" valign="middle">
                                                                                        <span style="font-weight: bold; color: white;">
                                                                                        <a href="#" class="yeah-tab-a" level="3" offset="left">
                                                                                            <font color="#ffffff">{{ $list[3][4]->user->username }}
                                                                                            <br>{{ $list[3][4]->user->name }}</font></a>
                                                                                        </span>
                                                                                    </td>
                                                                                    </tr>
                                                                                    <tr align="middle">
                                                                                    <td valign="center">
                                                                                         <font color="#ffffff">{{ $list[3][4]->A }}$</font></td> 
                                                                                    <td valign="center">
                                                                                         <font color="#ffffff">总</font></td> 
                                                                                    <td valign="center">
                                                                                         <font color="#ffffff">{{ $list[3][4]->B }}$</font></td> 
                                                                                    </tr>
                                                                                    <tr align="middle" bgcolor="">
                                                                                    <td align="center" valign="center">
                                                                                         <font color="#ffffff">{{ $list[3][4]->A_count }}</font></td> 
                                                                                    <td align="center" valign="center">
                                                                                         <font color="#ffffff">人</font></td> 
                                                                                    <td align="center" valign="center">
                                                                                         <font color="#ffffff">{{ $list[3][4]->B_count }}</font></td> 
                                                                                    </tr>
                                                                                    @else
                                                                                    <tr align="middle">
                                                                                        <td colspan="3" align="center" valign="center">
                                                                                        <a href="/userreg?position=1&top_uid={{ $list[2][2]->user->username }}">注册</a></td>
                                                                                    </tr>
                                                                                    @endif
                                                                              </tbody>
                                                                            </table>
                                                                          </td>
                                                                        </tr>
                                                                      </tbody>
                                                                    </table>
                                                                  </td>
                                                                </tr>
                                                              </tbody>
                                                            </table>
                                                          </td>
                                                          <td valign="top" class="right_reg">
                                                            <table cellspacing="0" cellpadding="0">
                                                              <tbody>
                                                                <tr>
                                                                  <td valign="top" align="middle" width="100%" colspan="2">
                                                                    <table cellspacing="1" cellpadding="0" width="82" bgcolor="#517dbf" border="0">
                                                                      <tbody>
                                                                        <tr>
                                                                          <td>
                                                                            <table class="Table1" bordercolor="#cae2f7" cellspacing="1" cellpadding="1" width="200" align="center" bgcolor="#ffffff" border="0">
                                                                              <tbody>
                                                                                @isset($list[3][5])
                                                                                    <tr align="middle">
                                                                                    <td colspan="3" valign="middle">
                                                                                        <span style="font-weight: bold; color: white;">
                                                                                        <a href="#" class="yeah-tab-a" level="3" offset="left">
                                                                                            <font color="#ffffff">{{ $list[3][5]->user->username }}
                                                                                            <br>{{ $list[3][5]->user->name }}</font></a>
                                                                                        </span>
                                                                                    </td>
                                                                                    </tr>
                                                                                    <tr align="middle">
                                                                                    <td valign="center">
                                                                                         <font color="#ffffff">{{ $list[3][5]->A }}$</font></td> 
                                                                                    <td valign="center">
                                                                                         <font color="#ffffff">总</font></td> 
                                                                                    <td valign="center">
                                                                                         <font color="#ffffff">{{ $list[3][5]->B }}$</font></td> 
                                                                                    </tr>
                                                                                    <tr align="middle" bgcolor="">
                                                                                    <td align="center" valign="center">
                                                                                         <font color="#ffffff">{{ $list[3][5]->A_count }}</font></td> 
                                                                                    <td align="center" valign="center">
                                                                                         <font color="#ffffff">人</font></td> 
                                                                                    <td align="center" valign="center">
                                                                                         <font color="#ffffff">{{ $list[3][5]->B_count }}</font></td> 
                                                                                    </tr>
                                                                                    @else
                                                                                    <tr align="middle">
                                                                                        <td colspan="3" align="center" valign="center">
                                                                                        <a href="/userreg?position=1&top_uid={{ $list[2][2]->user->username }}">注册</a></td>
                                                                                    </tr>
                                                                                    @endif
                                                                              </tbody>
                                                                            </table>
                                                                          </td>
                                                                        </tr>
                                                                      </tbody>
                                                                    </table>
                                                                  </td>
                                                                </tr>
                                                              </tbody>
                                                            </table>
                                                          </td>
                                                          @endif
                                                        </tr>
                                                      </tbody>
                                                    </table>
                                                  </td>
                                                  @endif

                                                  @if(isset($list[1][1]))
                                                  <td valign="top">
                                                    <table cellspacing="0" cellpadding="0">
                                                      <tbody class="add_node_l">
                                                        <tr class="sec_level_thr_l_tr_con">
                                                          <td valign="top" align="middle" width="100%" colspan="2">
                                                            <table cellspacing="1" cellpadding="0" bgcolor="#517db1" border="0" class="yeah">
                                                              <tbody>
                                                                <tr>
                                                                  <td>
                                                                    <table border="0" width="200" align="center" bordercolor="#cae2f7" bgcolor="#ffffff" class="Table1">
                                                                      <tbody>
                                                                        @isset($list[2][3])
                                                                        <tr align="middle">
                                                                          <td colspan="3" valign="middle">
                                                                            <span style="font-weight: bold; color: white;">
                                                                              <a href="#" class="yeah-tab-a" level="3" offset="left">
                                                                                <font color="#ffffff">{{ $list[2][3]->user->username }}
                                                                                  <br>{{ $list[2][3]->user->name }}</font></a>
                                                                            </span>
                                                                          </td>
                                                                        </tr>
                                                                        <tr align="middle">
                                                                          <td valign="center">
                                                                             <font color="#ffffff">{{ $list[2][3]->A }}$</font></td> 
                                                                          <td valign="center">
                                                                             <font color="#ffffff">总</font></td> 
                                                                          <td valign="center">
                                                                             <font color="#ffffff">{{ $list[2][3]->B }}$</font></td> 
                                                                        </tr>
                                                                        <tr align="middle" bgcolor="">
                                                                          <td align="center" valign="center">
                                                                             <font color="#ffffff">{{ $list[2][3]->A_count }}</font></td> 
                                                                          <td align="center" valign="center">
                                                                             <font color="#ffffff">人</font></td> 
                                                                          <td align="center" valign="center">
                                                                             <font color="#ffffff">{{ $list[2][3]->B_count }}</font></td> 
                                                                        </tr>
                                                                        @else
                                                                        <tr align="middle">
                                                                            <td colspan="3" align="center" valign="center">
                                                                            <a href="/userreg?position=1&top_uid=">注册</a></td>
                                                                        </tr>
                                                                        @endif
                                                                      </tbody>
                                                                    </table>
                                                                  </td>
                                                                </tr>
                                                              </tbody>
                                                            </table>
                                                          </td>
                                                        </tr>
                                                        <tr class="four_level_l">
                                                          @if(isset($list[2][3]))
                                                          <td valign="top" class="right_reg">
                                                            <table cellspacing="0" cellpadding="0">
                                                              <tbody>
                                                                <tr>
                                                                  <td valign="top" align="middle" width="100%" colspan="2">
                                                                    <table cellspacing="1" cellpadding="0" width="82" bgcolor="#517dbf" border="0">
                                                                      <tbody>
                                                                        <tr>
                                                                          <td>
                                                                            <table class="Table1" bordercolor="#cae2f7" cellspacing="1" cellpadding="1" width="200" align="center" bgcolor="#ffffff" border="0">
                                                                              <tbody>
                                                                                @isset($list[3][6])
                                                                                    <tr align="middle">
                                                                                    <td colspan="3" valign="middle">
                                                                                        <span style="font-weight: bold; color: white;">
                                                                                        <a href="#" class="yeah-tab-a" level="3" offset="left">
                                                                                            <font color="#ffffff">{{ $list[3][6]->user->username }}
                                                                                            <br>{{ $list[3][6]->user->name }}</font></a>
                                                                                        </span>
                                                                                    </td>
                                                                                    </tr>
                                                                                    <tr align="middle">
                                                                                    <td valign="center">
                                                                                         <font color="#ffffff">{{ $list[3][6]->A }}$</font></td> 
                                                                                    <td valign="center">
                                                                                         <font color="#ffffff">总</font></td> 
                                                                                    <td valign="center">
                                                                                         <font color="#ffffff">{{ $list[3][6]->B }}$</font></td> 
                                                                                    </tr>
                                                                                    <tr align="middle" bgcolor="">
                                                                                    <td align="center" valign="center">
                                                                                         <font color="#ffffff">{{ $list[3][6]->A_count }}</font></td> 
                                                                                    <td align="center" valign="center">
                                                                                         <font color="#ffffff">人</font></td> 
                                                                                    <td align="center" valign="center">
                                                                                         <font color="#ffffff">{{ $list[3][6]->B_count }}</font></td> 
                                                                                    </tr>
                                                                                    @else
                                                                                    <tr align="middle">
                                                                                        <td colspan="3" align="center" valign="center">
                                                                                        <a href="/userreg?position=1&top_uid={{ $list[2][3]->user->username }}">注册</a></td>
                                                                                    </tr>
                                                                                    @endif
                                                                              </tbody>
                                                                            </table>
                                                                          </td>
                                                                        </tr>
                                                                      </tbody>
                                                                    </table>
                                                                  </td>
                                                                </tr>
                                                              </tbody>
                                                            </table>
                                                          </td>
                                                          <td valign="top" class="right_reg">
                                                            <table cellspacing="0" cellpadding="0">
                                                              <tbody>
                                                                <tr>
                                                                  <td valign="top" align="middle" width="100%" colspan="2">
                                                                    <table cellspacing="1" cellpadding="0" width="82" bgcolor="#517dbf" border="0">
                                                                      <tbody>
                                                                        <tr>
                                                                          <td>
                                                                            <table class="Table1" bordercolor="#cae2f7" cellspacing="1" cellpadding="1" width="200" align="center" bgcolor="#ffffff" border="0">
                                                                              <tbody>
                                                                                @isset($list[3][7])
                                                                                    <tr align="middle">
                                                                                    <td colspan="3" valign="middle">
                                                                                        <span style="font-weight: bold; color: white;">
                                                                                        <a href="#" class="yeah-tab-a" level="3" offset="left">
                                                                                            <font color="#ffffff">{{ $list[3][7]->user->username }}
                                                                                            <br>{{ $list[3][7]->user->name }}</font></a>
                                                                                        </span>
                                                                                    </td>
                                                                                    </tr>
                                                                                    <tr align="middle">
                                                                                    <td valign="center">
                                                                                         <font color="#ffffff">{{ $list[3][7]->A }}$</font></td> 
                                                                                    <td valign="center">
                                                                                         <font color="#ffffff">总</font></td> 
                                                                                    <td valign="center">
                                                                                         <font color="#ffffff">{{ $list[3][7]->B }}$</font></td> 
                                                                                    </tr>
                                                                                    <tr align="middle" bgcolor="">
                                                                                    <td align="center" valign="center">
                                                                                         <font color="#ffffff">{{ $list[3][7]->A_count }}</font></td> 
                                                                                    <td align="center" valign="center">
                                                                                         <font color="#ffffff">人</font></td> 
                                                                                    <td align="center" valign="center">
                                                                                         <font color="#ffffff">{{ $list[3][7]->B_count }}</font></td> 
                                                                                    </tr>
                                                                                    @else
                                                                                    <tr align="middle">
                                                                                        <td colspan="3" align="center" valign="center">
                                                                                        <a href="/userreg?position=1&top_uid={{ $list[2][3]->user->username }}">注册</a></td>
                                                                                    </tr>
                                                                                    @endif
                                                                              </tbody>
                                                                            </table>
                                                                          </td>
                                                                        </tr>
                                                                      </tbody>
                                                                    </table>
                                                                  </td>
                                                                </tr>
                                                              </tbody>
                                                            </table>
                                                          </td>
                                                          @endif
                                                        </tr>
                                                      </tbody>
                                                    </table>
                                                  </td>
                                                  @endif
                                                </tr>
                                              </tbody>
                                            </table>
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </td>
                                </tr>
                        </tbody>
                        </table>
                        </td>
                        </tr>
                      </table>
                      </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END list INFO--></div>
          </div>
        </div>
      </div>
      <div class="panel-body" style="font-size: 1em"></div>
    </div>
  </div>
</div>