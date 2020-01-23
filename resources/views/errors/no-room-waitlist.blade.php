@extends('layouts.app')

@section('content')
<div class="container ">
    
    
    <div class="text-center"><br>
        <img src="{{asset('images/logo/Error.png')}}" style="width:10%;">
    </div>
        <br>
        <h1>There are no available rooms at the moment. Here are our following recommendations:</h1><br>
        <ul class="list-group">
            <li class="list-group-item">Your preferred date may already be reserved. Try choosing other dates.</li>
            <li class="list-group-item">The room you booked may have pax and class set up limitatons. Try adjusting your pax or choose a more suitable class set up.</li>
            <li class="list-group-item">
                @if(count($searches)>=1)
                @foreach ($recommendedroom as $searches)
                {!! Form::open(['action'=> 'WaitlistController@start','method'=>'POST']) !!}
                {{ csrf_field() }}
                <input type="text" value="{{$firstname}}" name="firstname" hidden>
                <input type="text" value="{{$lastname}}" name="lastname" hidden>
                <input type="text" value="{{$middlename}}" name="middlename" hidden>
                <input type="text" value="{{$employeeID}}" name="employeeID" hidden>
                <input type="text" value="{{$groupname}}" name="groupname" hidden>
                <input type="text" value="{{$email}}" name="email" hidden>
                <input type="text" value="{{$phone}}" name="phone" hidden>

                <input type="time" value="{{$reserveStartTime}}" name="reserveStartTime" hidden>
                <input type="time" value="{{$reserveEndTime}}" name="reserveEndTime" hidden>

                <input type="date" value="{{$startDateNext}}" name="reserveStartDate" hidden >
                <input type="date" value="{{$endDateNext}}" name="reserveEndDate" hidden>
                <input type="text" value="{{$setupNext}}" name="setup" hidden>
                <input type="number" value="{{$capacity}}" name="pax" hidden>

                <input type="number" value="{{$searches->RoomSetupID}}" name="roomPerSetUp" hidden>                
                <!--<input type="text" value="{{$reserveEndTime}}" name="random" hidden>--> 
                
                If you still want to push through with your preferred schedule, you may choose from these suggested studios below:
                <br><br>
                {{Form::submit('Enlist in Wait List System',['class'=>'btn btn-primary text-uppercase'])}}           
                                
                {!! Form::close() !!}
                @endforeach
                @endif
            </li>
        </ul>
    
</div>   
@endsection
