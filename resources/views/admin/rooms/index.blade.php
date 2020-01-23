@extends('layouts.appAdmin')
 
@section('content')

    <style>
            @import url(https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300);
            html {
            scroll-behavior: smooth;
            }
    .homeHeader {
        top: 0;
        height:100vh;
        width:100%;
        position: absolute;
    }
    </style>
<div class="container">

    
    

    <div class="jumbotron text-white" style="position:relative; background: linear-gradient(to right,
    rgba(0,0,0,0.8),
    rgba(67, 54, 117, 0.8),
    rgb(26, 94, 121)),
    url('{{asset('/images/stock/stock10.jpg')}}') no-repeat center !important;background-size: cover !important;position:float;">
        <h1 class="display-4">Manage Rooms</h1>
        <p class="lead">View, edit and delete rooms from the scope of the Globe University Studio Reservation System.</p>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="rooms/create" role="button">Add Room</a>
        </p>
    </div>
                <h3 class ="py-2">Globe University Campus Rooms</h3>
                <div class="card-deck">
                    @if(count($room)>=1)
                    <?php $i = 1; ?>
                        @foreach($room as $rooms)
                        
                            <div class="col-sm-4">
                                <div class=" text-center globeDarkBlueBackgroundColor text-white">
                                    <img class="card-img-top" src="{{asset('mystorage/images/'.$rooms->picture.'') }}" alt="Card image cap" style="height:auto%;width:100%;">
                                    <div class="card-body">
                                        <h2 class="card-title text-uppercase">{{$rooms->name}}</h2>
                                        <p class="card-text">
                                            @if(count($roomPerSetup) > 0)
                                                @foreach($roomPerSetup as $roomPerSetups)
                                                    @if ($roomPerSetups->roomID == $rooms->id)
                                                        @if(count($setup)>0)
                                                            @foreach($setup as $setups)
                                                                @if ($setups->id == $roomPerSetups->setupID)
                                                                {{$setups->name}}: {{$roomPerSetups->capacity}}<br>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @endif
                                            
                                        </p>
                                            
                                    </div>
                                    <div class="card-footer">
                                        <a href="{{route('rooms.show',$rooms->id)}}" class="btn btn-success" style="width:30%;">View</a>
                                        <a href="{{route('rooms.edit',$rooms->id)}}" class="manual-optin-trigger btnfont" data-optin-slug="atefh5rvxazforll"><button type="button" class="btn btn-primary" style="width:30%;">Edit</button></a>
                                        {!!Form::open(['action'=>['RoomsController@destroy',$rooms->id],'method'=>'POST'])!!}
                                        {{Form::hidden('_method','DELETE')}}
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#recommendedRoom<?php echo $i ?>">
                                                Delete
                                            </button>
                                        <div class="modal fade" id="recommendedRoom<?php echo $i ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                        Are you sure you want to delete the room?
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                {{Form::submit('Delete',['class'=>'btn btn-danger text-uppercase'])}}  
                                                {!! Form::close() !!}         
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        {!!Form::close()!!}
                                            
                                    </div>
                                </div>
                                <br>
                            </div>
                            <?php $i++;  ?> 
                        @endforeach
                    @endif


                </div>
              
    </div>

    
</div>
@endsection
