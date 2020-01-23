@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
        <h1> Reservations <h1>
            <table class="table">
                <tr>
                    <th>Reference ID</th>
                    <th>Reservation ID</th>
                    <th>Room Name</th>
                    <th>Setup</th>
                    <th>Reference ID</th>
                    <th>Reservee</th>
                    <th>Person In Charge</th>
                </tr>
        @if(count($reservations)>=1)
            @foreach ($reservations as $reservations)
                <tr>
                    <th><a href="/admin/reservations/{{$reservations->ReferenceID}}" >{{$reservations->ReferenceID}}</a></th>
                    <th> {{$reservations->ReservationID}}</th>
                    <th> {{$reservations->RoomName}}</th>
                    <th> {{$reservations->Setup}}</th>
                    <th> {{$reservations->ReferenceID}}</th>
                    <th> {{$reservations->EmployeeName}}</th>
                    <th> {{$reservations->PersonInCharge}}</th>
                </tr>
            @endforeach
        @else
            <p>No reservations found.</p>
        @endif
            </table>
        </div>
    </div>
    
@endsection
