@extends('layouts.app')

@section('content')

<div class="container" >
               
        <div class="card-deck ">
            <div class="card text-center mycarddesign">
                <div class="card-body">
                    <h1 class="card-title">Make Reservation</h1>
                    {!! Form::open(['action'=> 'MatchController@match','method'=>'POST']) !!}
                            {{Form::label('reservationStartDate','Reservation Start Date:', ['class' => 'globeDarkBlueColor text-left'])}}
                            {{Form::date('reservationStartDate','',['class'=> 'form-control','placeholder'=>'Ex. Jr, II, III'])}}
                <!--                    <label for="usr">Reservation Date:</label> --><!-- Reservation Date -->
                <!--                    <input type="date" id="start" class="form-control"name="trip" value="2018-07-22" min="2018-01-01" max="2018-12-31" />-->
                    
                            {{Form::label('reservationEndDate','Reservation End Date:')}}
                            {{Form::date('reservationEndDate','',['class'=> 'form-control'])}}
                    <!--                    <label for="usr">Reservation Date:</label> --><!-- Reservation Date -->
                    <!--                    <input type="date" id="start" class="form-control"name="trip" value="2018-07-22" min="2018-01-01" max="2018-12-31" />-->
                        
                                {{Form::label('pax','PAX:')}}
                                {{Form::number('pax','',['class'=> 'form-control','placeholder'=>'0'])}}
                   
                    <br>
                    {{Form::submit('Check Available Studio',['class'=>'btn btn-primary btn-block globeDarkBlueBackgroundColor'])}}
                    {!! Form::close() !!}
                    <div class = "p-1">
                        <span class= " text-center" >OR</span>
                    </div>
                    <div class = "pt-2">
                            <div class="float-left w-50 pr-1" >
                                    <button type="button" class="btn globePurpleBackgroundColor btn-block"><a href="#" class="manual-optin-trigger btnfont" data-optin-slug="atefh5rvxazforll">Edit</a></button>
                            </div>
                            <div class="float-right w-50 pl-1">
                                    <button class="btn btn-danger btn-block "><a href="#" class="manual-optin-trigger btnfont" data-optin-slug="atefh5rvxazforll">Cancel</a></button>
                            </div>
                        </div>
                </div>
                
            </div>
    
            <div class="card text-center mycarddesign">
                    <video class="card-img-top" alt="Card image cap" controls>
                    <source src="{{asset('video/GlobeUniversityVirtualTourVideo.mp4')}}" type="video/mp4">
                    </video>
                    <div class="card-body">
                        <h5 class="card-title">Welcome to Globe University</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        
                    </div>
                
            </div>
            
        </div>
</div>
@endsection
