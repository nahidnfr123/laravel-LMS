@extends('layouts.home')

@section('head')
@stop

@section('content')
    <div class="container py-4">
        <div class="row py-4">
            <div class="col-12 col-lg-6">
                <div class="phone wow fadeInUp" style="text-align: center;">
                    <h1>Call us...</h1>
                    <h1 style="font-size: 24px;">+880 1000000000</h1><br><br>
                    <div class="pulse" style="text-align: center;"><i class="fas fa-phone" id="pulsephone"></i></div>

                    <br>
                    <h1>Email us...</h1>
                    <a href="mailto:ta224604@gmail.com">mayesha@mayesha.com</a><br><br>
                    <div class="pulse" style="text-align: center;"><i class="fas fa-envelope" id="pulse_envelop"></i></div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="Contact_Form_DIV bg-gray wow fadeInDown">
                    <h1 style="text-align:center;">Get in touch...</h1><br>
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="col-12 col-md-8 col-lg-12 content container">
                        <form action="{{ route('content-us.store') }}" method="post" class="form contact-needs-validation" novalidate>
                            @csrf
                            <input type="hidden" hidden name="user_id" value="@if (Auth::check()){{ Auth::user()->id }}@endif">

                            <div class="form-group mb-2">
                                <label for="name">Name: <br></label>
                                <input type="text" class="form-control" placeholder="Name" name="name" id="name" minlength="3" maxlength="30" required @if(Auth::check()) readonly @endif value="@if(Auth::check()){{ Auth::user()->name }}@else{{ old('name') }}@endif">
                                <div class="invalid-tooltip">Name is required. Minlength 3.</div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="email">Email: <br></label>
                                <input type="email" class="form-control" placeholder="Email" name="email" id="email" minlength="10" maxlength="60" required @if(Auth::check()) readonly @endif value="@if(Auth::check() ){{ Auth::user()->email }}@else{{ old('email') }}@endif">
                                <div class="invalid-tooltip">Email is required.</div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="contact">Contact no: <br></label>
                                <input type="text" class="form-control" placeholder="01XXXXXXXXX" name="contact" id="contact" maxlength="11" minlength="11" required @if(Auth::check()) readonly @endif value="@if(Auth::check() ){{ Auth::user()->phone }}@else{{ old('contact') }}@endif">
                                <div class="invalid-tooltip">Phone number is required. Minlength 11.</div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Message: <br></label>
                                <textarea name="message" id="" cols="30" rows="4" placeholder="Message" class="form-control" required minlength="10">{{ old('message') }}</textarea>
                                <div class="invalid-tooltip">Message is required</div>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="SendMessage" class="btn btn-primary" id="Contact_btn">
                                    @if (Auth::check())
                                        {{ 'Send message as "' . Auth::user()->name .'"'}}
                                    @else
                                        {{ 'Send message as ' }}<i class="fa fa-user" style="margin-left: 6px;"></i> Guest user
                                    @endif
                                </button>
                            </div>
                        </form>
                        <br>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="location wow fadeInUp">
                    <center><br>
                        <h1>Our location...</h1>
                        <div class="map">
                            <iframe width="100%" height="300px" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d724.6213122523719!2d90.38161087023289!3d23.752270451682126!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8afb693ff75%3A0x32051f5a37ac6420!2sDaffodil+International+Academy!5e0!3m2!1sen!2sbd!4v1527285423870" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                    </center>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@stop
