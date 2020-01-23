<?php

namespace App\Http\Controllers;

use Redirect;
use Illuminate\Http\Request;
use DB;
use App\Room;
use App\Roompersetup;
use App\Setup;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $room = Room::all();
        $roomPerSetup = RoomPerSetup::all();
        $setup = Setup::all();

        $ClassroomPerSetup = DB::select("SELECT rs.id as 'RoomSetupID',r.picture as 'Picture',r.id as 'RoomID', r.name as 'RoomName',s.name as 'Setup',rs.capacity as 'Capacity' 
        FROM `room_per_setups` rs, rooms r, setups s
               where rs.roomID = r.id and rs.setupID = s.id and setupID =1");
        
        $ClusterPerSetup = DB::select("SELECT rs.id as 'RoomSetupID',r.picture as 'Picture',r.name as 'RoomName',s.name as 'Setup',rs.capacity as 'Capacity' 
        FROM `room_per_setups` rs, rooms r, setups s
               where rs.roomID = r.id and rs.setupID = s.id and setupID =2");

        $TheaterPerSetup = DB::select("SELECT rs.id as 'RoomSetupID',r.picture as 'Picture',r.name as 'RoomName',s.name as 'Setup',rs.capacity as 'Capacity' 
        FROM `room_per_setups` rs, rooms r, setups s
            where rs.roomID = r.id and rs.setupID = s.id and setupID =3");

        $BoardPerSetup = DB::select("SELECT rs.id as 'RoomSetupID',r.picture as 'Picture',r.name as 'RoomName',s.name as 'Setup',rs.capacity as 'Capacity' 
        FROM `room_per_setups` rs, rooms r, setups s
            where rs.roomID = r.id and rs.setupID = s.id and setupID =4");


        return view('admin.rooms.index')->with(compact('room','roomPerSetup','setup','ClassroomPerSetup','ClusterPerSetup','TheaterPerSetup','BoardPerSetup'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $newRoomID = DB::select("SELECT id as 'NewID' FROM `rooms` order by id desc limit 1");
        return view('admin.rooms.create')->with('newRoomID',$newRoomID);

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'roomID' => 'required',
            'roomname' => 'required',
            'description' => 'required',
            'classroomcapacity' => 'required',
            'clustercapacity' => 'required',
            'theatercapacity' => 'required',
            'boardcapacity' => 'required',
            'image' => 'image|nullable'
        ]);

        if($request->hasFile('image')){
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/images',$fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.png';
        }


        $rooms = new Room;
        //$roomPerSetup = new RoomPerSetup;
        $classroomSetup = new RoomPerSetup;
        $clusterSetup = new RoomPerSetup;
        $theaterSetup = new RoomPerSetup;
        $boardSetup = new RoomPerSetup;

        $rooms->name = $request->input('roomname');
        $rooms->description = $request->input('description');
        $rooms->picture = $fileNameToStore;
        $rooms->save();

        $classroomSetup->capacity = $request->input('classroomcapacity');
        $classroomSetup->roomID = $request->input('roomID');
        $classroomSetup->setupID = 1;
        $clusterSetup->capacity = $request->input('clustercapacity');
        $clusterSetup->roomID = $request->input('roomID');
        $clusterSetup->setupID = 2;
        $theaterSetup->capacity = $request->input('theatercapacity');
        $theaterSetup->roomID = $request->input('roomID');
        $theaterSetup->setupID = 3;
        $boardSetup->capacity = $request->input('boardcapacity');
        $boardSetup->roomID = $request->input('roomID');
        $boardSetup->setupID = 4;

        
        $classroomSetup->save();
        $clusterSetup->save();
        $theaterSetup->save();
        $boardSetup->save();

        return redirect('/')->with('success','Schedule Reserved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $room = Room::find($id);
        $roomPerSetup = RoomPerSetup::all();
        $setup = Setup::all();
        
        return view('admin.rooms.view')->with(compact('room','roomPerSetup','setup'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $roomPerSetup = RoomPerSetup::all();
        $room = Room::find($id);
        $setup = Setup::all();
        
        return view('admin.rooms.edit')->with(compact('room','roomPerSetup','setup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if ($request->input('description')== null){
            $description = 'N/A';
        } else {
            $description = $request->input('description');
        }

        $room = Room::find($id);
        $room->name = $request->input('roomname');
        $room->description = $description;
        $room->save();

        //return $roomPerSetup;
        return Redirect::back()->with('success','Sucessfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $room = Room::find($id);
        $room->delete();
        return Redirect::back()->with('success','Sucessfully Deleted');
    }
}
