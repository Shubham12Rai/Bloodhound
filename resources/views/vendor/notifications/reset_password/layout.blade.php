<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<style>
    .wrapper {
        margin: 50px 0 50px 0;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
    }

    .inner-body {
        text-align: center;
    }

    .message-title {
        font-size: 22px;
        font-weight: 700;
        padding: 0 0 20px 0;
    }
    .message-first_name {
        padding: 0 0 20px 0;
    }

    .message-link-reset-password {
        padding: 20px 0 20px 0;
    }

    .message-text-thanks {
        padding: 15px 0 20px 0;
    }



    @media only screen and (max-width: 600px) {
        .inner-body {
            width: 100% !important;
        }

        .footer {
            width: 100% !important;
        }
    }

    @media only screen and (max-width: 500px) {
        .button {
            width: 100% !important;
        }
    }
</style>

<table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td align="center">
            <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
            @include('vendor.notifications.reset_password.header')

            <!-- Email Body -->
                <tr>
                    <td class="body" width="100%" cellpadding="0" cellspacing="0">
                        <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                            <!-- Body content -->
                            @include('vendor.notifications.reset_password.message')
                        </table>
                    </td>
                </tr>

                @include('vendor.notifications.reset_password.footer')
            </table>
        </td>
    </tr>
</table>
</body>
</html>