<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reserve;
use DB;
use App\Room;
use App\RoomPerSetup;
use App\Setup;
use DateTime;
use DatePeriod;
use DateInterval;
use App\Days;


use App\Groups;
use App\Divisions;
use App\Departments;
use App\Sections;
use App\Employee_data;

class PagesController extends Controller
{
    //
    public function start () {
        return view('pages.start');
    }


    public function index () {
        return view('pages.index');
    }

    public function about () {
        return view('pages.about');
    }
     
    public function search(Request $request) {

        $fillable = $request->validate([
            'referenceID' => 'required'
        ]);
        
        $referenceID = $request->input('referenceID');

        $item = $reservations = DB::select("call searchReferenceID (?)",[$referenceID]);
        foreach($item as $items){
            $reservations = Reserve::find($items->reservationID);
        }
        
        //Rooms
        $roomPerSetup = RoomPerSetup::all();
        $room = Room::all();
        //Employee Data
        $employee_data = Employee_data::all();
        $groups = Groups::all();
    //now get all user and services in one go without looping using eager loading
    //In your foreach() loop, if you have 1000 users you will make 1000 queries

    

    return view('users.search.index')->with(compact('item','reservations','groups','roomPerSetup','room','employee_data'));
    }

}
