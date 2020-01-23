@extends('layouts.app')

@section('content')
@if(count($item)>=1)
{!! Form::open(['action'=> ['ReserveController@update',$reservations->id],'method'=>'GET']) !!}
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
        @if($errors->any())
        <h4>{{$errors->first()}}</h4>
        @endif
        Your reservation
        @if ($reservations->reserveStartDate == $reservations->reserveEndDate)
            is on {{date('d-F-Y',strtotime($reservations->reserveStartDate))}}.
        @else
            is from <?php echo date('F d',strtotime($reservations->reserveStartDate)); ?> - <?php echo date('d, Y', strtotime($reservations->reserveEndDate));?>.
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
                {{Form::label('title','Title:',['class'=>'text-muted'])}}
                <h4 class="text-uppercase">{{$reservations->title}}</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                {{Form::label('startTime','Start Time:',['class'=>'text-muted'])}}
                <h4 class="text-uppercase"><?php echo date('h:mA',strtotime($reservations->reserveStartTime));?></h4>
                </div>
                <div class="col-sm-6">
                {{Form::label('endTime','End Time:',['class'=>'text-muted'])}}
                <h4 class="text-uppercase"><?php echo date('h:mA',strtotime($reservations->reserveEndTime));?></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                {{Form::label('personInCharge','Person-In-Charge:',['class'=>'text-muted'])}}
                <h4 class="text-uppercase">{{$reservations->personInCharge}}</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                {{Form::label('personInChargeEmail','Person-In-Charge Email:',['class'=>'text-muted'])}}
                <h4 class="text-uppercase">{{$reservations->personInChargeEmail}}</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                {{Form::label('personInChargeContact','Person-In-Charge Contact:')}}
                <h4 class="text-uppercase">{{$reservations->personInChargeContact}}</h4>
                </div>
            </div>
            <div class="row" style="padding-top:40px;padding-bottom:40px;">
                <div class="col-sm-6"><a href="{{route('reservations.edit',$reservations)}}" class="btn btn-primary" style="width:100%;">Edit Reservation Info</a></div>
                {!! Form::close() !!}
                <div class="col-sm-6">
                {!! Form::open(['action'=> ['AdminController@cancel'],'method'=>'POST']) !!}
                {{ csrf_field() }}
                    <input type="text" value="{{$reservations->id}}" name="id" hidden>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                        Cancel Reservation
                    </button>

                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLabel text-uppercase">Cancel Reservation</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                            <h5>Are sure you want to cancel?</h5>
                            <p class="text-muted">Cancelling your reservation will allow waitlisted reservations to replace your schedule. Do you want to continue?</p>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            {{Form::submit('Continue',['class'=>'btn btn-danger'])}}
                            </div>
                        </div>
                        </div>
                    </div>
                {!!Form::close()!!}
                </div>
                
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-12">
            @if(count($roomPerSetup) > 0)
                @foreach($roomPerSetup as $roomPerSetups)
                    @if ($roomPerSetups->id == $reservations->roomPerSetUpID)
                    
                        @if(count($room) > 0)
                            @foreach($room as $rooms)
                                @if ($roomPerSetups->roomID == $rooms->id)
                                <br>
                                    <h3>{{$rooms->name}} is located at the Globe University 5th floor of Globe Telecom Plaza 1 in Mandaluyong City.</h3>
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <img class="card-img-top" src="{{asset('mystorage/images/'.$rooms->picture.'') }}" alt="Card image cap" style="width:100%;height:auto;">
                                        </div>
                                        <div class="col-sm-5">
                                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.468874155708!2d121.04763681431983!3d14.572338181676583!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c84463088019%3A0x7337e6bd1999d877!2sThe+Globe+University+Campus%2C+5F+Tower+1%2C+GT+Plaza+Mandaluyong+City!5e0!3m2!1sen!2sph!4v1538361163879" 
                                            style="width:100%;height:auto;border:0 " frameborder="0" allowfullscreen></iframe>
                                            <h5>The Globe University Campus, 5F Tower 1, GT Plaza Mandaluyong City</h5>
                                        </div>
                                    </div>
                                    
                                    
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
    
    {{ csrf_field() }}
    <br>
    <h1>Boarding Pass </h1>
    <hr>
    @foreach ($item as $roomInfo)
    <div class="row">
        
            <div class="card" style="width:100%;">
                    <div class="card-header globeDarkBlueBackgroundColor">
                        <h3 class="text-light">Globe University</h3>
                    </div>
                    <div class="card-body">
                        <table>
                            <td class="align-top" style="width:60%;">
                                <h1 class="card-text text-uppercase"><b>{{$roomInfo->RoomName}}</b></h1>
                                <h3 class="text-uppercase">{{$roomInfo->lastname}}, {{$roomInfo->firstname}} </h3>
                                <h5 class="text-uppercase">({{$roomInfo->employeeID}}) <br>
                                        GROUP</h5>
                                <p ></p>
                                <br>
                                <br>
                                <h5 class="card-text">Reference ID:<b> {{$roomInfo->referenceID}}</b></h5>
                                <p> Note: <i>For your convenience, your reference number is posted above in cases when you need to edit or cancel your 
                                        reservation. Your reference number must be presented on the of day its reservation.</i> </p>
                            </td>
                            <td class="align-top">
                                    <p> Reservation Sched: </p>
                                    <h3><b>{{$roomInfo->startDate}} - {{$roomInfo->endDate}}</b></h3>
                                <p> Time: <b>{{$roomInfo->reserveStartTime}} - {{$roomInfo->reserveEndTime}}</b>
                                <br>
                                <br>
                                Title: <b>{{$roomInfo->title}}</b><br>
                                Type: <b><span class="">{{$roomInfo->Setup}}</span></b><br>
                                Pax: <b><span class="">{{$roomInfo->Capacity}}</span></b><br>
                                <br><br>
                                Person-In-Charge: {{$roomInfo->PIC}} <br>
                                Person-In-Charge Email: {{$roomInfo->PICE}} <br>
                                Person-In-Charge Contact: {{$roomInfo->PICC}} <br>
                            
                            </p>
                            </td>
                        </table>
                        

                    </div>
                  </div>
       
            
    </div>
        @endforeach
    </div>
    <br>
    @else
    <!--<div class="alert alert-danger">
        Reference ID does not exist.
    </div>-->
    <div class="container">
    <center><br>
    <img src="{{asset('images/logo/Error.png')}}" style="width:10%;">
    </center>
    <br> 
    <h1>Oops, it seems like your reference ID does not exist. Try:</h1><br>
    <ul class="list-group">
        <li class="list-group-item">Retyping your reference ID in case you mistyped it.</li>
        <li class="list-group-item">Checking if you might have cancelled your reservation.</li>
        <li class="list-group-item">Checking if your reference ID might have been updated.</li>
    </ul>
@endif
</div>
    
<script src="/js/app.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
      $(document).ready(function(){
          $('#users').select2();
       });
    </script>
@endsection