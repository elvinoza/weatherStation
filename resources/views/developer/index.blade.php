@extends('layouts.developer_layout')

@section('nav-bar')
    @parent
@stop

@section('content')
    <div class="container">
        <div class="text-center">
            <h2>
                Create yor own station!
            </h2>
            <p class="lead">
                Create your own station, see station information on all devices, wherever you are!
                <br>
                Get documentation and free source code for your Arduino. It's easy to use!
                <br>
                View charts, tables, and setting you own settings for your station!
            </p>
            <a href="{{ route('developer.sign-up') }}" class="btn btn-default btn-lg">Get started</a>
        </div>
    </div>
@stop