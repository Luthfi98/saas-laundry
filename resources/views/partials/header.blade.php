
<!-- PAGE TITLE HERE -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="keywords" content="">
<meta name="author" content="">
<meta name="robots" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="{{ $setting->description }}">
<meta property="og:title" content="{{ $setting->description }}">
<meta property="og:description" content="{{ $setting->description }}">
<meta property="og:image" content="https://yeshadmin.dexignzone.com/xhtml/social-image.png">
<meta name="format-detection" content="telephone=no">
<title>{{$setting->name}} - @yield('title')</title>
	<!-- FAVICONS ICON -->
<link rel="shortcut icon" type="image/png" href="{{ asset($setting->icon) }}">
