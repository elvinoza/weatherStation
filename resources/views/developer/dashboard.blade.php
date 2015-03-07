@extends('layouts.developer_layout')

@section('content')

@if( Auth::check())
{{ Auth::user()->station_name }}
@endif

@stop