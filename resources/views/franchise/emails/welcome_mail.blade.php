@extends('layouts.mailer_layout')
@section('content')

<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
      <tbody><tr bgcolor='#000000' background="http://www.quizsolver.com/mailers/radix_mailerBG.gif">
    <td></td>
    <td style="padding:50px 0" align="center">
      <table width="190" cellspacing="0" cellpadding="0" border="0">
        <tbody>
          <tr>
            <td valign="top" width="80"><img src="http://www.quizsolver.com/mailers/profile-ic.png" vspace="0" hspace="0" align="absmiddle" border="0" width="80" height="50"></td>
            <td valign="middle" style="font-size:18px;color:#FFF;font-family:Open Sans,Gill Sans,Arial,Helvetica,sans-serif;text-align:left; padding-left:10px;"> Welcome! <strong>{{$user->name}}</strong></td>
          </tr>
        </tbody>
      </table>
    </td>
    <td></td>
  </tr>
      <tr bgcolor="#ffffff">
        <td valign="top" width="20"><img src="http://www.quizsolver.com/mailers/spacer.png" width="8" height="1"></td>
        <td width="372">
          <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Open Sans,Gill Sans,Arial,Helvetica,sans-serif;color:#666666;text-align:left;font-size:16px">
            <tbody><tr>
              <td height="23"></td>
            </tr>
            <tr>
              <td>Dear,</td>
            </tr>
            <tr>
              <td height="23"></td>
            </tr>
            <tr>
              <td>You have been successfully registered on our Franchise Platform. Our exective will get back to you shortly. </td>
            </tr>
            <tr>
              <td height="23"></td>
            </tr>
            <tr>
              <td>
                <!--[if (gte mso 9)|(IE)]>                        <table width="450" align="center" bgcolor="#ffffff">                        <tr>                        <td align="center">                        <![endif]-->
                <table border="0" cellspacing="0" cellpadding="0" bgcolor="#fafafa" style="border:1px solid #ccc;max-width:315px">
                  <tbody><tr>
                    <td style="padding:10px">
                      <table border="0" cellspacing="0" cellpadding="0" style="font-size:16px;font-family:Open Sans,Gill Sans,Arial,Helvetica,sans-serif;color:#666666" width="100%">
                          <tbody><tr>
                            <td style="font-weight:bold;font-size:16px" colspan="3">Login Details</td>
                          </tr>
                          <tr>
                            <td height="8" style="border-bottom:1px solid #d9d9d9" colspan="3"></td>
                          </tr>
                          <tr>
                            <td height="20" colspan="3"></td>
                          </tr>
                          <tr>
                            <td style="color:#757575;font-weight:bold" width="95" valign="top">Username</td>
                            <td width="10" valign="top">:</td>
                            <td style="word-break:break-all" valign="top"><a href="mailto:ram@quizsolver.in" target="_blank">{{$user->email}},</a></td>
                          </tr>
                          <tr>
                            <td height="10" colspan="3"></td>
                          </tr>
                          <tr>
                            <td style="color:#757575;font-weight:bold">Password</td>
                            <td>:</td>
                            <td>{{$user->pwd}}</td>
                          </tr>
                      </tbody></table>
                    </td>
                  </tr>
                </tbody></table>
                <!--[if (gte mso 9)|(IE)]>                        </td>                        </tr>                        </table>                       <![endif]-->
              </td>
            </tr>
            <tr>
              <td height="20"></td>
            </tr>
            <tr>
              <td style="font-size:16px"> Thanks<br>
                <strong>Radix Team</strong></td>
            </tr>
            <tr>
              <td height="40"></td>
            </tr>
          </tbody>
      </table>
        </td>
         <td valign="top" width="20"><img src="http://www.quizsolver.com/mailers/spacer.png" width="8" height="1"></td>
      </tr>
    </tbody>
</table>

@endsection