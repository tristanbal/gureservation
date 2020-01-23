@extends('layouts.app')

@section('content')
<div class="container">
    

    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <div class="display-4">Welcome Back</div>
    <br>

    <h3>Today's Reservations</h3>
    <hr>
    
    <div class="row">
        <div class="col-sm-7">
            <?php $i=0 ?>
            @if(count($todaySchedule)>0)
            @foreach($todaySchedule as $todaySchedules)
            <?php if ($i >= 3 ) {break;} else {?>
                <div class="card">
                    <h5 class="card-header text-uppercase">{{$todaySchedules->RoomName}} - {{$todaySchedules->Title}}</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <img class="card-img-top" src="/storage/images/{{$todaySchedules->RoomPicture}}" alt="Card image cap" style="width:100%;">
                            </div>
                            <div class="col-sm-8">
                                <h5 class="card-title text-uppercase">{{$todaySchedules->Name}}</h5>
                                <p class="card-text"><b>Start Time/End Time:</b> {{$todaySchedules->StartTime}}/{{$todaySchedules->EndTime}}</p>
                                <a href="#" class="btn btn-primary">View Reservation</a>
                            </div>
                        </div>
                    </div>
                </div>    
                <?php $i++; } ?>
                <br>
            @endforeach
        
            @else
                <div class="alert alert-danger">
                    No rooms found.
                </div>
            @endif
        </div>
        <div class="col-sm-5">
            <div class="card-deck ">
                    <div class="card text-center mycarddesign">
                        <div class="card-body">
                            <h1 class="card-title">Make Reservation</h1>
                            {!! Form::open(['action'=> 'adminController@adminMatch','method'=>'POST']) !!}
                            <div class = "row">
                                    <div class = "col-6">
                                            {{Form::label('reserveStartDate','Start Date:', ['class' => 'text-left text-uppercase'])}}
                                            {{Form::date('reserveStartDate','',['class'=> 'form-control','placeholder'=>'Ex. Jr, II, III'])}}
                                    </div>
                                    <div class = "col-6">
                                            {{Form::label('reserveEndDate','End Date:', ['class' => 'text-left text-uppercase'])}}
                                            {{Form::date('reserveEndDate','',['class'=> 'form-control'])}}
                                    </div>
                                </div>
                                <div class = "row">
                                    <div class = "col-6">
                                        {{Form::label('reserveStartTime','Start Time:', ['class' => 'text-left text-uppercase'])}}
                                        {{Form::time('reserveStartTime','',['class'=> 'form-control','placeholder'=>'Ex. Jr, II, III'])}}
                                    </div>
                                    <div class = "col-6">
                                        {{Form::label('reserveEndTime','End Time:', ['class' => 'text-left text-uppercase'])}}
                                        {{Form::time('reserveEndTime','',['class'=> 'form-control'])}}
                                    </div>
                                </div>
                
                                <div class = "row">
                                    <div class = "col-6">
                                        {{Form::label('pax','PAX:')}}
                                        {{Form::number('pax','',['class'=> 'form-control','placeholder'=>'0'])}}
                                                            <br>    
                                        
                                    </div>
                                    <div class = "col-6">
                                            {!! Form::Label('setup', 'Setup:') !!}
                                            {!! Form::select('setup', $items, null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="row">
                                        {{Form::submit('Check Available Studio',['class'=>'btn btn-success btn-block globeDarkBlueBackgroundColor text-uppercase'])}}           
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
            </div>
        </div>
    </div>
<hr>
    <h3>Reservations and Utilizations</h3>
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-q1" aria-selected="true">Quarter 1</a>
            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-q2" aria-selected="false">Quarter 2</a>
            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-q3" aria-selected="false">Quarter 3</a>
            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-q4" aria-selected="false">Quarter 4</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-q1" role="tabpanel" aria-labelledby="nav-q1-tab">

            
        </div>
        <div class="tab-pane fade" id="nav-q2" role="tabpanel" aria-labelledby="nav-q2-tab">


        </div>
        <div class="tab-pane fade" id="nav-q3" role="tabpanel" aria-labelledby="nav-q3-tab">


        </div>
        <div class="tab-pane fade" id="nav-q4" role="tabpanel" aria-labelledby="nav-q4-tab">


            </div>
    </div>


    <hr>

    <h3>Reservations </h3>

    @if(count($employee)==3)
        <div class="card-deck ">
        @foreach ($employee as $searches)
            <div class="card text-center mycarddesign">
            <div class="card-header"><h5><b>{{$searches->ReferenceID}}</b></h5> <h3><i>{{$searches->EmployeeName}}</i></h3></div>
                <img class="card-img-top" src="/storage/images/{{$searches->RoomPicture}}" alt="Card image cap" style="height:38%;">
                <div class="card-body ">
                        <p></p>
                        <h5><b>{{$searches->Title}}</b> - {{$searches->Room}}</h5>
                        <p class="card-text">
                        <b>Start Date: </b><?php $date = date("M jS, Y", strtotime($searches->ReserveStartDate)); echo $date?><br>
                        <b>End Date: </b><?php $date = date("M jS, Y", strtotime($searches->ReserveEndDate)); echo $date?><br>
                        <b>Set-up: </b>{{$searches->Setup}}<br>
                        <b>Capacity: </b>{{$searches->Pax}}<br>
                        <span style="color:green">Available</span></p>
                </div>
                <div class="card-footer">
                {!! Form::open(['action'=> 'MatchController@step1_reserve','method'=>'POST']) !!}
                {{ csrf_field() }}
                {{Form::submit('View',['class'=>'btn btn-primary btn-block  text-uppercase'])}}           
                
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
        
    @elseif (count($employee)==1)
    <div class="card-deck ">
            @foreach ($employee as $searches)
                <div class="card text-center mycarddesign">
                    <img class="card-img-top" src="/storage/images/{{$searches->RoomPicture}}" alt="Card image cap" style="wdith:80%;">
                    <div class="card-body">
                            <h3>{{$searches->Room}}</h3>
                            <p class="card-text">
                            <b>Set-up: </b>{{$searches->Setup}}<br>
                            <b>Capacity: </b>{{$searches->Pax}}<br>
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
    
<hr>
    <h3> Room Utilizations </h3>
</div>
@endsection
