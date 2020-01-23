<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $employees = Employee_data::all();
    }

    public function getAll()
    {
        $employees = Employee_data::all();
        return datatables($employees)->toJson();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $groups = Group::all();
        $bands = Band::all();
        $roles = role::all();
        $divisions = Division::all();
        $departments = Department::all();
        $sections = Section::all();
        $employees = Employee_data::all();
        $jobs = Job::all();
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
            'employeeID' => 'required',
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'suffix' => 'required',
            'email' => 'required',
            'phonenumber' => 'required',
            'bandsDropdown' => 'required',
            'groupsDropdown' => 'required',
            'divisionsDropdown' => 'required',
            'departmentsDropdown' => 'required',
            'sectionsDropdown' => 'required'
        ]);
        $employee = new Employee_data;
        $employee->employeeID = $request->input('employeeID');
        $employee->firstname = $request->input('firstname');
        $employee->middlename = $request->input('middlename');
        $employee->lastname = $request->input('lastname');
        $employee->nameSuffix = $request->input('suffix');
        $employee->email = $request->input('email');
        $employee->phone = $request->input('phonenumber');
        $employee->bandID = $request->input('bandsDropdown');
        $employee->groupID = $request->input('groupsDropdown');
        $employee->divisionID = $request->input('divisionsDropdown');
        $employee->departmentID = $request->input('departmentsDropdown');
        $employee->sectionID = $request->input('sectionsDropdown');
        $employee->jobID = "0";
        $employee->save();
        return redirect('admin/employees')->with('success', 'Employee successfully created.');
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
        $employee = Employee_data::find($id);
        $groups = Group::all();
        $divisions = Division::all();
        $departments = Department::all();

        $bands = Band::all();
        $roles = Role::all();
        $sections = Section::all();
        $employees = Employee_data::all();
        $jobs = Job::all();

        return view('AdminViews.Employee.admin-employee-view')->with(compact('employee','groups','divisions','departments', 'bands','roles','sections','employees','jobs'));
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
        $employee = Employee_data::find($id);
        $groups = Group::all();
        $divisions = Division::all();
        $departments = Department::all();
        $sections = Section::all();
        $bands = Band::all();
        $roles = Role::all();
        $sections = Section::all();
        $employees = Employee_data::all();
        $jobs = Job::all();

        return view('AdminViews.Employee.admin-employee-edit')->with(compact('employee','groups','divisions','departments','sections', 'bands','roles','employees','jobs'));

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
    }
}
