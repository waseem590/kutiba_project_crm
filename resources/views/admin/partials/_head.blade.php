<head>
    <!-- ************************************************************************ !-->
    <!-- ****                                                              **** !-->
    <!-- ****       ¤ Designed and Developed by  LEADconcept               **** !-->
    <!-- ****               http://www.leadconcept.com                     **** !-->
    <!-- ****                                                              **** !-->
    <!-- ************************************************************************ !-->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet" />

    <link
        rel="stylesheet"
        href="{{ asset('admin-panel/plugins/select2/css/select2.min.css') }}"
    />
    <link
        rel="stylesheet"
        href="{{
            asset(
                'admin-panel/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'
            )
        }}"
    />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css"
    />

    <link
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700"
        rel="stylesheet"
    />
    <link
        rel="stylesheet"
        href="{{
            asset(
                'admin-panel/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'
            )
        }}"
    />
    <script src="{{ asset('admin/js/jquery.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Dashboard</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl"
        crossorigin="anonymous"
    />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="/admin/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/b-2.1.1/b-colvis-2.1.1/b-html5-2.1.1/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/zf/r-2.2.9/datatables.min.css"/>
    <!-- <link rel="stylesheet" href="{{asset('admin/css/dropdown.css')}}"> -->
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/jquery.datetimepicker.css')}}" />

    @toastr_css
    <style>



        body {
            font-family: "Open Sans", -apple-system, BlinkMacSystemFont,
                "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell,
                "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .hidden {
            display: none;
        }

        .mediaCenterButton {
            text-align: right;
        }

        .image-size {
            width: 240px;
            height: 120px;
        }

        .images-size {
            width: 70px;
            height: 70px;
        }

        .img_loop {
            float: left;
            width: 20%;
            position: relative;
            padding: 5px;
        }

        .img_loop span {
            background: #e2e1e1;
            padding: 2px;
            border-radius: 50px;
            width: 15px;
            display: block;
            text-align: center;
            height: 15px;
            line-height: 11px;
            position: absolute;
            right: 0;
            top: -3px;
            color: #bf0f0f;
            cursor: pointer;
        }

        .img_loop img {
            height: 70px;
            object-fit: cover;
        }

        .custom-image-upload {
            padding: 3px;
            background-color: aliceblue;
        }

        .notification-heart {
            animation: 1s infinite beatHeart;
        }
        @keyframes beatHeart {
            0% {
                transform: scale(1);
                color: #9a9da0;
            }

            25% {
                transform: scale(1.5);
                color: #fff;
            }

            40% {
                transform: scale(1);
                color: #9a9da0;
            }

            60% {
                transform: scale(1.5);
                color: #fff;
            }

            100% {
                transform: scale(1);
                color: #9a9da0;
            }
        }

        @media(max-width:2560px) and (min-width:1920px){

.w3-cell {
font-size: 22px !important;
}

}
    </style>
    @stack('css')
    @yield('css')
</head>
