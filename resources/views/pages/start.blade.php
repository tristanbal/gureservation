<html lang="{{config('app.locale')}}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <script src="{{ asset('js/app.js') }}" type="text/javascript" defer></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <title> {{config('app.name','GU Reservation System')}}</title>
</head>
<body >
    
        
<div class="" style="position:relative;height:100vh; background: linear-gradient(to right,
rgba(0,0,0,0.8),
rgba(67, 54, 117, 0.8),
rgb(26, 94, 121)),
url('{{asset('/images/logo/startBG.jpg')}}') no-repeat center !important;background-size: cover !important;">
<div class="container" style="height:100%;">
        
        <div class="row" >
                <div class="col-10">
                    <a href="{{route('/')}}"><img src="{{asset('images/logo/gu_logo_white.png')}}" style="width:15%;">  </a>
                </div>
                

            {!! Form::open(['action'=> 'MatchController@step1_match','method'=>'POST']) !!}
            {{ csrf_field() }}
            
        </div>
           
            @include('inc.messages')
            <br><br>
    <div class="row">
        <div class="col-sm-6">
            <div class="" style="background-color:white;padding:20px;">
                <div class="card-body">
                    @foreach ($employee as $employee)
                    <h1> Welcome {{$employee->firstname}}!<h1><h3> Let's start making your reservation.</h3>
                    <input type="text" value="{{$employee->firstname}}" name="firstname" hidden>
                    <input type="text" value="{{$employee->middlename}}" name="middlename" hidden>
                    <input type="text" value="{{$employee->lastname}}" name="lastname" hidden>
                    <input type="text" value="{{$employee->employeeID}}" name="employeeID" hidden>
                    <input type="text" value="{{$employee->groupname}}" name="groupname" hidden>
                    <input type="text" value="{{$employee->email}}" name="email" hidden>
                    <input type="text" value="{{$employee->phone}}" name="phone" hidden>
                    @endforeach
                    <br>
                    
                    
                    <div class = "row">
                        <div class = "col-sm-6">
                                {{Form::label('reserveStartDate','Start Date:', ['class' => 'text-left text-uppercase'])}}
                                <input type="date" name="reserveStartDate" class="form-control" required>
                        </div>
                        <div class = "col-sm-6">
                                {{Form::label('reserveEndDate','End Date:', ['class' => 'text-left text-uppercase'])}}
                                <input type="date" name="reserveEndDate" class="form-control" required>
                        </div>
                    </div>
                    <div class = "row">
                        <div class = "col-sm-6">
                            {{Form::label('reserveStartTime','Start Time:', ['class' => 'text-left text-uppercase'])}}
                            <input type="time" name="reserveStartTime" class="form-control" value="08:00:00" required>
                        </div>
                        <div class = "col-sm-6">
                            {{Form::label('reserveEndTime','End Time:', ['class' => 'text-left text-uppercase'])}}
                            <input type="time" name="reserveEndTime" class="form-control" value="17:00:00" required>
                        </div>
                    </div>
    
                    <div class = "row">
                        <div class = "col-sm-6">
                            {{Form::label('pax','PAX:')}}
                            <input type="number" name="pax" class="form-control" value="15" required>
                                                <br>    
                            
                        </div>
                        <div class = "col-sm-6">
                                {!! Form::Label('setup', 'Setup:') !!}
                                {!! Form::select('setup', $items, null, ['class' => 'form-control','id'=>'setup']) !!}
                        </div>
                    </div><br>
                    <div class="row">
                            {{Form::submit('Check Studio Availability',['class'=>'btn btn-success btn-block globeDarkBlueBackgroundColor text-uppercase'])}}           
                    </div>
                    
                    {!! Form::close() !!}
    
                </div>
            </div>   
        </div>
        <div class="col-sm-6 text-white" style="padding:20px;background:rgb(0, 0, 0,0.4);">
            <div >
                    <div class="text-center">
                            <div class="card-body">
                                <video class="" alt="Card image cap" style="width:100%" controls>
                                <source src="{{asset('video/GlobeUniversityVirtualTourVideo.mp4')}}" type="video/mp4">
                                </video>
                                <br><br>
                                <h5 class="card-title">Welcome to Globe University</h5>
                                <p class="card-text">Here is a virtual tour of the campus in Globe Telecom Plaza 1, 5F.</p>
                            </div>
                        </div>
            </div>
            
        </div>
    </div>

            
        
    </div>
</div>


<!-- MODALS -->
<!-- Modal -->
<div class="modal fade" id="ClassroomModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Classroom Setup</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>In a Classroom setup, rows of tables are arranged with all participants facing toward the front of the room. This setup is suitable for long trainings and lectures.</p>
          <div class="text-center"><img class="" src="{{asset('mystorage/images/Classroom_Black.png') }}" alt="Card image cap" style="height:auto%;width:80%;"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<div class="modal fade" id="ClusterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cluster Setup</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p>For a Cluster setup, several tables with chairs are spread throughout the room. This setup is appropriate for workshops and small work group participations.</p>
            <div class="text-center"><img class="" src="{{asset('mystorage/images/Cluster_Black.png') }}" alt="Card image cap" style="height:auto%;width:80%;"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>

<div class="modal fade" id="TheaterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Theater Setup</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p>In a Theater setup, rows of chairs (no tables) are arranged with all participants facing toward the front of the room. This setup is ideal for passive learning and general meetings.</p>
            <div class="text-center"><img class="" src="{{asset('mystorage/images/Theater_Black.png') }}" alt="Card image cap" style="height:auto%;width:80%;"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>

<div class="modal fade" id="BoardroomModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Board Room Setup</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p>For a Boardroom setup, tables are arranged together to create a long, elongated table. This setup is favorable for discussions between all participants and conducive for accomplishing shared tasks.</p>
            <div class="text-center"><img class="" src="{{asset('mystorage/images/Boardroom_Black.png') }}" alt="Card image cap" style="height:auto%;width:80%;"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>


  <script>
        $(document).ready(function(){
            $("#setup").on("change", function () {        
                $modal1 = $('#ClassroomModal');
                $modal2 = $('#ClusterModal');
                $modal3 = $('#TheaterModal');
                $modal4 = $('#BoardroomModal');


                if($(this).val() === '1'){
                    $modal1.modal('show');
                }else if($(this).val() === '2'){
                    $modal2.modal('show');
                }else if($(this).val() === '3'){
                    $modal3.modal('show');
                }else if($(this).val() === '4'){
                    $modal4.modal('show');
                }
            });
        });
        
        </script>
    </body>
</html>


