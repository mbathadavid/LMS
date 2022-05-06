<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontcss/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h6 class="text-center text-success">Select your School to Proceed</h6>

        <table class="table" id="table">
            <thead>
            <tr>
                <th scope="col">School No.</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
            </tr>
        </thead>
        <tbody id="bookstable">
            @if(count($schools) == 0)
            <tr>
                <td><h6 class="text-danger">There are currently no Schools Registered</h6></td>
            </tr>
            @else
            @foreach($schools as $school)
            <tr>
                <td>{{ $school->logo }}</td>
                <td>{{ $school->name }}</td>
                <td>{{ $school->motto }}</td>
            </tr>
            @endforeach
            @endif
        </tbody>
        </table>

    </div>
  
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/functions.js') }}"></script>
<script src="{{ asset('js/fontjs/all.min.js') }}"></script>
<script>
    $(document).ready(function(){
        
    })
</script>
</body>
</html>