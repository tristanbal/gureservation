@extends('layouts.app')

@section('content')
<div class="container">
    <div class="alert alert-success">
        Successfully Reserved!!    <i>*A copy of the receipt will be sent to your email.</i>
    </div>
    <h1>Reservation Receipt</h1>
    <hr>
    <div class="row">
        <div class="col-7">
            
            <p>Thank you for reserving a room in Globe University. For your convenience, your reference number is posted below in cases when you need to edit or cancel your 
                    reservation. Your reference number must be presented on the of day its reservation.</p>
                    <p><i>*A copy of the receipt will be sent to your email.</i><br><br>
            </p>
            <h2>Personal Information</h2>
            <table style='text-align:left;'>
            <tr>
                <th>Reservee:</th>
                <td>{{$firstname}} {{$lastname}}</td>
            </tr>
            <tr>
                <th>Email:</th>
                <td>{{$email}}</td>
            </tr>
            <tr>
                <th>Reference ID:</th>
                <td>{{$random}}</td>
            </tr>
            <tr>
                <th>Employee ID Registered:</th>
                <td>{{$employeeID}}</td>
            </tr>
            </table>
            <br>
            <hr>
            <br>
            <h2>Reservation Information</h2>
            <table style='text-align:left;'>
            <tr>
                <th>Title:</th>
                <td>{{$title}}</td>
            </tr>
            <tr>
                <th>Room:</th>
                <td>{{$reservedRoom}}</td>
            </tr>
            <tr>
                <th>Pax:</th>
                <td>{{$pax}}</td>
            </tr>
            <tr>
                <th>Start Date:</th>
                <td>{{date('F d, Y',strtotime($startDate))}}</td>
            </tr>
            <tr>
                <th>End Date:</th>
                <td>{{date('F d, Y',strtotime($endDate))}}</td>
            </tr>
            <tr>
                <th>Start Time:</th>
                <td>{{date('h:mA',strtotime($startTime))}}</td>
            </tr>
            <tr>
                <th>End Time:</th>
                <td>{{date('h:mA',strtotime($endTime))}}</td>
            </tr>
            <tr>
                <th>Additonal Items:</th>
                <td>{{$items}}</td>
            </tr>
            <tr>
                <th>Remarks:</th>
                <td>{{$specialInstructions}}</td>
            </tr>
            </table>
            <br>
            <hr>
            <br>
            <h2>Person In Charge Information</h2>
            <table style='text-align:left;'>
            <tr>
                <th>Person-In-Charge:</th>
                <td>{{$personInCharge}}</td>
            </tr>
            <tr>
                <th>Person-In-Charge Email:</th>
                <td>{{$personInChargeEmail}}</td>
            </tr>
            <tr>
                <th>Person-In-Charge Contact:</th>
                <td>{{$personInChargeContact}}</td>
            </tr>
            </table>
            <br>
            <p>Thank you for booking. To return home, click here: <a href="{{route('/')}}" class="btn btn-primary">Return Home</a></p><BR><BR>
            
        </div>
        <div class="col-5">
                <h3>Room Location:</h3>
                <h5>The Globe University Campus, 5F Tower 1, GT Plaza Mandaluyong City</h5>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.468874155708!2d121.04763681431983!3d14.572338181676583!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c84463088019%3A0x7337e6bd1999d877!2sThe+Globe+University+Campus%2C+5F+Tower+1%2C+GT+Plaza+Mandaluyong+City!5e0!3m2!1sen!2sph!4v1538361163879" 
                    style="width:100%;height:65%;border:0 " frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
    
</div>
@endsection
