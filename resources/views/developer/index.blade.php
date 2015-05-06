@extends('layouts.developer_layout')
@if(!Auth::check())
    @section('hello')
        @parent
    @show
@else
    @section('hello')
    @stop
@endif

@section('content')
    <div class="col-md-8 col-md-offset-2 form-content">
        <h3 class="heading">Sign up</h3>
        @foreach($errors->all() as $error)
        <p class="alert alert-danger">{!!$error!!}</p>
        @endforeach
    </div>
    <!-- Section: about -->
    <section id="about" class="home-section color-dark bg-white">
        <div class="container marginbot-50">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="animatedParent">
                        <div class="section-heading text-center animated bounceInDown">
                            <h2 class="h-bold">About MeteO</h2>
                            <div class="divider-header"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 animatedParent">
                    <div class="text-center">
                        <p>
                            We help people get their and others stations information online. Their can check it in all devices using web browser or with Android application.
                        </p>
                        <p>
                            With our members sending real-time data from their own personal weather stations, they provide us with the extensive data.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section: services -->
    <section id="service" class="home-section color-dark bg-gray">
        <div class="container marginbot-50">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div>
                        <div class="section-heading text-center">
                            <h2 class="h-bold">What we can do for you</h2>
                            <div class="divider-header"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <div>
                <div class="row animatedParent">
                    <div class="col-xs-6 col-sm-4 col-md-4">
                        <div class="animated rotateInDownLeft">
                            <div class="service-box">
                                <div class="service-icon">
                                    <span class="fa fa-laptop fa-2x"></span>
                                </div>
                                <div class="service-desc">
                                    <h5>Web Page</h5>
                                    <div class="divider-header"></div>
                                    <p>
                                        View online weather, explore charts and tables with stations data.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-4">
                        <div class="animated rotateInDownLeft slow">
                            <div class="service-box">
                                <div class="service-icon">
                                    <span class="fa fa-mobile fa-2x"></span>
                                </div>
                                <div class="service-desc">
                                    <h5>Mobile</h5>
                                    <div class="divider-header"></div>
                                    <p>
                                        View selected station data and create your own settings. For example: if wind speed is more then 3km/h yor can get notification into your Android mobile phone!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-4">
                        <div class="animated rotateInDownLeft slower">
                            <div class="service-box">
                                <div class="service-icon">
                                    <span class="fa fa-code fa-2x"></span>
                                </div>
                                <div class="service-desc">
                                    <h5>Arduino Code</h5>
                                    <div class="divider-header"></div>
                                    <p>
                                        If you use Arduino we give for you free source code. What you only could do: insert your station app_id and app_key into we code.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if(!Auth::check())
        <!-- Section: register -->
        <section id="contact" class="home-section nopadd-bot color-dark bg-gray text-center">
            <div class="container marginbot-50">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="animatedParent">
                            <div class="section-heading text-center">
                                <h2 class="h-bold animated bounceInDown">Sign up</h2>
                                <div class="divider-header"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="container">
                <div class="row marginbot-80">
                    <div class="col-md-8 col-md-offset-2">
                        {!!Form::open(['route'=>'developer.register','id'=>'contact-form'])!!}
                        <div class="row marginbot-20">
                            <div class="col-md-6 xs-marginbot-20">
                                {!! Form::text('station_name',Input::old('station_name'),['class'=>'form-control input-lg', 'id'=>'name', 'placeholder'=>'Enter name', 'required' => 'required']) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::text('email',Input::old('email'),['class'=>'form-control input-lg', 'id'=>'email', 'placeholder'=>'Enter email', 'required' => 'required']) !!}
                            </div>
                        </div>

                        <div class="row marginbot-20">
                            <div class="col-md-6 xs-marginbot-20">
                                {!! Form::password('password',['class'=>'form-control input-lg', 'placeholder' => 'Password', 'required' => 'required']) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::password('password_confirmation',['class'=>'form-control input-lg', 'placeholder' => 'Confirm password', 'required' => 'required']) !!}
                            </div>
                        </div>


                        <div class="text-center">
                            {!!Form::submit('Register',['class'=>'btn btn-skin btn-lg btn-block', 'id' => 'btnContactUs'])!!}
                        </div>
                        {!!Form::close()!!}
                    </div>
                </div>
            </div>
        </section>
    @endif
@stop