@extends('layouts.developer_layout')

@section('hello')
@stop

@section('content')
@foreach($errors->all() as $error)
<p class="alert alert-danger">{!!$error!!}</p>
@endforeach
@if(Session::has('successful'))
<p class="alert alert-success">{!! Session::get('successful') !!}</p>
@endif
<section id="contact" class="home-section nopadd-bot color-dark bg-gray text-center">

    <div class="container marginbot-50">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="animatedParent">
                    <div class="section-heading text-center">
                        <h2 class="h-bold animated bounceInDown">Update your profile</h2>
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
                                <label>Your app id</label>
                                <span class="form-control uneditable-input">{{ $user->id }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Your app key</label>
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
                                {!! Form::label('station_name','Station name',['class'=>'control-label']) !!}
                                {!! Form::text('station_name',Input::old('station_name'),['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('email','Email',['class'=>'control-label']) !!}
                                {!! Form::text('email',Input::old('email'),['class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        {!!Form::submit('Update',['class'=>'btn btn-skin btn-lg btn-block'])!!}
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
                                {!! Form::label('current_password','Current password',['class'=>'control-label']) !!}
                                {!! Form::password('current_password',['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('new_pasword','New password',['class'=>'control-label']) !!}
                                {!! Form::password('new_password',['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('new_password_confirmation','Confirm Password:',['class'=>'control-label']) !!}
                                {!! Form::password('new_password_confirmation',['class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        {!!Form::submit('Change',['class'=>'btn btn-skin btn-lg btn-block'])!!}
                    </div>
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </section>
@stop