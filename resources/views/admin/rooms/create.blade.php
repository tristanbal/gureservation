@extends('layouts.appAdmin')

@section('content')

        {!! Form::open(['action'=> 'RoomsController@store','method'=>'POST','enctype' => 'multipart/form-data']) !!}
            <!--Form Start-->
            

            
            <div class="container">
                <div class="display-4"> 
                Add Room
                </div>
                <div class="row">
                    <div class="col-8">
                        {{Form::label('image','Picture:')}}
                        {{Form::file('image')}}      
                    </div>
                </div>
                <div class="row">
                        <div class="col-8">
                                {{Form::label('roomID','Room ID:')}}
                                @if(count($newRoomID)>=1)
                                @foreach ($newRoomID as $newRoomID)
                                <input type="number" name="roomID" class="form-control" value="{{$newRoomID->NewID+1}}" readonly>
                                @endforeach
                                @endif
                        </div>
                    </div>
                <div class="row">
                        <div class="col-8">
                            {{Form::label('roomname','Room Name:')}}
                            <input type="text" class="form-control" placeholder="Ex. Studio 1, Collaborate" name="roomname" required>
                        </div>
                </div>
                <div class="row">
                    <div class="col-8">
                            {{Form::label('description','Description:')}}
                            <input type="text" class="form-control" placeholder="Ex. sample description" name="description" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        {{Form::label('classroomcapacity','Classroom Capacity:')}}
                        <input type="number" class="form-control" value="10" name="classroomcapacity" required>
                        
                    </div>
                    <div class="col-6">
                            {{Form::label('clustercapacity','Cluster Capacity:')}}
                            <input type="number" class="form-control" value="10" name="clustercapacity" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        {{Form::label('theatercapacity','Theater Capacity:')}}
                        <input type="number" class="form-control" value="10" name="theatercapacity" required>
                    </div>
                    <div class="col-6">
                        {{Form::label('boardcapacity','Board Room Capacity:')}}
                        <input type="number" class="form-control" value="10" name="boardcapacity" required>
                    </div>
                </div><br>
                {{Form::submit('Add Room',['class'=>'btn btn-primary','name'=>'insert'])}}  
            </div>
        
        <br>
            
    
        {!! Form::close() !!}

@endsection
