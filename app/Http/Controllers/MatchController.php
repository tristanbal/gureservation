<?php

namespace App\Http\Controllers;
use Redirect;
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
use Illuminate\Support\Facades\Validator;
use Mail;

class MatchController extends Controller
{
    //
    

    /*public $firstname = 0;
    public $lastname = 0;
    public $middlename = 0;
    public $employeeID = 0;
    public $groupname = 0;
    public $email = 0;
    public $phone = 0;
    public $random = 0;
    public $title = 0;
    public $roomName = 0;
    public $startDate = 0;
    public $endDate = 0;
    public $startTime = 0;
    public $endTime = 0;
    public $pax = 0;
    public $personInCharge = 0;
    public $personInChargeEmail = 0;
    public $personInChargeContact = 0;*/

    public function index()
    {
        $employee = Employee_data::all();
        $sample = 'sample';
        return view('pages.employee')->with(compact('employee','sample'));
    }
    // function for searching
    public function start(Request $request){

        $fillable = $request->validate([
            'idnumber' => 'required',
            'employeeEmail' => 'required'
        ]);

        $employeeID = $request->input('idnumber');

        

        $employee = DB::select("call searchEmployee (?)", [$employeeID]);
        //dump($employee);
        //return $employee;
        //return $employee;
        $email = "";
        foreach($employee as $employees){
            $email = $employees->email;
        }
            
        if ($email == $request->input('employeeEmail')) {
            $items = Setup::pluck('name','id');
            $reservation = $request->session()->get('reservation');
            //return $items;
            return view('pages.start')->with(compact('reservations','items','employee'));
        } else {
            //return Redirect::back()->withErrors(['msg', 'The Message']);
            return Redirect::back()->withErrors(['Wrong Credentials'])->withInput();
        }
        


    }

    public function search(Request $request)
    {
        $reservation = $request->session()->get('reservation');
        return view('users.reserve.index',compact('reservation',$reservation));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //matching
    public function step1_match(Request $request)
    {
        //Model
        
        $rooms = Room::all();
        $roomspersetups = RoomPerSetup::all();
        $setups = Setup::all();

        //
        //Data Validation
        $fillable = $request->validate([
            'reserveStartTime' =>'required',
            'reserveEndTime' => 'required',
            'reserveStartDate' => 'required|date|before_or_equal:reserveEndDate|after:yesterday',
            'reserveEndDate' => 'required|date|after_or_equal:reserveStartDate|after:yesterday',
            'setup'=> 'required',
            'pax' => 'required|numeric'
        ]);
        return $request->input('reserveStartDate');


        //Gather Inputs
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
        $capacity = $request->input('pax'); // Gather 


        //Return the reserved rooms schedule ==========!!!!! FINAL QUERY !!!!!!=============
        $listReserved = DB::table('days')
        ->select('rooms.id as RoomID')
        ->distinct('rooms.id')
        ->join('reservations','reservations.referenceID','=','days.referenceID')
        ->join('room_per_setups','room_per_setups.id','=','reservations.roomPerSetupID')
        ->join('rooms','rooms.id','=','room_per_setups.roomID')
        ->whereBetween('day',[$startDateNext,$endDateNext])
        ->get();

        //Return the list of rooms of GU ==========!!!!! FINAL QUERY !!!!!!=============
        $results = DB::select("call returnAvailableRooms(?,?)",array($request->input('setup'),$capacity));
        
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



        return view('users.reserve.available')->with(compact('reserveStartTime','reserveEndTime','firstname','lastname','middlename','employeeID','groupname','email','phone','startDateNext','endDateNext','setupNext','capacity','recommendedroom','rooms','roomspersetups','setups','searches','searchesclassroom','searchescluster','searchestheater','searchesboard','results'));

    }
    public function step1_reserve(Request $request)
    {
        //
        $employee = Employee_data::all();
        $groups = Groups::all();
        $divisions = Divisions::all();
        $departments = Departments::all();

        $fillable = $request->validate([
            'roomPerSetUp' => 'required',
            'reserveStartDate' => 'required|date|before_or_equal:reserveEndDate|after:yesterday',
            'reserveEndDate' => 'required|date|after_or_equal:reserveStartDate|after:yesterday',
            'setup' => 'required',
            'pax'=> 'required'
        ]);

        $personInCharge = $request->input('personInCharge');
        $personInChargeContact = $request->input('personInChargeContact');
        $personInChargeEmail = $request->input('personInChargeEmail');


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

        $specialInstructions = $request->input('instructions');
        
        if ($request->get('items')!= null){
            $items = implode(", ",$request->get('items'));
        }else {
            $items = 'N/A';
        }
        
        
    

        $roomPerSetupID = $request->input('roomPerSetUp');
        $startDateNext = $request->input('reserveStartDate');
        $endDateNext = $request->input('reserveEndDate');
        $setupNext = $request->input('setup');
        $capacity = $request->input('pax');
        $roomInfo = DB::select ("call roomInfo(?)",[$request->input('roomPerSetUp')]);

        return view('users.reserve.index')->with(compact('items','specialInstructions','personInCharge','personInChargeContact','personInChargeEmail','title','reserveStartTime','reserveEndTime','random','firstname','lastname','middlename','employeeID','groupname','email','phone','roomPerSetupID','startDateNext','endDateNext','setupNext','capacity','roomInfo','employee','groups'));
        //$items = Employee_data::pluck('employeeID','firstname','lastname','middlename','namesuffix','groupID','email');

        //return redirect('/sched');
    }

    public function step2_reserve(Request $request)
    {
        //Data Validation
        /*$this->validate($request, [
            'employeeID' => 'required',
            'title' => 'required',
            'RoomSetupID' => 'required',
            'startDateNext'=> 'required',
            'endDateNext' => 'required',
            'reserveStartTime' => 'required',
            'reserveEndTime' => 'required',
            'pax' => 'required',
            'personInCharge' => 'required',
            'personInChargeEmail' => 'required',
            'personInChargeContact' => 'required'
        ]);*/

        /*$roomPerSetupID = $request->input('roomPerSetup');
        $startDateNext = $request->input('reserveStartDate');
        $endDateNext = $request->input('reserveEndDate');
        $setupNext = $request->input('setup');
        $capacity = $request->input('pax');*/

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
        $specialInstructions = $request->input('instructions');
        $items = $request->input('items');

        $personInCharge = $request->input('personInCharge');
        $personInChargeContact = $request->input('personInChargeEmail');
        $personInChargeEmail = $request->input('personInChargeContact');

        

        if ( $personInCharge == null || $personInChargeContact == null || $personInChargeEmail == null)
        {
            $personInCharge  = "N/A";
            $personInChargeContact = "N/A";
            $personInChargeEmail = "N/A";
        }

        if ( $specialInstructions == null)
        {
            $specialInstructions  = "N/A";
        }

        if ( $items == null)
        {
            $items  = "N/A";
        }
        
        
        $groupname = "HR Sample";

        //Store to Database
        $reservation = new Reserve;

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
        $reservation->remarks =  $request->input('instructions');
        $reservation->items =  $request->input('items');
        $reservation->save();

        //Store to days
        $start = new DateTime($reservation->reserveStartDate); // Start Date Variable
        $end = new DateTime($reservation->reserveEndDate); // End Date Variable
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
                $daysReserve->startTime = $request->input('reserveStartTime');
                $daysReserve->endTime = $request->input('reserveEndTime');
                $daysReserve->referenceID = $random;
                $daysReserve->save();

                // echo $days . '<br>';
            } 
        }    
        

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
        //$specialInstructions = $request->input('instructions');
        
        

        // send email
//        mail($request->input('personInChargeEmail'),"Confirmation: Globe University Studio Reservation",$msg);

        /*Mail::send(['text'=>$msg],['name','Globe University'],function($message){
            $message->to('baltristangabriel@gmail.com','To Sample')->subject('Test Email');
            $message->from('baltristangabriel@gmail.com','GU');
        });*/

        $theRoom = DB::select("SELECT r.name as 'studioName',r.picture as 'picture', rs.capacity as 'capacity' FROM room_per_setups rs, rooms r WHERE rs.id = ".$roomPerSetupID." and rs.roomID=r.id");
        $ti = 0;
        $reservedRoom = '';
        $reservedCapacity = '';
        foreach ($theRoom as $theRooms){
            if($ti==0){
                $reservedRoom = $theRooms->studioName;
                $reservedCapacity = $theRooms->capacity;
                $ti++;
            }
        }

        //return $reservedRoom;

        $data = array(
            'email'=>$email,
            'firstname'=>$firstname,
            'lastname'=>$lastname,
            'reservedRoom'=>$reservedRoom,
            'random'=>$random,
            'employeeID'=>$employeeID,
            'title'=>$title,
            'roomName'=>$roomName,
            'startDate'=>$startDate,
            'endDate'=>$endDate,
            'startTime'=>$startTime,
            'endTime'=>$endTime,
            'pax'=>$pax,
            'personInCharge'=>$personInCharge,
            'personInChargeEmail'=>$personInChargeEmail,
            'personInChargeContact'=>$personInChargeContact,
            'specialInstructions'=>$specialInstructions,
            'items'=>$items
        );
        Mail::send('mailer.receipt', $data, function($message) use ($email,$random)
        {   
            //$message->from($contactEmail, $contactName);
            $message->to($email, 'Reservee')->CC('globeuniversity@asticom.com.ph')
            ->subject('[NO-REPLY] CONFIRMATION #'.$random.': Globe University Room Reservation');
        });

        if ($personInCharge != 'N/A'){
            Mail::send('mailer.receipt', $data, function($message) use ($personInChargeEmail,$random)
            {   
            //$message->from($contactEmail, $contactName);
                $message->to($personInChargeEmail, 'Reservee')
                ->subject('[NO-REPLY] CONFIRMATION #'.$random.': Globe University Room Reservation Person-In-Charge Copy');
            });

        }


       /* Mail::send([], compact('random','employeeID','title','roomName','startDate','endDate','startTime','endTime','pax','personInCharge','personInChargeEmail','personInChargeContact'), function ($message) {
            $message->to('baltristangabriel@gmail.com','GU Reservation')
            //->CC('globeuniversity@asticom.com.ph)
              ->subject('CONFIRMATION: Globe University Room Reservation')
             ->setBody("
             <div style='padding:10px;text-align:center;background-color:#0759a7;color:white;width:100%;'><h1>GLOBE UNVIRSITY RESERVATION CONFIRMATION</h1></div>
             <p>Thank you for reserving a room in Globe University. For your convenience, your reference number is posted below in cases when you need to edit or cancel your 
             reservation. Your reference number must be presented on the of day its reservation.</p>
             <table>
                <tr>
                    <th>Reference ID:</th>
                    <td>{{$random}}</td>
                </tr>
             </table>
             ", 'text/html'); // for HTML rich messages
          });*/

        //return to view
        return view('users.reserve.success')->with(compact('items','specialInstructions','email','firstname','lastname','reservedRoom','random','employeeID','title','roomName','startDate','endDate','startTime','endTime','pax','personInCharge','personInChargeEmail','personInChargeContact'));
        
        //$items = Employee_data::pluck('employeeID','firstname','lastname','middlename','namesuffix','groupID','email');

        //return redirect('/sched');
    }
    public function success()
    {
        //
        return view('users.reserve.success');
        //$items = Employee_data::pluck('employeeID','firstname','lastname','middlename','namesuffix','groupID','email');

        //return redirect('/sched');
    }

    public function reservations() 
    {
        $reservations = DB::select("SELECT r.id as 'ReservationID',rm.picture as 'RoomPicture',rm.name as 'RoomName', s.name as 'Setup', r.purposeID as 'ReferenceID', CONCAT('(',ed.employeeID,') ',ed.lastname,', ',ed.firstname) as 'EmployeeName',r.personInCharge as 'PersonInCharge', r.personInChargeEmail as 'PersonInChargeEmail', r.personInChargeContact as 'PersonInChargeContact', r.reserveStartDate as 'reserveStartDate', r.reserveEndDate as 'reserveEndDate', r.reserveStartTime as 'reserveStartTime', r.reserveEndTime as 'reserveEndTime', r.title as 'Title', r.pax as 'Pax'
        FROM reservations r, rooms rm, room_per_setups rs, employee_datas ed, setups s 
        WHERE rs.id = r.roomPerSetUpID and rs.roomID = rm.id and r.employeeID = ed.employeeID and rs.setupID = s.id");
        return view('admin.reservation.index')->with('reservations',$reservations);
    }
}
