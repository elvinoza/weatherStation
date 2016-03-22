@extends('layouts.developer_layout')

@section('hello')
@stop

@section('content')
@foreach($errors->all() as $error)
<p class="text-center alert alert-danger">{!!$error!!}</p>
@endforeach
@if(Session::has('successful'))
<p class="text-center alert alert-success">{!! Session::get('successful') !!}</p>
@endif
<section id="contact" class="home-section nopadd-bot color-dark bg-gray text-center">

    <div class="container marginbot-50">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="animatedParent">
                    <div class="section-heading text-center">
                        <h2 class="h-bold animated bounceInDown">Atnaujink stotelės profilį</h2>
                        <div class="divider-header"></div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="row marginbot-80">
                <div class="col-md-8 col-md-offset-2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Stotelės ID</label>
                                <span class="form-control uneditable-input">{{ $user->id }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Stotelės raktas</label>
                                <span class="form-control uneditable-input">{{ $user->app_key }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="row marginbot-80">
                <div class="col-md-8 col-md-offset-2">
                    {!!Form::model($user, ['route'=>'developer.update'])!!}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('station_name','Stotelės vardas',['class'=>'control-label']) !!}
                                {!! Form::text('station_name',Input::old('station_name'),['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('email','El. paštas',['class'=>'control-label']) !!}
                                {!! Form::text('email',Input::old('email'),['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('location','Vieta',['class'=>'control-label']) !!}
                                {!! Form::text('location',Input::old('location'),['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('description','Aprašymas',['class'=>'control-label']) !!}
                                {!! Form::text('description',Input::old('description'),['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('time_min','Atnaujinimo laikas',['class'=>'control-label']) !!}
                                {!! Form::text('time_min',Input::old('time_min'),['class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        {!!Form::submit('Atnaujinti',['class'=>'btn btn-skin btn-lg btn-block'])!!}
                    </div>
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
        <div>
            <div class="row marginbot-80">
                <div class="col-md-8 col-md-offset-2">
                    {!! Form::open(['route'=>'developer.change-pass']) !!}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('current_password','Dabartinis slaptažodis',['class'=>'control-label']) !!}
                                {!! Form::password('current_password',['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('new_pasword','Naujas slaptažodis',['class'=>'control-label']) !!}
                                {!! Form::password('new_password',['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('new_password_confirmation','Pakartoti naują slaptažodį',['class'=>'control-label']) !!}
                                {!! Form::password('new_password_confirmation',['class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        {!!Form::submit('Keisti',['class'=>'btn btn-skin btn-lg btn-block'])!!}
                    </div>
                    {!!Form::close()!!}
                </div>
            </div>
            <div class="row marginbot-80">
                <div class="col-md-8 col-md-offset-2">
                    <div class="text-center">
                        <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#myModal">
                            Trinti stotelę
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop