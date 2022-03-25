<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css"/>
    <!--
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/css/multi-select.css"/>
    -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/w3.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.lwMultiSelect.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontcss/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('js/chosen.min.css') }}" rel="stylesheet">
    <!--
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css"/>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet"> 
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/css/multi-select.css"/>
    -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    
    <title>@yield('title')</title>
</head>
<body>
    <main>
    @yield('content')
    </main>
    <!--
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/js/jquery.multi-select.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js"></script>
-->
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/jquery.lwMultiSelect.js') }}"></script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/chosen.jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery.table2excel.js') }}"></script>
<script src="{{ asset('js/html2pdf.bundle.min.js') }}"></script>

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js"></script>
<!---
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
--->
    <script src="{{ asset('js/functions.js') }}"></script>
    <script src="{{ asset('js/fontjs/all.min.js') }}"></script>
    <script>
        $('.navtoggler').click(function(e){
            e.preventDefault();
            $('#sidenavigation').toggleClass('sidenav newsidenav');
            $('#main').toggleClass('maincontent newmaincontent');
        })

        $('#closesidenav').click(function(e){
            e.preventDefault();
            $('#sidenavigation').removeClass('newsidenav')
            $('#sidenavigation').addClass('sidenav')
        })
        $('.librarybtn').click(function(e){
            e.preventDefault();
            $('#libdropdown').toggleClass('d-none');
            $('#libicon').toggleClass('d-none');
            $('#libiconup').toggleClass('d-none');
        })
        $('.academicbtn').click(function(e){
            e.preventDefault();
            $('#academicdropdown').toggleClass('d-none');
            $('#acadicon').toggleClass('d-none');
            $('#acadiconup').toggleClass('d-none');
        })
        $('.financesbtn').click(function(e){
            e.preventDefault();
            $('#findropdown').toggleClass('d-none');
            $('#finicon').toggleClass('d-none');
            $('#finiconup').toggleClass('d-none');
        })
        $('.peoplebtn').click(function(e){
            e.preventDefault();
            $('#peopledropdown').toggleClass('d-none');
            $('#peopleicon').toggleClass('d-none');
            $('#peopleiconup').toggleClass('d-none');
        })
    </script>
@yield('script')
</body>
</html>