@extends('layouts.appAdmin')
 
@section('content')
<div class="container">
    <div class="panel-heading"> 
        {{ Form::open(array('url'=> route('rooms.update',$room))) }}
        {{ csrf_field() }}
        {{ method_field('PUT')}}  
        <div class="display-4 text-uppercase">Edit Studio Information</div>   
            <hr>
           
            <div class="row">
                <div class="col-sm-7">
                    <div class="row">
                        <div class="col-sm-12">
                            {{Form::label('roomname','Room Name:')}}
                            <input type="text" class="form-control" value="{{$room->name}}" placeholder="Ex. Studio 1, Collaborate" name="roomname" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            {{Form::label('description','Description:')}}
                            
                            <textarea class="form-control" rows="3" placeholder="description" name="description">{{$room->description}}</textarea>
                        </div>
                    </div>

                    @if(count($roomPerSetup) > 0)
                        @foreach($roomPerSetup as $roomPerSetups)
                            @if ($roomPerSetups->roomID == $room->id)
                                @if(count($setup)>0)
                                    @foreach($setup as $setups)
                                        @if ($setups->id == $roomPerSetups->setupID)
                                            {{Form::label('setup',$setups->name.' Capacity:')}}    
                                            <input type="number" class="form-control" value="{{$roomPerSetups->capacity}}" placeholder="Ex. Studio 1, Collaborate" name="{{$setups->name}}" required>
                                        @endif
                                    @endforeach
                                @endif
                            @endif
                        @endforeach
                    @endif

                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                        {{Form::submit('Update Studio',['class'=>'btn btn-success'])}}
                        <a href="{{route('rooms.index')}}" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>

                </div>
                <div class="col-sm-5">
                        <img class="" src="{{asset('mystorage/images/'.$room->picture.'') }}" alt="Card image cap" style="height:auto%;width:100%;">
                </div>
                
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection
