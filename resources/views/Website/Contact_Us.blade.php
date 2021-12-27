@extends('layouts.Header_Website')
@section('Contact','active')
@section('content')
@section('page','Contact Us')

<!-- Start Contact -->
<div class="contact mb-4">
    <div class="container">
        <div class="header text-center">
            @if (Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ Session::get('success') }}</strong>
                </div>
            @endif
            @if (Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ Session::get('error') }}</strong>
                </div>
            @endif
            <h3>Drop Us a Line</h3>
            <h6>Enter Your Message, Opinion and reviews</h6>
        </div>
        <form action="{{route('send.email')}}" method="post">
            @csrf
            <div class="row justify-content-center">

                <div class="col-lg-5 col-md-6 mb-3">
                    <input type="text" name="first_name"  placeholder="First Name" required>
                </div>
                <div class="col-lg-5 col-md-6 mb-3">
                    <input type="email" name="email"  placeholder="Your Email" required>
                </div>
                <div class="col-lg-5 col-md-6 mb-3">
                    <input type="number" name="phone" placeholder="Your Phone" required>
                </div>
                <div class="col-lg-5 col-md-6 mb-3">
                    <input type="text" name="subject"  placeholder="Subject" required>
                </div>
                <div class="col-lg-10 mb-5">
                    <textarea name="message"  placeholder="Message.." required></textarea>
                </div>

                <div class="col-12 d-flex justify-content-center">
                    <button type="submit">Send Message</button>
                </div>

            </div>
        </form>
    </div>
</div>
<!-- End Contact -->

@endsection
