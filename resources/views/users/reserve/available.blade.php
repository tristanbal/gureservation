@extends('layouts.app')

@section('content')
<div class="container ">
    @if(count($results)>=1)
        
    {!! Form::open(['action'=> 'MatchController@step1_reserve','method'=>'POST']) !!}
    {{ csrf_field() }}
        <br>
        <div class="row">
            <div class="col-sm-7">
            <ul class="list-group">
                <?php $first = true; ?>
                    @foreach ($results as $searches)
                    <?php if ($first) { ?>
                        <li class="list-group-item ">
                        
                                <h1 class="text-uppercase">Recommended Room: <b> {{$searches->RoomName}} </b></h1>
                                    <img class="card-img-top" src="{{asset('mystorage/images/'.$searches->Picture.'') }}" alt="Card image cap" style="width:100%;">
                                    <br><br>
                                    
                                    <input type="number" value="{{$searches->RoomSetupID}}" name="roomPerSetUp" hidden>
                                    <input type="date" value="{{$startDateNext}}" name="reserveStartDate" hidden >
                                    <input type="date" value="{{$endDateNext}}" name="reserveEndDate" hidden>
                                    <input type="number" value="{{$capacity}}" name="pax" hidden>
                                    <input type="text" value="{{$setupNext}}" name="setup" hidden>
                                    <h5 class="card-text">Set-up: {{$searches->Setup}}<br>
                                    Capacity: {{$searches->Capacity}}<br>
                                    <span style="color:green">Available</span></h5>
                            
                                    <button type="button" class="btn btn-success btn-block text-uppercase" data-toggle="modal" data-target="#recommendedRoom">
                                            Book Now
                                        </button>
                                    
                                
                                
                            </li>
                    <?php $first=false;
                    } ?>
                    
                    @endforeach
            </ul>
            </div>
            <!-- Button trigger modal -->
            
            
            <!-- Modal -->
            <div class="modal fade" id="recommendedRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Booking Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    {{Form::label('personInCharge','Person-In-Charge:')}}
                                    {{Form::text('personInCharge','',['class'=> 'form-control','placeholder'=>'Juan Dela Cruz'])}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    {{Form::label('personInChargeEmail','Person-In-Charge Email:')}}
                                    {{Form::email('personInChargeEmail','',['class'=> 'form-control','placeholder'=>'jgdelcruz@globe.com.ph'])}}
                                </div>
                                <div class="col-6">
                                    {{Form::label('personInChargeContact','Person-In-Charge Contact:')}}
                                    {{Form::text('personInChargeContact','',['class'=> 'form-control','placeholder'=>'0917XXXXXXX'])}}
                                </div>
                            </div>
                            <div class="row">
                                    <div class="col-sm-12">
                                        {{Form::label('title','Title/Training Name:')}}
                                        <input type="text" class="form-control" name="title" placeholder="Design Thinking" required>
                                    </div>
                                </div>
                                <p><i>Inclusions of a reservation are 1 whiteboard, 1 extension, 5 markers, pens, stapler, stapple remover, name tags, notepad, scissors, ruler, masking tape and scotch tape</i>
                                         </p>
                            <div class="row">
                                <div class="col-sm-12">
                                        <div class="checkbox">
                                                {{Form::label('checkbox[]','Additional Equipment - Subject to Availability (claim at 5/f Atelier):')}}<br>
                                                <label class="checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox1" name="items[]" value="Projector"> Projector
                                                </label><br>
                                                <label class="checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox2" name="items[]" value="Whiteboard"> Whiteboard
                                                </label><br>
                                                <label class="checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox3" name="items[]" value="Easel Board"> Easel Board
                                                </label><br>
                                                <label class="checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox3" name="items[]" value="Extension Cord"> Extension Cord
                                                </label><br>
                                                <label class="checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox3" name="items[]" value="Microphone"> Microphone
                                                </label><br>
                                          </div>
                                </div>
                            </div>
                            <p>Special Instruction</p>
                            <textarea class="form-control" rows="3" placeholder="Instructions" name="instructions"></textarea>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    {{Form::submit('Submit',['class'=>'btn btn-success text-uppercase'])}}           
                    </div>
                </div>
                </div>
            </div>
            <div class="col-sm-5">
                <!--<h1>Recommended Room</h1>-->
                        <input type="text" value="{{$firstname}}" name="firstname" hidden>
                        <input type="text" value="{{$middlename}}" name="middlename" hidden>
                        <input type="text" value="{{$lastname}}" name="lastname" hidden>
                        <input type="text" value="{{$employeeID}}" name="employeeID" hidden>
                        <input type="text" value="{{$groupname}}" name="groupname" hidden>
                        <input type="text" value="{{$email}}" name="email" hidden>
                        <input type="text" value="{{$phone}}" name="phone" hidden>
                        <input type="time" value="{{$reserveStartTime}}" name="reserveStartTime" hidden>
                        <input type="time" value="{{$reserveEndTime}}" name="reserveEndTime" hidden>
                        <input type="text" value="{{$reserveEndTime}}" name="random" hidden>
                <h5>We found a room for you, {{$firstname}}. The recommended room was determined through the specified date(s), pax and setup.</h5>
                <hr>
                <h3>Room Location:</h3>
                <h5>The Globe University Campus, 5F Tower 1, GT Plaza Mandaluyong City</h5>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.468874155708!2d121.04763681431983!3d14.572338181676583!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c84463088019%3A0x7337e6bd1999d877!2sThe+Globe+University+Campus%2C+5F+Tower+1%2C+GT+Plaza+Mandaluyong+City!5e0!3m2!1sen!2sph!4v1538361163879" 
                    style="width:100%;height:50vh;border:0 " frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
        <?php array_shift($results);?>
        {!! Form::close() !!}
        <hr>
        <h1 class = "py-2 pt-3">Other rooms you might prefer:</h1>
            @if(count($results)>=3)
                <div class="card-deck ">
                <?php $i = 0; ?>
                @foreach ($results as $searches)
                    <?php if ($i >= 3 ) { break; } else {?>
                    <div class="card text-center ">
                        <img class="card-img-top" src="{{asset('mystorage/images/'.$searches->Picture.'') }}" alt="Card image cap" style="width:100%;">
                        <div class="card-body">
                                <h5>{{$searches->RoomName}}</h5>
                                <p class="card-text">
                                <b>Set-up: </b>{{$searches->Setup}}<br>
                                <b>Capacity: </b>{{$searches->Capacity}}<br>
                                <span style="color:green">Available</span></p>
                        </div>
                        <div class="card-footer">
                        {!! Form::open(['action'=> 'MatchController@step1_reserve','method'=>'POST']) !!}
                        {{ csrf_field() }}
                        <input type="text" value="{{$firstname}}" name="firstname" hidden>
                        <input type="text" value="{{$middlename}}" name="middlename" hidden>
                        <input type="text" value="{{$lastname}}" name="lastname" hidden>
                        <input type="text" value="{{$employeeID}}" name="employeeID" hidden>
                        <input type="text" value="{{$groupname}}" name="groupname" hidden>
                        <input type="text" value="{{$email}}" name="email" hidden>
                        <input type="text" value="{{$phone}}" name="phone" hidden>
                        <input type="time" value="{{$reserveStartTime}}" name="reserveStartTime" hidden>
                        <input type="time" value="{{$reserveEndTime}}" name="reserveEndTime" hidden>
                        <input type="text" value="{{$reserveEndTime}}" name="random" hidden>
                        <input type="number" value="{{$searches->RoomSetupID}}" name="roomPerSetUp" hidden>
                            <input type="date" value="{{$startDateNext}}" name="reserveStartDate" hidden >
                            <input type="date" value="{{$endDateNext}}" name="reserveEndDate" hidden>
                            <input type="number" value="{{$capacity}}" name="pax" hidden>
                            <input type="text" value="{{$setupNext}}" name="setup" hidden>
                            <button type="button" class="btn btn-success btn-block text-uppercase" data-toggle="modal" data-target="#recommendedRoom<?php echo $i-1 ?>">
                                    Book Now
                                </button>    
                        
                        
                        </div>
                    </div>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="recommendedRoom<?php echo $i-1 ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Booking Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                        {{Form::label('personInCharge','Person-In-Charge:')}}
                                        {{Form::text('personInCharge','',['class'=> 'form-control','placeholder'=>'Juan Dela Cruz'])}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        {{Form::label('personInChargeEmail','Person-In-Charge Email:')}}
                                        {{Form::email('personInChargeEmail','',['class'=> 'form-control','placeholder'=>'jgdelcruz@globe.com.ph'])}}
                                    </div>
                                    <div class="col-6">
                                        {{Form::label('personInChargeContact','Person-In-Charge Contact:')}}
                                        {{Form::text('personInChargeContact','',['class'=> 'form-control','placeholder'=>'0917XXXXXXX'])}}
                                    </div>
                                </div>
                                <div class="row">
                                        <div class="col-sm-12">
                                            {{Form::label('title','Title/Training Name:')}}
                                            <input type="text" class="form-control" name="title" placeholder="Design Thinking" required>
                                        </div>
                                    </div>
                                    <p><i>Inclusions of a reservation are 1 whiteboard, 1 extension, 5 markers, pens, stapler, stapple remover, name tags, notepad, scissors, ruler, masking tape and scotch tape</i>
                                             </p>
                                <div class="row">
                                    <div class="col-sm-12">
                                            <div class="checkbox">
                                                    {{Form::label('checkbox[]','Additional Equipment - Subject to Availability (claim at 5/f Atelier):')}}<br>
                                                    <label class="checkbox-inline">
                                                    <input type="checkbox" id="inlineCheckbox1" name="items[]" value="Projector"> Projector
                                                    </label><br>
                                                    <label class="checkbox-inline">
                                                    <input type="checkbox" id="inlineCheckbox2" name="items[]" value="Whiteboard"> Whiteboard
                                                    </label><br>
                                                    <label class="checkbox-inline">
                                                    <input type="checkbox" id="inlineCheckbox3" name="items[]" value="Easel Board"> Easel Board
                                                    </label><br>
                                                    <label class="checkbox-inline">
                                                    <input type="checkbox" id="inlineCheckbox3" name="items[]" value="Extension Cord"> Extension Cord
                                                    </label><br>
                                                    <label class="checkbox-inline">
                                                    <input type="checkbox" id="inlineCheckbox3" name="items[]" value="Microphone"> Microphone
                                                    </label><br>
                                              </div>
                                    </div>
                                </div>
                                <p>Special Instruction</p>
                                <textarea class="form-control" rows="3" placeholder="Instructions" name="instructions"></textarea>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        {{Form::submit('Submit',['class'=>'btn btn-success text-uppercase'])}}  
                        {!! Form::close() !!}         
                        </div>
                    </div>
                    </div>
                </div>
                <?php $i++; } ?>
                @endforeach
                </div>

                

                
            @elseif (count($results)==2)
            <div class="card-deck ">
                <?php $i = 0; ?>
                    @foreach ($results as $searches)
                    <?php if ($i >= 3 ) {break;} else {?>
                    <div class="card text-center ">
                        <img class="card-img-top" src="{{asset('mystorage/images/'.$searches->Picture.'') }}" alt="Card image cap" style="width:100%;height:auto;">
                        <div class="card-body">
                            <h5>{{$searches->RoomName}}</h5>
                            <p class="card-text">
                            <b>Set-up: </b>{{$searches->Setup}}<br>
                            <b>Capacity: </b>{{$searches->Capacity}}<br>
                            <span style="color:green">Available</span></p>
                        </div>
                        <div class="card-footer">
                            {!! Form::open(['action'=> 'MatchController@step1_reserve','method'=>'POST']) !!}
                            {{ csrf_field() }}
                            <input type="text" value="{{$firstname}}" name="firstname" hidden>
                            <input type="text" value="{{$middlename}}" name="middlename" hidden>
                            <input type="text" value="{{$lastname}}" name="lastname" hidden>
                            <input type="text" value="{{$employeeID}}" name="employeeID" hidden>
                            <input type="text" value="{{$groupname}}" name="groupname" hidden>
                            <input type="text" value="{{$email}}" name="email" hidden>
                            <input type="text" value="{{$phone}}" name="phone" hidden>
                            <input type="time" value="{{$reserveStartTime}}" name="reserveStartTime" hidden>
                            <input type="time" value="{{$reserveEndTime}}" name="reserveEndTime" hidden>
                            <input type="text" value="{{$reserveEndTime}}" name="random" hidden>
                            <input type="number" value="{{$searches->RoomSetupID}}" name="roomPerSetUp" hidden>
                            <input type="date" value="{{$startDateNext}}" name="reserveStartDate" hidden >
                            <input type="date" value="{{$endDateNext}}" name="reserveEndDate" hidden>
                            <input type="number" value="{{$capacity}}" name="pax" hidden>
                            <input type="text" value="{{$setupNext}}" name="setup" hidden>
                            <button type="button" class="btn btn-success btn-block text-uppercase" data-toggle="modal" data-target="#recommendedRoom<?php echo $i-1 ?>">
                                Book Now
                            </button>  
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="recommendedRoom<?php echo $i-1 ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Booking Details</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12">
                                            {{Form::label('personInCharge','Person-In-Charge:')}}
                                            {{Form::text('personInCharge','',['class'=> 'form-control','placeholder'=>'Juan Dela Cruz'])}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            {{Form::label('personInChargeEmail','Person-In-Charge Email:')}}
                                            {{Form::email('personInChargeEmail','',['class'=> 'form-control','placeholder'=>'jgdelcruz@globe.com.ph'])}}
                                        </div>
                                        <div class="col-6">
                                            {{Form::label('personInChargeContact','Person-In-Charge Contact:')}}
                                            {{Form::text('personInChargeContact','',['class'=> 'form-control','placeholder'=>'0917XXXXXXX'])}}
                                        </div>
                                    </div>
                                    <div class="row">
                                            <div class="col-sm-12">
                                                {{Form::label('title','Title/Training Name:')}}
                                                <input type="text" class="form-control" name="title" placeholder="Design Thinking" required>
                                            </div>
                                        </div>
                                        <p><i>Inclusions of a reservation are 1 whiteboard, 1 extension, 5 markers, pens, stapler, stapple remover, name tags, notepad, scissors, ruler, masking tape and scotch tape</i>
                                                </p>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="checkbox">
                                                    {{Form::label('checkbox[]','Additional Equipment - Subject to Availability (claim at 5/f Atelier):')}}<br>
                                                    <label class="checkbox-inline">
                                                    <input type="checkbox" id="inlineCheckbox1" name="items[]" value="Projector"> Projector
                                                    </label><br>
                                                    <label class="checkbox-inline">
                                                    <input type="checkbox" id="inlineCheckbox2" name="items[]" value="Whiteboard"> Whiteboard
                                                    </label><br>
                                                    <label class="checkbox-inline">
                                                    <input type="checkbox" id="inlineCheckbox3" name="items[]" value="Easel Board"> Easel Board
                                                    </label><br>
                                                    <label class="checkbox-inline">
                                                    <input type="checkbox" id="inlineCheckbox3" name="items[]" value="Extension Cord"> Extension Cord
                                                    </label><br>
                                                    <label class="checkbox-inline">
                                                    <input type="checkbox" id="inlineCheckbox3" name="items[]" value="Microphone"> Microphone
                                                    </label><br>
                                            </div>
                                        </div>
                                    </div>
                                    <p>Special Instruction</p>
                                    <textarea class="form-control" rows="3" placeholder="Instructions" name="instructions"></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    {{Form::submit('Submit',['class'=>'btn btn-success text-uppercase'])}}  
                                    {!! Form::close() !!}         
                                </div>
                            </div>
                        </div>
                        <?php $i++; } ?>
                    </div>
                    @endforeach
                
            @elseif (count($results)==1)
            <div class="card-deck ">
                <?php $i = 0; ?>
                    @foreach ($results as $searches)
                    <?php if ($i >= 3 ) {break;} else {?>
                        <div class="card text-center">
                        <img class="card-img-top" src="{{asset('mystorage/images/'.$searches->Picture.'') }}" alt="Card image cap" style="width:100%;height:auto;">
                        <div class="card-body">
                            <h5>{{$searches->RoomName}}</h5>
                            <p class="card-text">
                            <b>Set-up: </b>{{$searches->Setup}}<br>
                            <b>Capacity: </b>{{$searches->Capacity}}<br>
                            <span style="color:green">Available</span></p>
                        </div>
                        <div class="card-footer">
                            {!! Form::open(['action'=> 'MatchController@step1_reserve','method'=>'POST']) !!}
                            {{ csrf_field() }}
                            <input type="text" value="{{$firstname}}" name="firstname" hidden>
                            <input type="text" value="{{$middlename}}" name="middlename" hidden>
                            <input type="text" value="{{$lastname}}" name="lastname" hidden>
                            <input type="text" value="{{$employeeID}}" name="employeeID" hidden>
                            <input type="text" value="{{$groupname}}" name="groupname" hidden>
                            <input type="text" value="{{$email}}" name="email" hidden>
                            <input type="text" value="{{$phone}}" name="phone" hidden>
                            <input type="time" value="{{$reserveStartTime}}" name="reserveStartTime" hidden>
                            <input type="time" value="{{$reserveEndTime}}" name="reserveEndTime" hidden>
                            <input type="text" value="{{$reserveEndTime}}" name="random" hidden>
                            <input type="number" value="{{$searches->RoomSetupID}}" name="roomPerSetUp" hidden>
                            <input type="date" value="{{$startDateNext}}" name="reserveStartDate" hidden >
                            <input type="date" value="{{$endDateNext}}" name="reserveEndDate" hidden>
                            <input type="number" value="{{$capacity}}" name="pax" hidden>
                            <input type="text" value="{{$setupNext}}" name="setup" hidden>
                            <button type="button" class="btn btn-success btn-block text-uppercase" data-toggle="modal" data-target="#recommendedRoom<?php echo $i-1 ?>">
                                Book Now
                            </button>  
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="recommendedRoom<?php echo $i-1 ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Booking Details</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12">
                                            {{Form::label('personInCharge','Person-In-Charge:')}}
                                            {{Form::text('personInCharge','',['class'=> 'form-control','placeholder'=>'Juan Dela Cruz'])}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            {{Form::label('personInChargeEmail','Person-In-Charge Email:')}}
                                            {{Form::email('personInChargeEmail','',['class'=> 'form-control','placeholder'=>'jgdelcruz@globe.com.ph'])}}
                                        </div>
                                        <div class="col-6">
                                            {{Form::label('personInChargeContact','Person-In-Charge Contact:')}}
                                            {{Form::text('personInChargeContact','',['class'=> 'form-control','placeholder'=>'0917XXXXXXX'])}}
                                        </div>
                                    </div>
                                    <div class="row">
                                            <div class="col-sm-12">
                                                {{Form::label('title','Title/Training Name:')}}
                                                <input type="text" class="form-control" name="title" placeholder="Design Thinking" required>
                                            </div>
                                        </div>
                                        <p><i>Inclusions of a reservation are 1 whiteboard, 1 extension, 5 markers, pens, stapler, stapple remover, name tags, notepad, scissors, ruler, masking tape and scotch tape</i>
                                                </p>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="checkbox">
                                                    {{Form::label('checkbox[]','Additional Equipment - Subject to Availability (claim at 5/f Atelier):')}}<br>
                                                    <label class="checkbox-inline">
                                                    <input type="checkbox" id="inlineCheckbox1" name="items[]" value="Projector"> Projector
                                                    </label><br>
                                                    <label class="checkbox-inline">
                                                    <input type="checkbox" id="inlineCheckbox2" name="items[]" value="Whiteboard"> Whiteboard
                                                    </label><br>
                                                    <label class="checkbox-inline">
                                                    <input type="checkbox" id="inlineCheckbox3" name="items[]" value="Easel Board"> Easel Board
                                                    </label><br>
                                                    <label class="checkbox-inline">
                                                    <input type="checkbox" id="inlineCheckbox3" name="items[]" value="Extension Cord"> Extension Cord
                                                    </label><br>
                                                    <label class="checkbox-inline">
                                                    <input type="checkbox" id="inlineCheckbox3" name="items[]" value="Microphone"> Microphone
                                                    </label><br>
                                            </div>
                                        </div>
                                    </div>
                                    <p>Special Instruction</p>
                                    <textarea class="form-control" rows="3" placeholder="Instructions" name="instructions"></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    {{Form::submit('Submit',['class'=>'btn btn-success text-uppercase'])}}  
                                    {!! Form::close() !!}         
                                </div>
                            </div>
                        </div>
                        <?php $i++; } ?>
                    </div>
                    @endforeach
            @else
                <div class="alert alert-danger">
                    No rooms found.
                </div>
            @endif
            </div>
    </div>

    @else
    <div class="text-center"><br>
        <img src="{{asset('images/logo/Error.png')}}" style="width:10%;">
    </div>
        <br>
        <h1>There are no available rooms at the moment. Try:</h1><br>
        <ul class="list-group">
            <li class="list-group-item">Searching other dates. Your preferred date/s might be reserved.</li>
            <li class="list-group-item">Searching other pax or set-ups. Rooms may be unavailable due to pax and set-up availability.</li>
            <li class="list-group-item">Enlisting on our Wait List System if you wish to push on your preferred date. Please do know that there is no full guarantee.
                
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
                <!--<input type="text" value="{{$reserveEndTime}}" name="random" hidden>--> <br>
                {{Form::submit('Enlist in Wait List System',['class'=>'btn btn-primary text-uppercase'])}}           
                                
                {!! Form::close() !!}
        </ul>
    @endif
</div>   
<br>
@endsection
