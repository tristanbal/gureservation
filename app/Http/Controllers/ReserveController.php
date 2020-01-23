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

class ReserveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    

    public function create()
    {
        //
        //return view('users.reserve.index');
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
            'email' => 'required',
            'employeeID' => 'required',
            'reservationStartDate' => 'required',
            'reservationEndDate' => 'required',
            'reservationStartTime' => 'required',
            'reservationEndTime' => 'required',
            'pax' => 'required'
        ]);

        /*$reservations = new Reserve;
        $reservations->employeeID = $request->input('employeeID');
        $reservations->reserveStartDate = $request->input('reservationStartDate');
        $reservations->reserveEndDate = $request->input('reservationEndDate');
        $reservations->reserveStartTime = $request->input('reservationStartTime');
        $reservations->reserveEndTime = $request->input('reservationEndTime');
        $reservations->numofpax = $request->input('numofpax');
        $reservations->purpose = $request->input('purpose');
        $reservations->title = $request->input('title');
        */
        //Sample
        //$reservations->roomID = 1;
        $reservations->save();

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
        $reservations = Reserve::find($id);
        return view('admin.reservation.show')->with('reservations',$reservations);
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
        $reservations = Reserve::find($id);
        //Rooms
        $roomPerSetup = RoomPerSetup::all();
        $room = Room::all();
        //Employee Data
        $employee_data = Employee_data::all();
        $groups = Groups::all();


        return view("users.search.edit")->with(compact('reservations','groups','roomPerSetup','room','employee_data'));
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
        //Store to Database
        $reservation = Reserve::find($id);

        $reservation->title = $request->input('title');
        $reservation->reserveStartTime = $request->input('startTime');
        $reservation->reserveEndTime = $request->input('endTime');
        $reservation->personInCharge = $request->input('personInCharge');
        $reservation->personInChargeEmail = $request->input('personInChargeEmail');
        $reservation->personInChargeContact = $request->input('personInChargeContact');
        $reservation->save();

        $employee = Employee_data::all();
        
        return Redirect::back()->with('success','Sucessfully Updated');
        return view('pages.employee')->with(compact('employee'))->with('successMsg','Property is updated.');
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
        $reserve = Reserve::find($id);
        $reserve->delete();
        return redirect('/');
    }

   

}
