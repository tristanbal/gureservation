@extends('layouts.app')

@section('content')
{{ Form::open(array('url'=> route('reservations.update',$reservations))) }}
@method('PUT')
{{ csrf_field() }}
<input type="text" value="{{$reservations->id}}" name="roomID" hidden>
<div style="width:100%;">
    <div class="container">
        <!--Div for Display-->
        <div class="display-3 ">
            @if(count($roomPerSetup) > 0)
                @foreach($roomPerSetup as $roomPerSetups)
                    @if ($roomPerSetups->id == $reservations->roomPerSetUpID)
                    
                        @if(count($room) > 0)
                            @foreach($room as $rooms)
                                @if ($roomPerSetups->roomID == $rooms->id)
                                
                                    {{$rooms->name}}
                                
                                @endif
                            @endforeach
                        @endif
                    @endif
                @endforeach
            @endif
        </div>
    </div>
</div>


<div class="container">
    
    <hr>
    <h3 class="font-weight-light">        
        @if(count($employee_data) > 0)
            @foreach($employee_data as $employee_datas)
                @if ($employee_datas->employeeID == $reservations->employeeID)
                    @if ($employee_datas->firstname=='Globe')
                        Welcome back, ka-Globe!
                    @else
                        Welcome back, {{$employee_datas->firstname}}! 
                    @endif
                @endif
            @endforeach
        @endif

        Your reservation
        @if ($reservations->reserveStartDate == $reservations->reserveEndDate)
            is on {{date('d-F-Y',strtotime($reservations->reserveStartDate))}}.
        @else
            is from {{date('d-F-Y',strtotime($reservations->reserveStartDate))}} to {{date('d-F-Y',strtotime($reservations->reserveEndDate))}}.
        @endif
    </h3>
    <div class="row">
        <div class="col-sm-5">
            <div class="col-sm-12 font-weight-bold">
                <br>
                <div class="row">
                        <div class="col-sm-12 d-flex justify-content-center">
                            <?php 
                            $date1 =  strtotime($reservations->reserveStartDate);
                            $remaining1 = $date1 - time();
                            $days_remaining1 = floor($remaining1 / 86400);
                            $hours_remaining1 = floor(($remaining1 % 86400) / 3600);
    
                            if ($days_remaining1 > 0) {?>
                                <div class="card" style="width: 18rem;">
                                    <div class="card-header bg-danger text-white text-uppercase font-weight-bold d-flex justify-content-center">
                                        <h3>Days To Go</h3>
                                    </div>
                                    <ul class="list-group list-group-flush ">
                                        <li class="list-group-item">
                                                <div class="display-1 d-flex justify-content-center">{{$days_remaining1}}</div></li>
                                    </ul>
                                </div>
                            <?php } else {?>
                                <div class="card" style="width: 18rem;">
                                    <div class="card-header bg-danger text-white text-uppercase font-weight-bold d-flex justify-content-center">
                                        
                                        <h3>Hours To Go</h3>
                                    </div>
                                    <ul class="list-group list-group-flush ">
                                        <li class="list-group-item">
                                                <div class="display-1 d-flex justify-content-center">{{$hours_remaining1}}</div></li>
                                    </ul>
                                </div>
                                
                            <?php } ?>
                        </div>
                </div>
                <br>
                
                
                {{Form::label('pax','Number of Pax/Room Capacity:')}}
                <div class="progress" style="height:20px">
                    
                        @if(count($roomPerSetup) > 0)
                            @foreach($roomPerSetup as $roomPerSetups)
                                @if ($roomPerSetups->id == $reservations->roomPerSetUpID)
                                    <div class="progress-bar" style="width:<?php echo ($reservations->pax/$roomPerSetups->capacity)*100;?>%;height:20px">Pax: 
                                        {{$reservations->pax}}/{{$roomPerSetups->capacity}}
                                    </div>
                                @endif
                            @endforeach
                        @endif
                        
                        
                </div>
            </div>
        </div>
        <div class="col-sm-7">
            <div class="row">
                <div class="col-sm-12">
                {{Form::label('title','Title:')}}
                {{Form::text('title',$reservations->title, ['class'=>'form-control','placeholder'=>'title'])}}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                {{Form::label('startTime','Start Time:')}}
                {{Form::time('startTime',$reservations->reserveStartTime, ['class'=>'form-control','placeholder'=>'title'])}}
                </div>
                <div class="col-sm-6">
                {{Form::label('endTime','End Time:')}}
                {{Form::time('endTime',$reservations->reserveEndTime, ['class'=>'form-control','placeholder'=>'title'])}}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                {{Form::label('personInCharge','Person-In-Charge:')}}
                {{Form::text('personInCharge',$reservations->personInCharge, ['class'=>'form-control','placeholder'=>'title'])}}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                {{Form::label('personInChargeEmail','Person-In-Charge Email:')}}
                {{Form::text('personInChargeEmail',$reservations->personInChargeEmail, ['class'=>'form-control','placeholder'=>'title'])}}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                {{Form::label('personInChargeContact','Person-In-Charge Contact:')}}
                {{Form::text('personInChargeContact',$reservations->personInChargeContact, ['class'=>'form-control','placeholder'=>'title'])}}
                </div>
            </div>
        </div>
    </div><br><br>
    <div class="d-flex justify-content-center" stlye="padding:40px;">
    {{Form::submit('Update Reservation',['class'=>'btn btn-success'])}}
    </div>
    {!! Form::close() !!}
</div>
@endsection
