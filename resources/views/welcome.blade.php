@extends('layouts.app')

@section('content')
<div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                <img src="{{ asset('img/logo.png') }}" alt="covid 19 classifier logo" style="width:120px; margin-left:330px; margin-bottom:20px"></img>
                </div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Welcome Page') }}</div>
                    <div class="card-body">
                        <p>Welcome to the covid-19 classifier web app. This app will allow users to perform an analysis on an image file of a chest x-ray to test for covid-19 in the image</p>
                        <p>Please log on to your account, or register a new one, to perform an anlysis.</p>
                        <div class="grid grid-cols-1 md:grid-cols-2">
                            <img src="img/medicalequipment1.jpg" alt="medical equipment"  style="height:200px"></img>
                            <img src="img/doctors2.jpg" alt="doctor with a patient on resperator"  style="height:200px"></img>
                        </div>
                        <p>This app is NOT meant to be a definite tool to diagnose for Covid-19 presence, only to help validate or detect the first presence of the disase.</p>
                        <div class="grid grid-cols-1 md:grid-cols-2">
                            <img src="img/virus1.jpg" alt="graphic of coronavirus" style="height:200px"></img>
                            <img src="img/doctors1.jpg" alt="medical staff giving thumbs up" style="height:200px"></img>
                        </div>
            </div>
        </div>
    </div>
</div>
@endsection
