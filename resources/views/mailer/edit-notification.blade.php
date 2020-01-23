

<style>


        /* common styles !!!YOU DON'T NEED THEM */
        
        /* button styles !!!YOU NEED THEM 
        !!!ALSO YOU NEED TO ADD FONTWESOME */
        .btn {
            color: #F1E9DA;
            background-color: #F28123;
        border-radius: 6px;
        }
        .effect {
          text-align: center;
          display: inline-block;
          position: relative;
          text-decoration: none;
          color: $link-text-color;
          text-transform: capitalize;
          /* background-color: - add your own background-color */
          font: {
            family: 'Roboto', sans-serif; /* put your font-family */
            size: 18px;
          }
          padding: 20px 0px;
          width: 150px;
          border-radius: $border-radius;
          overflow: hidden;
        }
        
        /* effect-5 styles */
        
        .effect.effect-5 {
          transition: all 0.2s linear 0s;
          
          &:before {
            content: "\f054";
            font-family: FontAwesome;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            top: 0;
            left: 0px;
            height: 100%;
            width: 30px;
            background-color: rgba($overlay-color,0.3);
            border-radius: 0 50% 50% 0;
            transform: scale(0,1);
            transform-origin: left center;
            transition: all 0.2s linear 0s;
          }
          
           &:hover {
            text-indent: 30px;
            
            &:before {
              transform: scale(1,1);
              text-indent: 0;
            }
          }
        }
        
        </style>
        <div style='padding:10px;text-align:center;background-color:#0759a7;color:white;width:100%;'><img src="https://globeuniversity.globe.com.ph/gu-reservation/public/images/logo/gu_logo_white.png" style="width:20vh;height:auto;"></div>
        
        <h2>Dear {{$firstname}},<br></h2>
        <p>This is to notify you that there were changes regarding your booking. Shown below is the updated information of your booking.</p>
        <br>
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
            <th>Additional Items:</th>
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
        <p>Manage your reservations here: <a href="https://globeuniversity.globe.com.ph/gu-reservation/public/#editCancel" class="btn btn-sample btn-large">Manage Reservations</a></p><BR><BR>
        <div style='padding:3px;text-align:center;background-color:#0759a7;color:white;width:100%;'><h5>GLOBE UNIVERSITY (C) 2019</h5></div>