<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Payment Initiating</title>
    <!-- Close of Header Section-->
    <style type="text/css">
        body, html {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            position: relative;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .loader {
            width: 100px;
            height: 100px;
            position: relative;
            margin: 0 auto;
        }

        .loader .logo {
            width: 45%;
            position: absolute;
            left: 27.5%;
            top: 27.5%;
        }

        .table {
            display: table;
            width: 100%;
            height: 100%;
        }

        .table-cell {
            display: table-cell;
            vertical-align: middle;
        }

        .bounce1, .bounce2, .bounce3 {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background-color: #54AF58;
            opacity: 0.7;
            position: absolute;
            top: 0;
            left: 0;
            -webkit-animation: spreadout 2.7s infinite ease-in-out;
            animation: spreadout 2.7s infinite ease-in-out;
        }

        .bounce2 {
            -webkit-animation-delay: -0.9s;
            animation-delay: -0.9s;
        }

        .bounce3 {
            -webkit-animation-delay: -1.8s;
            animation-delay: -1.8s;
        }

        @-webkit-keyframes spreadout {
            0% {
                -webkit-transform: scale(0.3);
            }
            80% {
                -webkit-transform: scale(1);
            }
            100% {
                opacity: 0;
            }
        }

        @keyframes spreadout {
            0% {
                -webkit-transform: scale(0.3);
                transform: scale(0.3);
            }
            80% {
                -webkit-transform: scale(1);
                transform: scale(1);
            }
            100% {
                opacity: 0;
            }
        }
    </style>
</head>
<body>
<div class="loader">
    <div class="bounce1"></div>
    <div class="bounce2"></div>
    <div class="bounce3"></div>
    <div class="logo"></div>
</div>
<div style="text-align: center;">Please don't press back or refresh button, we are redirecting you to payment page...</div>

<form method="POST" action="{{ env('RAZORPAY_ENDPOINT')}}" id="payform">
  <input type="hidden" name="key_id" value="{{ $RAZORPAY_KEY_ID?? ''}}">
  <input type="hidden" name="order_id" value="{{ $ORDER_ID ?? ''}}">
  <input type="hidden" name="name" value="{{ $NAME ?? ''}}">
  <input type="hidden" name="description" value="{{ $DESCRIPTION ?? ''}}">
  <input type="hidden" name="image" value="{{ $IMAGE ?? ''}}">
  <input type="hidden" name="prefill[name]" value="{{ $USER_NAME ?? ''}}">
  <input type="hidden" name="prefill[contact]" value="{{ $USER_CONTACT ?? ''}}">
  <input type="hidden" name="prefill[email]" value="{{ $USER_EMAIL ?? ''}}">
  <input type="hidden" name="callback_url" value="{{ $CALLBACK_URL ?? ''}}">
  <input type="hidden" name="cancel_url" value="{{ $CANCEL_URL ?? ''}}">
</form>

<script>
    setTimeout(function () {
       document.getElementById('payform').submit();
    }, 2000);
</script>
</body>
</html>