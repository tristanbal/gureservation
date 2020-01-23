@extends('layouts.appAdmin')

@section('content')

<style>
    .carousel-control-prev-icon {
    background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='black' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E");
}

.carousel-control-next-icon {
    background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='black' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E");
}

/* New Box */

.box {
  position: relative;
  width: 100%;
}

.myImage {
  display: block;
  width: 100%;
  height: auto;
}

.overlay {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  background-color: black ;
  overflow: hidden;
  width: 100%;
  height: 100%;
  transition: .5s ease;
  opacity:0.7;
}



.box:hover .overlay {
  height: 100%;
  opacity:1.0;
}
 
.myText {
  color: white;
  /*font-size: 20px;*/
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  /*text-align: center;*/
}

.boxOnTimeKeeping {
    background-color: #31092e !important;
}

/* My button */
.hr-button {
    background:none;
    border:1;
    color:white;
}

</style>



<div class="container">
    

    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <div class="display-3 text-uppercase">Welcome Back</div>
    <br>

    @if(count($todaySchedule)>0)
        <h3>Today's Reservations</h3>
    @else
    @endif

    <div class="row">
        <div class="col-sm-12 ">
            <?php $i=0 ?>
            
            @if(count($todaySchedule)>0)
                <div id="myCarousel" class="carousel slide " data-ride="carousel" style="padding:0px;">
                    <div class="carousel-inner globeDarkBlueBackgroundColor text-white" >  
                        @foreach($todaySchedule as $todaySchedules)
                        <?php if ($i >= 3 ) {break;} else {?>
                        <div class="<?php if ($i==0) { ?> carousel-item active<?php } else {?>carousel-item<?php }?>">
                            <div class="row">
                                <div class="col-sm-8" style="padding:0px;">
                                    <img class="card-img-top" src="{{asset('mystorage/images/'.$todaySchedules->RoomPicture.'') }}" alt="Card image cap" style="width:100%;">
                                </div>
                                <div class="col-sm-4">
                                    <div style="margin:10px;" style="padding:0px;">
                                    <h2 class="text-uppercase"><b>{{$todaySchedules->RoomName}} </b><br></h2><h1> <i>{{$todaySchedules->Title}}</i></h1>
                                    <h5 class="card-title text-uppercase">{{$todaySchedules->Name}}</h5>
                                    <hr>
                                    <div style="bottom:0;">
                                    <p class="card-text"><b>Start Time: {{$todaySchedules->StartTime}}<br>
                                        End Time:</b> {{$todaySchedules->EndTime}}<br>
                                    <b>Pax: </b> {{$todaySchedules->Pax}}<br>
                                    <b>Setup: </b> {{$todaySchedules->Setup}}<br>
                                    <b>Group: </b> {{$todaySchedules->GroupName}}
                                    </p>
                                    <br><br>
                                    <a href="#" class="btn btn-primary" style="width:100%">View Reservation</a>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <?php $i++; } ?>
                        </div>
                        @endforeach
                        <a class="carousel-control-prev dark" href="#myCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <br>
                <script>
                    $(document).ready(function() {
                    $("#myCarousel").on("slide.bs.carousel", function(e) {
                        var $e = $(e.relatedTarget);
                        var idx = $e.index();
                        var itemsPerSlide = 3;
                        var totalItems = $(".carousel-item").length;
    
                        if (idx >= totalItems - (itemsPerSlide - 1)) {
                        var it = itemsPerSlide - (totalItems - idx);
                        for (var i = 0; i < it; i++) {
                            // append slides to end
                            if (e.direction == "left") {
                            $(".carousel-item")
                                .eq(i)
                                .appendTo(".carousel-inner");
                            } else {
                            $(".carousel-item")
                                .eq(0)
                                .appendTo($(this).find(".carousel-inner"));
                            }
                        }
                        }
                    });
                    });
    
    
                </script>
                <!--<h3 class="text-center"><a href="/reservations/today">See All Reservations For Today</a></h3>-->
            
                @else
                    @if(count($schedule)>0)
    
                    <h1>All Reservations</h1>
                    <table class="table">
                        <tr>
                            <th scope="col" class="globePurpleBackgroundColor text-white">Reference ID</th>
                            <th scope="col" class="globePurpleBackgroundColor text-white">Start Date</th>
                            <th scope="col" class="globePurpleBackgroundColor text-white">End Date</th>
                            <th scope="col" class="globePurpleBackgroundColor text-white">Room</th>
                            <th scope="col" class="globePurpleBackgroundColor text-white">Title</th>
                        </tr>
                        <?php $i = 0; ?>
                        @foreach ($schedule as $schedules)
    
                        
                        <?php if ($i >= 10 ) {break;} else {?>
                        <tr>
                            
                            <td class="globeDarkBlueBackgroundColor text-white">{{$schedules->ReferenceID}}</td>
                            <td>{{$schedules->StartDate}}</td>
                            <td>{{$schedules->EndDate}}</td>
                            <td>{{$schedules->RoomName}}</td>
                            <td>{{$schedules->Title}}</td> 
                            
                            
                        </tr>
                        <?php $i++; } ?>
                        @endforeach
                    </table>
                    @else
                        <h1>There are no reservations.</h1>
                    @endif
                @endif
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="card-deck ">
                    <div class="card text-center ">
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
                                        <input type="time" name="reserveStartTime" class="form-control" value="08:00:00" required>
                                    </div>
                                    <div class = "col-6">
                                        {{Form::label('reserveEndTime','End Time:', ['class' => 'text-left text-uppercase'])}}
                                        <input type="time" name="reserveEndTime" class="form-control" value="17:00:00" required>
                                    </div>
                                </div>
                
                                <div class = "row">
                                    <div class = "col-6">
                                        {{Form::label('pax','PAX:')}}
                                        <input type="number" class="form-control" value="10" name="pax" required>
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
        <div class="col-sm-6">
            <div class="card box">
                <img src="{{asset('images/stock/Stock05.jpg')}}" alt="Avatar" class="myImage">
                <div class="overlay">
                    <div class="myText  text-center"><p class="font-weight-bold text-uppercase">Manual Reservation</p>
                    <p class="font-weight-light">Override the reservation process by selecting an available room manually. Available rooms are subject to change depending on the reservation schedules.</p>
                    <a href="{{route('admin/reserve/manual/first')}}" class="btn btn-primary btn-block btn-light globeDarkBlueBackground text-uppercase hr-button">Reserve Manually
                </a></div>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col-sm-3">
            <div class="card box">
                <img src="{{asset('images/stock/Atelier.jpg')}}" alt="Avatar" class="myImage">
                <div class="overlay">
                    <div class="myText  text-center"><p class="font-weight-bold text-uppercase">Manage Admin Accounts</p>
                    <p class="font-weight-light">Authorize Specific Users.</p>
                    <a href="{{route('admin/reserve/manual/first')}}" class="btn btn-primary btn-block btn-light globeDarkBlueBackground text-uppercase hr-button">Manage Admins
                </a></div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card box">
                <img src="{{asset('images/stock/ReservationPaper.jpg')}}" alt="Avatar" class="myImage">
                <div class="overlay">
                    <div class="myText  text-center"><p class="font-weight-bold text-uppercase">Manage Rooms</p>
                    <p class="font-weight-light">Add, Edit or Delete Rooms.</p>
                    <a href="{{route('rooms.index')}}" class="btn btn-primary btn-block btn-light globeDarkBlueBackground text-uppercase hr-button">Manage Rooms
                </a></div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card box">
                <img src="{{asset('images/stock/Stock05.jpg')}}" alt="Avatar" class="myImage">
                <div class="overlay">
                    <div class="myText  text-center"><p class="font-weight-bold text-uppercase">Special Case Reservation</p>
                    <p class="font-weight-light"></p>
                    <a href="/admin/reserve/manual/first" class="btn btn-primary btn-block btn-light globeDarkBlueBackground text-uppercase hr-button">Reserve Manually
                </a></div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card box">
                <img src="{{asset('images/stock/Studio.jpg')}}" alt="Avatar" class="myImage">
                <div class="overlay">
                    <div class="myText  text-center"><p class="font-weight-bold text-uppercase">Manage Reservations</p>
                    <p class="font-weight-light">Switch or Reschedule.</p>
                    <a href="/admin/reserve/manual/first" class="btn btn-primary btn-block btn-light globeDarkBlueBackground text-uppercase hr-button">Reserve Manually
                </a></div>
                </div>
            </div>
        </div>
    </div>
    

    <!--<h3>Reservations and Utilizations</h3>
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
    </div>-->


    <hr>
