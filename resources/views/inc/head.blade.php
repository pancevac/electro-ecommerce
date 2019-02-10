<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--<title>{{ setting('site.title') }} - @yield('title')</title>--}}
    {!! SEO::generate() !!}

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"/>

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/slick.css') }}"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/slick-theme.css') }}"/>

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/nouislider.min.css') }}"/>

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}"/>
    @yield('css')

    <style>
        @import 'https://fonts.googleapis.com/css?family=Montserrat:400,700';
        .aa-input-container {
            display: inline-block;
            position: relative;
            margin-top: 10px;
        }
        .aa-input-search {
            width: 400px;
            padding: 12px 28px 12px 12px;
            border: 2px solid #e4e4e4;
            /*border-radius: 4px;*/
            -webkit-transition: .2s;
            transition: .2s;
            font-family: "Montserrat", sans-serif;
            /*box-shadow: 4px 4px 0 rgba(241, 241, 241, 0.35);*/
            font-size: 13px;
            box-sizing: border-box;
            color: #333;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none; }
        .aa-input-search::-webkit-search-decoration, .aa-input-search::-webkit-search-cancel-button, .aa-input-search::-webkit-search-results-button, .aa-input-search::-webkit-search-results-decoration {
            display: none; }
        .aa-input-search:focus {
            outline: 0;
            border-color: #3a96cf;
            /*box-shadow: 4px 4px 0 rgba(58, 150, 207, 0.1); */
        }
        .aa-input-icon {
            height: 16px;
            width: 16px;
            position: absolute;
            top: 50%;
            right: 16px;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
            fill: #e4e4e4; }
        .aa-hint {
            color: #e4e4e4; }
        .aa-dropdown-menu {
            background-color: #fff;
            border: 2px solid rgba(228, 228, 228, 0.6);
            border-top-width: 1px;
            font-family: "Montserrat", sans-serif;
            width: 400px;
            margin-top: 10px;
            /*box-shadow: 4px 4px 0 rgba(241, 241, 241, 0.35);*/
            font-size: 13px;
            /*border-radius: 4px;*/
            box-sizing: border-box; }
        .aa-suggestion {
            padding: 12px;
            border-top: 1px solid rgba(228, 228, 228, 0.6);
            cursor: pointer;
            -webkit-transition: .2s;
            transition: .2s;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center; }
        .aa-suggestion:hover, .aa-suggestion.aa-cursor {
            background-color: rgba(241, 241, 241, 0.65); }
        .aa-suggestion > span:first-child {
            color: #333; }
        .aa-suggestion > span:last-child {
            text-transform: uppercase;
            color: #a9a9a9; }
        .aa-suggestion > span:first-child em, .aa-suggestion > span:last-child em {
            font-weight: 700;
            font-style: normal;
            background-color: rgba(58, 150, 207, 0.3);
            padding: 2px 0 2px 2px;
        }
        .search-thumb {
            max-width: 75px;
            max-height: 75px;
        }
        .search-desc {
            text-overflow: clip;
            white-space: nowrap;
            overflow: hidden;
            width: 200px;
        }
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>