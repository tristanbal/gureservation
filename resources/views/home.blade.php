@extends('layouts.app')

@section('content')
<div class="container">
    

    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <h3>Reservations </h3>

    <hr>
    <h1 class = "py-2 pt-3">Other rooms you might prefer:</h1>
    @if(count($employee)==3)
        <div class="card-deck ">
        @foreach ($employee as $searches)
            <div class="card text-center mycarddesign">
                <img class="card-img-top" src="/storage/images/{{$searches->RoomPicture}}" alt="Card image cap" style="height:38%;">
                <div class="card-body">
                        <h5>{{$searches->Room}}</h5>
                        <p class="card-text">
                        <b>Set-up: </b>{{$searches->Setup}}<br>
                        <b>Capacity: </b>{{$searches->Pax}}<br>
                        <span style="color:green">Available</span></p>
                </div>
                <div class="card-footer">
                {!! Form::open(['action'=> 'MatchController@step1_reserve','method'=>'POST']) !!}
                {{ csrf_field() }}
                {{Form::submit('Book Now',['class'=>'btn btn-success btn-block  text-uppercase'])}}           
                
                {!! Form::close() !!}
                </div>
            </div>
        @endforeach
        </div>

        
    @elseif (count($employee)==2)
    <div class="card-deck ">
            @foreach ($employee as $searches)
                <div class="card text-center mycarddesign">
                    <img class="card-img-top" src="/storage/images/{{$searches->RoomPicture}}" alt="Card image cap" style="width:100%;">
                    <div class="card-body">
                            <h5>{{$searches->Room}}</h5>
                            <p class="card-text">
                            <b>Set-up: </b>{{$searches->Setup}}<br>
                            <b>Capacity: </b>{{$searches->Pax}}<br>
                            <span style="color:green">Available</span></p>
                    </div>
                    <div class="card-footer">
                    {!! Form::open(['action'=> 'MatchController@step1_reserve','method'=>'POST']) !!}
                    {{ csrf_field() }}
                    
                    {{Form::submit('Book Now',['class'=>'btn btn-success btn-block  text-uppercase'])}}           
                    
                    {!! Form::close() !!}
                    </div>
                </div>
            @endforeach
            </div>
        
    @elseif (count($searchesclassroom)==1)
    <div class="card-deck ">
            @foreach ($searchesclassroom as $searches)
                <div class="card text-center mycarddesign">
                    <img class="card-img-top" src="/storage/images/{{$searches->Picture}}" alt="Card image cap" style="wdith:80%;">
                    <div class="card-body">
                            <h3>{{$searches->RoomName}}</h3>
                            <p class="card-text">
                            <b>Set-up: </b>{{$searches->Setup}}<br>
                            <b>Capacity: </b>{{$searches->Capacity}}<br>
                            <span style="color:green">Available</span></p>
                    </div>
                    <div class="card-footer">
                    {!! Form::open(['action'=> 'MatchController@step1_reserve','method'=>'POST']) !!}
                    {{ csrf_field() }}
                    
                    {{Form::submit('Book Now',['class'=>'btn btn-success btn-block  text-uppercase'])}}           
                    
                    
                    </div>
                </div>
                {!! Form::close() !!}
            @endforeach
            </div>
    @else
        <div class="alert alert-danger">
            No rooms found.
        </div>
    @endif
    

    <h3> Room Utilizations </h3>
</div>
@endsection
