
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @guest
            <div class="col-md-6">
                <div class="card text-center">
                    @if (Route::has('login'))
                                <a class="btn btn-block btn-success" href="{{ route('login') }}">Please Login</a>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="card text-center">

                    @if (Route::has('register'))
                            <a class="btn btn-block btn-success" href="{{ route('register') }}">Or Register</a>
                    @endif


                </div>
            </div>
        @else
            <div class="col-md-12">
                <div class="card text-center">
                    <a class="btn btn-block btn-success" href="{{ route('students.index') }}">Dashboard Students</a>
                </div>
            </div>
        @endguest
    </div>
</div>
@endsection
