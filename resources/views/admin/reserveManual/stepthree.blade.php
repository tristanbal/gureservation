@extends('layouts.appAdmin')

@section('content')
    

<div class="container">
    @if(count($roomDetails)>=1)
    {!! Form::open(['action'=> 'MatchController@step2_reserve','method'=>'POST']) !!}
    {{ csrf_field() }}
    <br>
    <h1>Boarding Pass  <i>(Initial)</i></h1>
    <hr>
    @foreach ($roomDetails as $roomInfo)
    <div class="row">
        
            <div class="card" style="width:100%;">
                    <div class="card-header globeDarkBlueBackgroundColor">
                        <h3 class="text-light">Globe University</h3>
                    </div>
                    <div class="card-body">
                        <table>
                            <td class="align-top" style="width:60%;">
                                <h1 class="card-text text-uppercase"><b>{{$roomInfo->RoomName}}</b></h1>
                                <h3 class="text-uppercase">{{$lastname}}, {{$firstname}} </h3>
                                <h5 class="text-uppercase">({{$employeeID}}) <br>
                                        {{$groupname}}</h5>
                                <p ></p>
                                <br>
                                <br>
                                <h5 class="card-text">Reference ID:<b> {{$random}}</b></h5>
                                <p> Note: <i>For your convenience, your reference number is posted above in cases when you need to edit or cancel your 
                                        reservation. Your reference number must be presented on the of day its reservation.</i> </p>
                            </td>
                            <td class="align-top">
                                    <p> Reservation Sched: </p>
                                    <h3><b>{{$startDateNext}} - {{$endDateNext}}</b></h3>
                                <p> Time: <b>{{$reserveStartTime}} - {{$reserveEndTime}}</b>
                                <br>
                                <br>
                                Title: <b>{{$title}}</b><br>
                                Type: <b><span class="">{{$roomInfo->SetupName}}</span></b><br>
                                Pax: <b><span class="">{{$capacity}}</span></b><br>
                                <br><br>
                                Person-In-Charge: {{$personInCharge}} <br>
                                Person-In-Charge Contact: {{$personInChargeContact}} <br>
                                Person-In-Charge Email: {{$personInChargeEmail}}<br>
                            
                            </p>
                            </td>
                        </table>
                        

                    </div>
                  </div>
       
    </div>
    <br>

    <div class="row">
    
        
        <div class="col-7">
            
            <h3>Additional Information</h3>
            
            <input type="text" value="{{$firstname}}" name="firstname" hidden>
            <input type="text" value="{{$middlename}}" name="middlename" hidden>
            <input type="text" value="{{$lastname}}" name="lastname" hidden>
            <input type="text" value="{{$employeeID}}" name="employeeID" hidden>
            <input type="text" value="{{$groupname}}" name="groupname" hidden>
            <input type="text" value="{{$email}}" name="email" hidden>
            <input type="text" value="{{$phone}}" name="phone" hidden>
            <input type="text" value="{{$title}}" name="title" hidden>
            <input type="time" value="{{$reserveStartTime}}" name="reserveStartTime" hidden>
            <input type="time" value="{{$reserveEndTime}}" name="reserveEndTime" hidden>
            <input type="number" value="{{$random}}" name="random" hidden>
            <input type="number" value="{{$roomInfo->RoomPerSetupID}}" name="roomSetupID" hidden>
            <input type="date" value="{{$startDateNext}}" name="startDateNext" hidden >
            <input type="date" value="{{$endDateNext}}" name="endDateNext" hidden>
            <input type="number" value="{{$capacity}}" name="pax" hidden>
            <input type="text" value="{{$roomInfo->RoomName}}" name="roomName" hidden><input type="text" value="{{$personInCharge}}" name="personInCharge" hidden>
            <input type="email" value="{{$personInChargeEmail}}" name="personInChargeEmail" hidden>
            <input type="text" value="{{$personInChargeContact}}" name="personInChargeContact" hidden>
            <input type="text" value="{{$specialInstructions}}" name="instructions" hidden>
            <input type="text" value="{{$items}}" name="items" hidden>
            
            
            <div class="row">
                <div class="col-sm-6">
                <table class="table">
                    <tr>
                        <th class="text-uppercase text-white globeDarkBlueBackgroundColor" style="text-align: center;" colspan="2">Other Information</th>
                    </tr>
                    <tr>
                        <th>Additional Items: </th>
                        <td>{{$items}}</td>
                    </tr>
                    <tr>
                        <th>Remarks: </th>
                        <td>{{$specialInstructions}}</td>
                    </tr>
                    
        
                    
                </table>
                </div>
        
            </div> 
            <br>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                    Reserve
                </button>
            </div>
            
                <br>
                
            <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                          
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h2 class="modal-title">Terms and Conditions</h2>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                          
                                <!-- Modal body -->
                            <div class="modal-body">
                                <h5><b>Please Come in Time</b></h5>
                                <p>Failure to come after 30 mins of the reserved time, the room will be released to accommodate other requesters.</p>
                                <h5><b>Food Policy</b></h5>
                                <p>We have a one catering policy, kindly coordinate directly with:</p>
                                <ul>
                                    <table class="table">
                                        <tr>
                                            <th>Caterer:</th>
                                            <td>Brice Kitchen</td>
                                        </tr>
                                        <tr>
                                            <th>Contact Person:</th>
                                            <td>Louis Brandee Sebial</td>
                                        </tr>
                                        <tr>
                                            <th>Email:</th>
                                            <td>bricekitchen@gmail.com</td>
                                        </tr>
                                        <tr>
                                            <th>Contact #:</th>
                                            <td>09178803117</td>
                                        </tr>
                                    </table>
                                </ul>
                                <p>We have a one catering policy, kindly coordinate directly with:</p>
                                <ul>
                                    <table class="table">
                                        <tr>
                                            <th>Breakfast:</th>
                                            <td>7:30 AM – 8:45 AM
                                                    (No breakfast will be served beyond the given time)</td>
                                        </tr>
                                        <tr>
                                            <th>Lunch:</th>
                                            <td>12:00 NN – 1:00 PM
                                                    (11:30 A.M. – For announced early lunch)</td>
                                        </tr>
                                        <tr>
                                            <th>Afternoon Snacks:</th>
                                            <td>3:00 PM – 3:30 PM</td>
                                        </tr>
                                             
                                    </table>
                                </ul>
                                 <ul>
                                    <li>Ordering food from vendors not accredited by Globe University is not allowed</li> 
                                    <li>Ordered food from outside are strictly prohibited within the Globe University premises.</li>
                                    <li>Non-spill proof cups/mugs/glasses are also prohibited.</li>
                                    <li>Strictly follow the lunch schedule provided on the training day in order to avoid long queues during lunch break. </li>

                                 </ul>

                                <h5><b>CLAYGO (Clean-As-You-Go) Policy.</b></h5>
                                <p>Maintain the cleanliness of your rooms all the time.</p>
                                <h5><b>Room set-up:</b></h5>
                                <p>Should there be any changes in the room set-up please coordinate with Globe University at least two days prior training date.</p>
                                <h5><b>Air-con usage beyond 5:00 pm and on weekends (Sat/Sun): </b></h5>
                                <p>Advise ahead of time and will be subject for charging on the requestor’s cost center.</p>
                                <div class="alert alert-danger">
                                        Please inform Globe University Helpdesk for cancellation of rooms at least one (1) week before the date of the event. Failure to do so, we’ll mark you as least prioritized on your next reservation.
                                </div>
                            </div>
                          
                                <!-- Modal footer -->
                            <div class="modal-footer">
                            {{Form::submit('I accept',['class'=>'btn btn-primary'])}}
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                          
                    </div>
            </div>
        </div>
                    
                
                
                {!! Form::close() !!}
    </div>
            
            
        @endforeach
    </div>


    
    @else
        <div class="alert alert-danger">
            No rooms found.
        </div>
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
