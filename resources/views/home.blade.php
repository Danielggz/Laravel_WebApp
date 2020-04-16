@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (Auth::check())
                <div class="card">
                    <div class="card-header">Actions</div>
                    <div class="card-body">
                        Go to stock prices manager
                        <a href="{{ url('/prices.index') }}"> <button style="margin-left:10px;" class="btn btn-info"> <i class="fa fa-arrow-right"></i> </button> </a>
                    </div>
                </div>
            @else
                <h2>Welcome to the Laravel Web App</h2>

                <div style="margin-top:2em; font-size:16px;">Please <a href="{{ route('login') }}">Login</a> or <a href="{{ route('register') }}">Register</a></div>
            @endif
            
        </div>
    </div>
</div>
@endsection
