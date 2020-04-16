<!DOCTYPE html>
<html>
<head>
    <title>Laravel Web App</title>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</head>
<body>
  
<div class="container">
        <!-- @if (Route::has('prices'))
            <button id="logbtn" class="btn btn-primary" href="{{ url('/prices') }}"> login </button>
        @endif -->
        <h2>Login</h2>
        <a href="{{ url('/prices.index') }}"> <button id="logbtn" class="btn btn-primary"> login </button> </a>
</div>
   
</body>
</html>