</div>
<div class="container">
    <h3> Room History </h3>
    <div class="row">
        <div class="col-sm-12">
            @if(count($employee)>0)
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col" class="globePurpleBackgroundColor text-white">Reference ID</th>
                    <th scope="col" class="globePurpleBackgroundColor text-white">Studio</th>
                    <th scope="col" class="globePurpleBackgroundColor text-white">Reservee</th>
                    <th scope="col" class="globePurpleBackgroundColor text-white">Start Date</th>
                    <th scope="col" class="globePurpleBackgroundColor text-white">End Date</th>
                    <th scope="col" class="globePurpleBackgroundColor text-white">Start Time</th>
                    <th scope="col" class="globePurpleBackgroundColor text-white">End Time</th>
                    <th scope="col" class="globePurpleBackgroundColor text-white">Pax</th>
                    <th scope="col" class="globePurpleBackgroundColor text-white">Title</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $f=0; ?>
                
                    @foreach($employee as $employees)
                    <?php if ($f >= 10 ) {break;} else {?>
                        <tr>
                            <td class="globeDarkBlueBackgroundColor text-white">{{$employees->ReferenceID}}</td>
                            <td>{{$employees->Room}}</td>
                            <td>{{$employees->EmployeeName}}</td>
                            <td>{{$employees->ReserveStartDate}}</td>
                            <td>{{$employees->ReserveEndDate}}</td>
                            <td>{{$employees->ReserveTStartTime}}</td>
                            <td>{{$employees->ReserveEndTime}}</td>
                            <td>{{$employees->Pax}}</td>
                            <td>{{$employees->Title}}</td>
                        </tr>
                    
                    <?php $f++; } ?>
                    @endforeach
                    
                </tbody>
            </table>
            @else
            <div class="alert alert-success">
                TBA
            </div>
            @endif
        </div>
    </div>
                        
    <h3> Room History </h3>
    <div class="row">
        <div class="col-sm-12">
            @if(count($employee)>0)
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col" class="globePurpleBackgroundColor text-white">Reference ID</th>
                    <th scope="col" class="globePurpleBackgroundColor text-white">Studio</th>
                    <th scope="col" class="globePurpleBackgroundColor text-white">Reservee</th>
                    <th scope="col" class="globePurpleBackgroundColor text-white">Start Date</th>
                    <th scope="col" class="globePurpleBackgroundColor text-white">End Date</th>
                    <th scope="col" class="globePurpleBackgroundColor text-white">Start Time</th>
                    <th scope="col" class="globePurpleBackgroundColor text-white">End Time</th>
                    <th scope="col" class="globePurpleBackgroundColor text-white">Pax</th>
                    <th scope="col" class="globePurpleBackgroundColor text-white">Title</th>
                    </tr>
                </thead>
                <tbody>
                        <?php $f=0; ?>
                    
                        @foreach($employee as $employees)
                        <?php if ($f >= 10 ) {break;} else {?>
                            <tr>
                                <td class="globeDarkBlueBackgroundColor text-white">{{$employees->ReferenceID}}</td>
                                <td>{{$employees->Room}}</td>
                                <td>{{$employees->EmployeeName}}</td>
                                <td>{{$employees->ReserveStartDate}}</td>
                                <td>{{$employees->ReserveEndDate}}</td>
                                <td>{{$employees->ReserveTStartTime}}</td>
                                <td>{{$employees->ReserveEndTime}}</td>
                                <td>{{$employees->Pax}}</td>
                                <td>{{$employees->Title}}</td>
                            </tr>
                        
                        <?php $f++; } ?>
                        @endforeach
                    
                </tbody>
            </table>
            @else
            <div class="alert alert-success">
                TBA
            </div>
            @endif
        </div>
    </div>
    
    </div>
    </div>

@endsection
