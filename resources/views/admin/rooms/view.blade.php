@extends('layouts.appAdmin')
 
@section('content')
<div class="container">
    <div class="panel-heading"> 
        <div class="display-4 text-uppercase"><b>Studio Name:</b> {{$room->name}}</div>   
            <hr>
            <div class="row">
                <div class="col-sm-7">
                    <div class="row">
                        <div class="col-sm-12">
                            <h5 class="text-uppercase"><b>Description:</b> {{$room->description}}</h5>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                            <table class="table">
                                <thead class="globeDarkBlueBackgroundColor text-white">
                                    <tr>
                                    <th scope="col">Setup</th>
                                    <th scope="col">Capacity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($roomPerSetup) > 0)
                                        @foreach($roomPerSetup as $roomPerSetups)
                                            @if ($roomPerSetups->roomID == $room->id)
                                                @if(count($setup)>0)
                                                    @foreach($setup as $setups)
                                                        @if ($setups->id == $roomPerSetups->setupID)
                                                        <tr>
                                                            <td>{{$setups->name}}:</td> 
                                                            <td>{{$roomPerSetups->capacity}}</td>
                                                        </tr>
                                                        
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endif
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        
                    </div>
                </div>
                <div class="col-sm-5">
                        <img class="" src="{{asset('mystorage/images/'.$room->picture.'') }}" alt="Card image cap" style="height:auto%;width:100%;">
                </div>
                
                
            </div>

            <h3 class="text-uppercase"><b>STUDIO SETUP</b></h3>

            <div class="row">
                <div class="col-sm-3">
                    <h5> Classroom </h5>
                    <img class="" src="{{asset('mystorage/images/Classroom_Black.png') }}" alt="Card image cap" style="height:auto%;width:100%;">
                </div>
                <div class="col-sm-3">
                    <h5> Cluster </h5>
                    <img class="" src="{{asset('mystorage/images/Cluster_Black.png') }}" alt="Card image cap" style="height:auto%;width:100%;">
                </div>
                <div class="col-sm-3">
                    <h5> Theater </h5>
                    <img class="" src="{{asset('mystorage/images/Theater_Black.png') }}" alt="Card image cap" style="height:auto%;width:100%;">
                </div>
                <div class="col-sm-3">
                    <h5> Boardroom </h5>
                    <img class="" src="{{asset('mystorage/images/Boardroom_Black.png') }}" alt="Card image cap" style="height:auto%;width:100%;">
                </div>

            </div>
        <br>
        <br>
        <br>
        </div>
    </div>
</div>
@endsection
