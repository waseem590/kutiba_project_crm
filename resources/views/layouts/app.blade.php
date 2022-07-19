<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ************************************************************************ !-->
    <!-- ****                                                              **** !-->
    <!-- ****       ¤ Designed and Developed by  LEADconcept               **** !-->
    <!-- ****               http://www.leadconcept.com                     **** !-->
    <!-- ****                                                              **** !-->
    <!-- ************************************************************************ !-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="facebook-domain-verification" content="ndvma4470lyv9oouncpt5yshmehxqo" />
    <link rel="stylesheet" href="{{ asset('css/login/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Masiratna CRM - @yield('title')</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('favicon.ico')}}"/>
</head>

<body>
    <div class="login-wrapper">
       <div class="mm_login">
       <div class="login-inner">
            <div class="login-logo">
                <img src="{{asset('images/logo-new.png')}}" alt="logo">
            </div>

            @yield('content')
        </div>
        <div class="last-footer">
            <p>© Copyright {{ now()->year }} MASIRATNA. All rights reserved.</p>
            <p>Designed & Developed by LEADconcpet</p>

        </div>
       </div>
    </div>

</body>

</html>
