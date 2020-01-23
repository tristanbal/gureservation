@extends('layouts.appAdmin')

@section('content')
<div class="container">
        <div class="display-3">Manual Reservation</div>
        <div class="lead">Override the reservation process by selecting an available room manually. Available rooms are subject to change depending on the reservation schedules.</div>
        <hr>

        <div class="row">
                <div class="col-sm-4">
                        {!! Form::open(['action'=> 'AdminController@manualReserveStepTwo','method'=>'POST']) !!}
                        {{Form::label('reserveStartDate','Start Date:', ['class' => 'text-left text-uppercase'])}}
                        {{Form::date('reserveStartDate','',['class'=> 'form-control','placeholder'=>'Ex. Jr, II, III'])}}

                        {{Form::label('reserveEndDate','End Date:', ['class' => 'text-left text-uppercase'])}}
                        {{Form::date('reserveEndDate','',['class'=> 'form-control'])}}

                        {{Form::label('reserveStartTime','Start Time:', ['class' => 'text-left text-uppercase'])}}
                        <input type="time" class="form-control" name="reserveStartTime" value="08:00:00" required>

                        {{Form::label('reserveEndTime','End Time:', ['class' => 'text-left text-uppercase'])}}
                        <input type="time" class="form-control" name="reserveEndTime" value="17:00:00" required>
                                        
                        <br>
                        {{Form::submit('Check Available Studio',['class'=>'btn btn-success btn-block globeDarkBlueBackgroundColor text-uppercase'])}}           
                        <br>
                        {!! Form::close() !!}
                        <div class="lead">Want to select a room automatically? <a href="{{route('home')}}">Click here</a></div>
                </div>
                <div class="col-sm-8">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                                <div class="carousel-item active">
                                <img class="d-block w-100" src="{{asset('images/stock/Stock05.jpg')}}" alt="First slide">
                                </div>
                                <div class="carousel-item">
                                <img class="d-block w-100" src="{{asset('images/stock/stock02.jpg')}}" alt="Second slide">
                                </div>
                                <div class="carousel-item">
                                <img class="d-block w-100" src="{{asset('images/stock/stock01.jpg')}}" alt="Third slide">
                                </div>
                        </div>
                        
                        </div>

                </div>

        </div>
        
</div>
@endsection
