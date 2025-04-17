@php
    $general = new GeneralHelper;
    $setting = $general->getSetting();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('partials.header')

    @include('partials.css')



</head>
<body data-theme-version="{{ Auth::user()->theme_version }}">

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
		<div class="text-center">
			<img src="{{ asset($setting->logo) }} " alt="">
            <br>
            <h4>{{ $setting->name }}</h4>
		</div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        @include('partials.navbar')

        @include('partials.sidebar')

		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
			<div class="container-fluid">
                @yield('content')
            </div>
        </div>

        <!--**********************************
            Content body end
        ***********************************-->
        @include('partials.footer')

		<!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


	</div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    @include('partials.js')

    @if(session('success'))
        <script>
            toastSuccess("{{ session('success') }}");
        </script>
    @elseif (session('warning'))
        <script>
            toastWarning("{{ session('warning') }}");
        </script>
    @endif
</body>
</html>
