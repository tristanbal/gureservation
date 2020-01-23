@extends('layouts.appAdmin')

@section('content')
    <div class="container">
        <div class="display-3">Manual Reservation</div>
        <hr>

        @if(count($results)>=1)

        <div class="row">
                <?php $i = 0; ?>
            @foreach ($results as $searches)
                <div class="col-sm-4">
                <div class="card text-center ">
                    <img class="card-img-top" src="{{asset('mystorage/images/'.$searches->Picture.'') }}" alt="Card image cap" style="height:auto%;width:100%;">
                    <div class="card-body">
                            <h5>{{$searches->RoomName}}</h5>
                                {!! Form::open(['action'=> 'AdminController@manualReserveStepThree','method'=>'POST']) !!}
                                {{ csrf_field() }}
                            {!! Form::Label('setup', 'Setup:') !!}
                            {!! Form::select('setup', $setup, null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="card-footer">
                    <input type="number" value="{{$searches->RoomID}}" name="roomID" hidden>
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
                    <!--<input type="number" value="" name="roomPerSetUp" hidden>-->
                        <input type="date" value="{{$startDateNext}}" name="reserveStartDate" hidden >
                        <input type="date" value="{{$endDateNext}}" name="reserveEndDate" hidden>
                        <!--<input type="number" value="" name="pax" hidden>-->
                        <!--<input type="text" value="" name="setup" hidden>-->
                        


                        <button type="button" class="btn btn-success btn-block text-uppercase" data-toggle="modal" data-target="#recommendedRoom<?php echo $i-1 ?>">
                                Book Now
                            </button>    
                    
                    
                    </div>
                </div>
                <br>
                </div>
                
                <!-- Modal -->
                <div class="modal fade" id="recommendedRoom<?php echo $i-1 ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Booking Details ID: {{$searches->RoomID}}</h5>
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
                                        {{Form::label('pax','Pax:')}}
                                        <input type="number" name="pax" class="form-control" placeholder='0' value="0" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        {{Form::label('title','Title/Training Name:')}}
                                        <input type="text" name="title" class="form-control" placeholder='Design Thinking' value="Design Thinking" required>
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
                <?php $i++; ?>
            @endforeach
        </div>

        @else

        @endif
    </div>
@endsection
