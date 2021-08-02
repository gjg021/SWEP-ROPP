<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-GB">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Demystifying Email Design</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <style type="text/css">
    a[x-apple-data-detectors] {color: inherit !important;}

    button:hover {
      -webkit-transition: initial;
    transition: initial;
      background-color: green;
    }
  </style>

</head>
<body style="margin: 0; padding: 0;">
  <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
      <td style="padding: 20px 0 30px 0;">

      <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; border: 1px solid #cccccc;">
        <tr>
          <td align="center" bgcolor="#eaffe3" style="padding: 40px 0 30px 0;">
            <img src="https://lh3.googleusercontent.com/d/1K-65Ekkuvz6ZE6tOmO-IiLftx2AffqEw" alt="Creating Email Magic." width="150" height="150" style="display: block;" />
          </td>
        </tr>
        <tr>
          <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
              <tr>
                <td style="color: #153643; font-family: Arial, sans-serif;">
                  <h1 style="font-size: 24px; margin: 0;">Hi {{$name}}!</h1>
                </td>
              </tr>
              <tr>
                <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 20px 0 30px 0;">
                  <p style="margin: 0;">Thank you for your interest in SRA Web Services. To activate your account, click the link below.</p>
                </td>
              </tr>
              <tr>
                <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 20px 0 30px 0;">
                
                  <p style="margin: 0"><a href="{{route('dashboard.verify_email')}}?uev={{$verification_slug}}&uid={{$user_slug}}">Click Here.</a></p>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td bgcolor="#ee4c50" style="padding: 30px 30px;">
              <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
              <tr>
                <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;">
                  <p style="margin: 0;">&reg;SRA WEB PORTAL 2021<br/>
                </td>
                <td align="right">
                  <!-- <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                    <tr>
                      <td>
                        <a href="http://www.twitter.com/">
                          <img src="https://assets.codepen.io/210284/tw.gif" alt="Twitter." width="38" height="38" style="display: block;" border="0" />
                        </a>
                      </td>
                      <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
                      <td>
                        <a href="http://www.twitter.com/">
                          <img src="https://assets.codepen.io/210284/fb.gif" alt="Facebook." width="38" height="38" style="display: block;" border="0" />
                        </a>
                      </td>
                    </tr>
                  </table> -->
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>

      </td>
    </tr>
  </table>
</body>

<script type="text/javascript">
  function openlink(){
    window.open("{{route('dashboard.verify_email')}}?uev={{$verification_slug}}&uid={{$user_slug}}");
  }
</script>
</html>