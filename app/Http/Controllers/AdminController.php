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
use App\Waitlist;
use App\Groups;
use App\Divisions;
use App\Departments;
use App\Sections;
use App\Employee_data;

use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home() {
        $employee = DB::select("SELECT res.referenceID as 'ReferenceID',res.title as 'Title',ed.employeeID as 'EmployeeID',
         concat(ed.lastname,', ', ed.firstname) as 'EmployeeName',
         ed.email as 'Email',res.personInCharge as 'PersonInCharge',
         res.personInChargeEmail as 'PersonInChargeEmail', g.name as 'Group',
         r.name as 'Room',r.picture as 'RoomPicture', s.name as 'Setup',
         res.pax as 'Pax',res.reserveStartDate as 'ReserveStartDate',
         res.reserveEndDate as 'ReserveEndDate',res.reserveStartTime as 'ReserveTStartTime',
         res.reserveEndTime as 'ReserveEndTime'
        FROM reservations res, employee_datas ed, groups g,room_per_setups rps, rooms r,setups s 
        WHERE res.employeeID = ed.employeeID and ed.groupID = g.id and res.roomPerSetUpID = rps.id and rps.roomID = r.id and rps.setupID = s.id 
        order by res.reserveStartDate,res.reserveStartTime");

        $items = Setup::pluck('name','id');

        $todaySchedule = DB::select("SELECT d.day as 'Day', rm.name as 'RoomName',rm.picture as 'RoomPicture',
        s.name as 'Setup', d.startTime as 'StartTime', d.endTime as 'EndTime', r.title as 'Title',
        r.referenceID as 'ReferenceID',ed.employeeID as 'EmployeeID',concat(ed.lastname,', ',ed.firstname) as 'Name',
        g.name as 'GroupName',r.pax as 'Pax' 
        FROM `days` d, reservations r, room_per_setups rs, rooms rm,setups s, employee_datas ed, groups g 
        WHERE d.day = curdate() and d.referenceID = r.referenceID and r.roomPerSetUpID = rs.id and rm.id = rs.roomID and s.id = rs.setupID and r.employeeID = ed.employeeID and ed.groupID = g.id");

        $schedule = DB::select("SELECT r.referenceID as 'ReferenceID' ,r.reserveStartDate as 'StartDate' ,r.reserveEndDate as 'EndDate', ro.name as 'RoomName', r.title as 'Title' FROM `reservations` r, room_per_setups rs, rooms ro WHERE r.roomPerSetUpID = rs.id and rs.roomID = ro.id");

        return view('admin.home')->with(compact('employee','todaySchedule','items','schedule'));
    }
    public function adminMatch(Request $request) {
        $rooms = Room::all();
        $roomspersetups = RoomPerSetup::all();
        $setups = Setup::all();

        //Data Validation
        $fillable = $request->validate([
            'reserveStartTime' =>'required',
            'reserveEndTime' => 'required',
            'reserveStartDate' => 'required|date|before_or_equal:reserveEndDate|after:yesterday',
            'reserveEndDate' => 'required|date|after_or_equal:reserveStartDate|after:yesterday',
            'setup'=> 'required',
            'pax' => 'required|numeric'
        ]);

        

        //Gather Inputs
        $firstname = "Globe";
        $lastname = "University";
        $middlename = "GU";
        $employeeID = "00000";
        $groupname = "Human Resources";
        $email = "globeuniversity@globe.com.ph";
        $phone = "N/A"; 

        //Gather time
        $reserveStartTime = $request->input('reserveStartTime');
        $reserveEndTime = $request->input('reserveEndTime');

        //Gather date
        $startDateNext = $request->input('reserveStartDate');
        $endDateNext = $request->input('reserveEndDate');
        $setupNext = $request->input('setup');
        $capacity = $request->input('pax'); // Gather 

        //Return the reserved rooms schedule ====================ORIGINAL QUERY=====================
        /*$room_availabilitys = DB::table('days')
        ->select('rooms.id as RoomID','days.day as Day','rooms.name as roomName')
        ->join('reservations','reservations.referenceID','=','days.referenceID')
        ->join('room_per_setups','room_per_setups.id','=','reservations.roomPerSetupID')
        ->join('rooms','rooms.id','=','room_per_setups.roomID')
        ->whereBetween('day',[$startDateNext,$endDateNext])
        ->get();*/

        //Return the reserved rooms schedule ==========!!!!! FINAL QUERY !!!!!!=============
        $listReserved = DB::table('days')
        ->select('rooms.id as RoomID')
        ->distinct('rooms.id')
        ->join('reservations','reservations.referenceID','=','days.referenceID')
        ->join('room_per_setups','room_per_setups.id','=','reservations.roomPerSetupID')
        ->join('rooms','rooms.id','=','room_per_setups.roomID')
        ->whereBetween('day',[$startDateNext,$endDateNext])
        ->get();

        //return $listReserved;
        //Return the list of rooms of GU ====================ORIGINAL QUERY=====================
        /*$results = DB::select("SELECT distinct  rs.id as 'RoomSetupID',rs.capacity as 'Capacity', r.id as 'RoomID',r.name as 'RoomName',r.picture as 'Picture'
        FROM `room_per_setups` rs, rooms r, setups s 
        where rs.roomID = r.id and rs.capacity >= ".$capacity." and rs.setupID = s.id");*/


        //Return the list of rooms of GU ==========!!!!! FINAL QUERY !!!!!!=============
        $results = DB::select("SELECT rs.id as 'RoomSetupID',r.id as 'RoomID',r.name as 'RoomName',s.name as 'Setup',r.picture as 'Picture',rs.capacity as 'Capacity'
        FROM `room_per_setups` rs, rooms r, setups s 
        where rs.roomID = r.id and rs.setupID = s.id and s.id = ".$request->input('setup')." and capacity >= ".$capacity."  
        order BY abs(capacity-".$capacity.")");

        
        //===================ORIGINAL FOREACH=================
        /*foreach($room_availabilitys as  $room_availability){
            foreach($results as $result) {
                if ($room_availability->Day == $startDateNext || $room_availability->Day == $endDateNext ){
                    //If the room is available, add to available rooms list
                    if ( $room_availability->RoomID != $result->RoomID ) { 
                       array_push($availablerooms,$result);
                    }
                    else { 
                        //array_push($takenrooms,$result);
                        unset($array[$result]);
                    }
                } 
                $i++;
            }
        }*/


        //Removes The Reserved Rooms and Retains the Available
        foreach($listReserved as $listReserveds){
            foreach($results as $elementKey => $element) {
                foreach($element as $valueKey => $value) {
                    if($valueKey == 'RoomID' && $value == $listReserveds->RoomID){
                        //delete this particular object from the $array
                        unset($results[$elementKey]);
                    } 
                }
            }
        }
        
        return view('users.reserve.available')->with(compact('reserveStartTime','reserveEndTime','firstname','lastname','middlename','employeeID','groupname','email','phone','startDateNext','endDateNext','setupNext','capacity','recommendedroom','rooms','roomspersetups','setups','searches','searchesclassroom','searchescluster','searchestheater','searchesboard','results','uniqueAvailable'));


    }
    public function allReservations(Request $request) {

        $todaySchedule = DB::select("SELECT d.day as 'Day', rm.name as 'RoomName',rm.picture as 'RoomPicture',
        s.name as 'Setup', d.startTime as 'StartTime', d.endTime as 'EndTime', r.title as 'Title',
        r.referenceID as 'ReferenceID',ed.employeeID as 'EmployeeID',concat(ed.lastname,', ',ed.firstname) as 'Name',
        g.name as 'GroupName',r.pax as 'Pax' 
        FROM `days` d, reservations r, room_per_setups rs, rooms rm,setups s, employee_datas ed, groups g 
        WHERE d.day = curdate() and d.referenceID = r.referenceID and r.roomPerSetUpID = rs.id and rm.id = rs.roomID and s.id = rs.setupID and r.employeeID = ed.employeeID and ed.groupID = g.id");

        return view('admin.reservation.all-today');
    }


    public function manualReserveStepOne(){
        $items = Setup::pluck('name','id');
        return view('admin.reserveManual.stepone')->with(compact('items'));
    }

    public function manualReserveStepTwo(Request $request) {

        $fillable = $request->validate([
            'reserveStartTime' =>'required',
            'reserveEndTime' => 'required',
            'reserveStartDate' => 'required|date|before_or_equal:reserveEndDate|after:yesterday',
            'reserveEndDate' => 'required|date|after_or_equal:reserveStartDate|after:yesterday'
        ]); 

        //Basic Info of Globe University.
        $firstname = "Globe";
        $lastname = "University";
        $middlename = "GU";
        $employeeID = "00000";
        $groupname = "Human Resources";
        $email = "globeuniversity@globe.com.ph";
        $phone = "N/A";

        //Gather time
        $reserveStartTime = $request->input('reserveStartTime');
        $reserveEndTime = $request->input('reserveEndTime');

        //Gather date
        $startDateNext = $request->input('reserveStartDate');
        $endDateNext = $request->input('reserveEndDate');


        //Return the reserved rooms schedule ==========!!!!! FINAL QUERY !!!!!!=============
        $listReserved = DB::table('days')
        ->select('rooms.id as RoomID')
        ->distinct('rooms.id')
        ->join('reservations','reservations.referenceID','=','days.referenceID')
        ->join('room_per_setups','room_per_setups.id','=','reservations.roomPerSetupID')
        ->join('rooms','rooms.id','=','room_per_setups.roomID')
        ->whereBetween('day',[$startDateNext,$endDateNext])
        ->get();


        //Return the list of rooms of GU
        $results = DB::select("SELECT distinct  r.id as 'RoomID',r.name as 'RoomName',r.picture as 'Picture'
        FROM `room_per_setups` rs, rooms r, setups s 
        where rs.roomID = r.id and rs.setupID = s.id");

        
        //Removes The Reserved Rooms and Retains the Available
        foreach($listReserved as $listReserveds){
            foreach($results as $elementKey => $element) {
                foreach($element as $valueKey => $value) {
                    if($valueKey == 'RoomID' && $value == $listReserveds->RoomID){
                        //delete this particular object from the $array
                        unset($results[$elementKey]);
                    } 
                }
            }
        }

        $setup = Setup::pluck('name','id');
        
        return view('admin.reserveManual.steptwo')->with(compact('employeeID','email','firstname','lastname','middlename','groupname','phone','reserveStartTime','reserveEndTime','startDateNext','endDateNext','results','uniqueAvailable','setup'));
    }

    public function manualReserveStepThree(Request $request){
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $middlename = $request->input('middlename');
        $employeeID = $request->input('employeeID');
        $groupname = $request->input('groupname');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $title = $request->input('title');
        $random = time() . rand(4*5, 2*3);
        $roomID = $request->input('roomID');

        $reserveStartTime = $request->input('reserveStartTime');
        $reserveEndTime = $request->input('reserveEndTime');



        $startDateNext = $request->input('reserveStartDate');
        $endDateNext = $request->input('reserveEndDate');
        $setup = $request->input('setup');
        $capacity = $request->input('pax');

        //Added Feature
        if ($request->get('items')!= null){
            $items = implode(", ",$request->get('items'));
        }else {
            $items = 'N/A';
        }

        if ($request->input('instructions')!= null){
            $specialInstructions = $request->input('instructions');
        }else{
            $specialInstructions = 'N/A';
        }
        

        $personInCharge = $request->input('personInCharge');
        $personInChargeContact = $request->input('personInChargeContact');
        $personInChargeEmail = $request->input('personInChargeEmail');

        $roomDetails = DB::select("SELECT rs.id as 'RoomPerSetupID',r.name as 'RoomName', s.name as 'SetupName' ,r.picture as 'roomPicture' FROM `room_per_setups` rs, rooms r, setups s WHERE r.id = rs.roomID and s.id = rs.setupID and rs.roomID = ".$roomID." and rs.setupID = ".$setup."");
        
        
        return view('admin.reserveManual.stepthree')->with(compact('personInCharge','personInChargeContact','personInChargeEmail','items','firstname','lastname','middlename','employeeID','groupname',
            'email','phone','title','random','roomID','reserveStartTime','reserveEndTime','startDateNext','endDateNext',
            'setup','capacity','roomDetails','specialInstructions'));

    }
    public function update(Request $request)
    {
        //
        //Store to Database
        $reservation = Reserve::find($request->input('roomID'));

        $reservation->title = $request->input('title');
        $reservation->reserveStartTime = $request->input('startTime');
        $reservation->reserveEndTime = $request->input('endTime');
        $reservation->personInCharge = $request->input('personInCharge');
        $reservation->personInChargeEmail = $request->input('personInChargeContact');
        $reservation->personInChargeContact = $request->input('personInChargeEmail');
        $reservation->save();

        return 'successful';
    }

    public function cancel(Request $request)
    {
        //
        
        //Store to Database
        $reserve = Reserve::find($request->input('id'));
        $deletedrows = Days::where('referenceID',$reserve->referenceID)->delete();
        
        //find room
        $room = DB::select("SELECT DISTINCT rm.id as 'roomID' FROM reservations r, rooms rm, room_per_setups rs WHERE r.referenceID = ".$reserve->referenceID." and r.roomPerSetUpID = rs.id and rs.roomID = rm.id");
        
        
        $iterateroom = 0;
        foreach($room as $rooms) {
            if ($iterateroom == 0) {
                $roomID = $rooms->roomID;
                
            }
            $iterateroom++;
        }
        //Arrange waitlist
        $waitlist = DB::select("SELECT w.id as 'id',w.groupName as 'groupName',
        w.employeeID as 'employeeID', w.title as 'title',w.roomPerSetUpID as 'roomPerSetUpID',
        w.referenceID as 'referenceID',w.reserveStartDate as 'reserveStartDate',
        w.reserveEndDate as 'reserveEndDate',w.reserveStartTime as 'reserveStartTime',
        w.reserveEndTime as 'reserveEndTime',w.pax as 'pax',w.personInCharge as 'personInCharge',
        w.personInChargeEmail as 'personInChargeEmail',w.personInChargeContact as 'personInChargeContact'

        FROM waitlists w,rooms rm, room_per_setups rs
                    WHERE rm.id = ".$roomID." and 
                    w.reserveStartDate between '".$reserve->reserveStartDate."' and '".$reserve->reserveEndDate."' and 
                    w.reserveEndDate between '".$reserve->reserveStartDate."' and '".$reserve->reserveEndDate."' and 
                    w.roomPerSetUpID = rs.id and rs.roomID = rm.id
                    order by w.created_at,w.updated_at");
        $reserve->delete();

        if (count($waitlist)>0) {
            //Store to Database
            $iterate = 0;
            foreach($waitlist as $waitlists){
                if ($iterate == 0 ) {
                    $waitlistToReserve = new Reserve;

                    $waitlistToReserve->groupName = $waitlists->groupName;
                    $waitlistToReserve->referenceID = $waitlists->referenceID;
                    $waitlistToReserve->employeeID = $waitlists->employeeID;
                    $waitlistToReserve->title = $waitlists->title;
                    $waitlistToReserve->roomPerSetUpID = $waitlists->roomPerSetUpID;
                    $waitlistToReserve->reserveStartDate = $waitlists->reserveStartDate;
                    $waitlistToReserve->reserveEndDate = $waitlists->reserveEndDate;
                    $waitlistToReserve->reserveStartTime = $waitlists->reserveStartTime;
                    $waitlistToReserve->reserveEndTime = $waitlists->reserveEndTime;
                    $waitlistToReserve->pax = $waitlists->pax;
                    $waitlistToReserve->personInCharge = $waitlists->personInCharge;
                    $waitlistToReserve->personInChargeEmail = $waitlists->personInChargeEmail;
                    $waitlistToReserve->personInChargeContact = $waitlists->personInChargeContact;
                    $waitlistToReserve->save();

                    $waitlistReference = $waitlists->referenceID;
                    //Store to days
                    $start = new DateTime($waitlistToReserve->reserveStartDate); // Start Date Variable
                    $end = new DateTime($waitlistToReserve->reserveEndDate); // End Date Variable
                    $oneday = new DateInterval("P1D");

                    $days = array();

                    // Iterate from $start up to $end+1 day, one day in each iteration.
                    //   We add one day to the $end date, because the DatePeriod only iterates up to,
                    //   not including, the end date.
                    foreach(new DatePeriod($start, $oneday, $end->add($oneday)) as $day) {
                        $day_num = $day->format("N"); // 'N' number days 1 (mon) to 7 (sun)
                        if($day_num < 6) { // weekday
                            //$days[$day->format("Y-m-d")] = $data;
                            $days=$day->format("Y-m-d");

                            $daysReserve = new Days;
                            $daysReserve->Day = $day->format("Y-m-d");
                            $daysReserve->startTime = $waitlists->reserveStartTime;
                            $daysReserve->endTime = $waitlists->reserveEndTime;
                            $daysReserve->referenceID = $waitlistReference;
                            $daysReserve->save();

                            // echo $days . '<br>';
                        } 
                    }  
                    $deletedwaitlist = Waitlist::where('referenceID',$waitlistReference)->delete();
                    $iterate++;
                }
            }
        }

        
        return view('pages.employee')->with('success','Sucessfully Updated');
    }
}
 