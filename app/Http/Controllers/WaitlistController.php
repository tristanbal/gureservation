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

class WaitlistController extends Controller
{
    //
    public function start(Request $request) {
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $middlename = $request->input('middlename');
        $employeeID = $request->input('employeeID');
        $groupname = $request->input('groupname');
        $email = $request->input('email');
        $phone = $request->input('phone');

        //Gather time
        $reserveStartTime = $request->input('reserveStartTime');
        $reserveEndTime = $request->input('reserveEndTime');

        //Gather date
        $startDateNext = $request->input('reserveStartDate');
        $endDateNext = $request->input('reserveEndDate');
        $setupNext = $request->input('setup');
        $capacity = $request->input('pax'); 

        
        //Return the list of rooms of GU ==========!!!!! FINAL QUERY !!!!!!=============
        $results = DB::select("SELECT rs.id as 'RoomSetupID',r.id as 'RoomID',r.name as 'RoomName',s.name as 'Setup',r.picture as 'Picture',rs.capacity as 'Capacity'
        FROM `room_per_setups` rs, rooms r, setups s 
        where rs.roomID = r.id and rs.setupID = s.id and s.id = ".$request->input('setup')." and capacity >= ".$capacity."  
        order BY abs(capacity-".$capacity.")");

        //return $results;
        //return $recommendedroom;

        return view('users.waitlist.waitlist-index')
        ->with(compact('firstname','lastname','middlename',
        'employeeID','groupname','email','phone','reserveStartTime',
        'reserveEndTime','startDateNext','endDateNext','setupNext','capacity','results'));

    }

    public function initialReserve(Request $request) {
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $middlename = $request->input('middlename');
        $employeeID = $request->input('employeeID');
        $groupname = $request->input('groupname');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $title = $request->input('title');
        $random = time() . rand(4*5, 2*3);

        $reserveStartTime = $request->input('reserveStartTime');
        $reserveEndTime = $request->input('reserveEndTime');

        $roomPerSetupID = $request->input('roomPerSetUp');
        $startDateNext = $request->input('reserveStartDate');
        $endDateNext = $request->input('reserveEndDate');
        $setupNext = $request->input('setup');
        $capacity = $request->input('pax');
        $roomInfo = DB::select ("SELECT rs.id as 'RoomSetupID',r.picture as 'Picture',r.name as 'RoomName',s.name as 'Setup',rs.capacity as 'Capacity' 
        FROM `room_per_setups` rs, rooms r, setups s 
        where rs.roomID = r.id and rs.id= ". $request->input('roomPerSetUp') ." and rs.setupID = s.id ");
        
        return view('users.waitlist.waitlist-initialreserve')->with(compact('title','reserveStartTime','reserveEndTime','random','firstname','lastname','middlename','employeeID','groupname','email','phone','roomPerSetupID','startDateNext','endDateNext','setupNext','capacity','roomInfo','employee','groups'));
    }

    public function addWaitlist(Request $request){
        
        //Gather Inputs
        $roomPerSetupID = $request->input('roomSetupID');
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $middlename = $request->input('middlename');
        $employeeID = $request->input('employeeID');
        $groupname = $request->input('groupname');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $random = $request->input('random');
        $title = $request->input('title');

        $personInCharge = $request->input('personInCharge');
        $personInChargeContact = $request->input('personInChargeEmail');
        $personInChargeEmail = $request->input('personInChargeContact');

        if ( $personInCharge == null || $personInChargeContact == null || $personInChargeEmail == null)
        {
            $personInCharge  = "N/A";
            $personInChargeContact = "N/A";
            $personInChargeEmail = "N/A";
        }
        

        $groupname = "HR Sample";


        //Store to Database
        $reservation = new Waitlist;

        $reservation->groupName = $groupname;
        $reservation->referenceID = $random;
        $reservation->employeeID = $request->input('employeeID');
        $reservation->title = $title;
        $reservation->roomPerSetUpID = $roomPerSetupID;
        $reservation->reserveStartDate = $request->input('startDateNext');
        $reservation->reserveEndDate = $request->input('endDateNext');
        $reservation->reserveStartTime = $request->input('reserveStartTime');
        $reservation->reserveEndTime = $request->input('reserveEndTime');
        $reservation->pax = $request->input('pax');
        $reservation->personInCharge = $personInCharge;
        $reservation->personInChargeEmail = $personInChargeContact;
        $reservation->personInChargeContact = $request->$personInChargeEmail = "N/A";
        $reservation->save();

        //Store to days
        $start = new DateTime($reservation->reserveStartDate); // Start Date Variable
        $end = new DateTime($reservation->reserveEndDate); // End Date Variable
        $oneday = new DateInterval("P1D");

        $days = array();

        

        //Create Receipt
        $employeeID = $request->input('employeeID');
        $title = $request->input('title');
        $roomName = $request->input('roomName');
        $startDate = $request->input('startDateNext');
        $endDate = $request->input('endDateNext');
        $startTime = $request->input('reserveStartTime');
        $endTime = $request->input('reserveEndTime');
        $pax = $request->input('pax');
        $personInCharge = $request->input('personInCharge');
        $personInChargeEmail = $request->input('personInChargeEmail');
        $personInChargeContact = $request->input('personInChargeContact');
        
        // Generate message for mailer
        $msg = "
        Good day! Thank you for reserving a room in Globe University. For your convenience, your reference number is posted below
         in such cases when you need to edit or cancel your reservation. Your reference number must also be presented on the of its
          reservation.\n\n
        Reference Number: ".$random."\n
        Employee ID Registered: ".$employeeID."\n
        \n
        Title: ".$title."\n
        Room Name: ".$roomName."\n
        Reservation Start Date: ".$startDate."\n
        Reservation End Date: ".$endDate."\n
        Reservation Start Time: ".$startTime."\n
        Reservation End Time: ".$endTime."\n
        Pax: ".$pax."\n\n
        Person In Charge\n  
        Name: ".$personInCharge."\n
        Email: ".$personInChargeEmail."\n
        Contact Number: ".$personInChargeContact."\n      
        ";

        // use wordwrap() if lines are longer than 70 characters
        $msg = wordwrap($msg,70);

        // send email
        //mail($request->input('personInChargeEmail'),"Confirmation: Globe University Studio Reservation",$msg);

        //return to view
        return view('users.reserve.success')->with(compact('random','employeeID','title','roomName','startDate','endDate','startTime','endTime','pax','personInCharge','personInChargeEmail','personInChargeContact'));
        

    }
}
