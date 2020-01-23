<html lang="{{config('app.locale')}}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>


    <title> {{config('app.name','GU Reservation System')}}</title>



    <style>
        @import url(https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300);
        
        .split {
            height: 100%;
            width: 50%;
            position: fixed;
            /* z-index: -1; */
            top: 0;
            overflow-x: hidden;
            padding-top: 20px;
        }
        
        .left {
            left: 0;
            background-color: #0759A7;
        }
        
        .right {
            right: 0;
            background:url("{{asset('images/logo/startBG.jpg')}}") no-repeat center center fixed;
            background-size: cover;
            -webkit-box-shadow: inset 8px 0px 15px -4px rgba(0,0,0,0.72);
-moz-box-shadow: inset 8px 0px 15px -4px rgba(0,0,0,0.72);
box-shadow: inset 8px 0px 15px -4px rgba(0,0,0,0.72);
        }
        
        .centered {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }
        
        .centered img {
            width: 150px;
            
        }
        /*Hover Effects*/
        .card:hover {
            transform: scale(1.0);
            /*background-color:#3FBAD5;
            color:white;*/
            transition:all 0.25s ease;
            -webkit-box-shadow: 6px 7px 12px -3px rgba(0,0,0,0.78);
-moz-box-shadow: 6px 7px 12px -3px rgba(0,0,0,0.78);
box-shadow: 6px 7px 12px -3px rgba(0,0,0,0.78);

        }
        /* footbar */
        .myMessage {
            position: fixed;
            float:inherit;
            bottom: 10px;
            left:10px;
            width:33%;
            height: 15%;
            z-index: 1;
            background-color: #574696;
            -webkit-box-shadow: 3px 5px 8px 0px rgba(0,0,0,0.71);
            -moz-box-shadow: 3px 5px 8px 0px rgba(0,0,0,0.71);
            box-shadow: 3px 5px 8px 0px rgba(0,0,0,0.71);
        }

        .messageBoxText {
            position: absolute;
            padding:10px;
        }

        .newContainer {position: fixed; top: 25%; left: 25%;}

            /* make keyframes that tell the start state and the end state of our object */
            @-webkit-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
            @-moz-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
            @keyframes fadeIn { from { opacity:0; } to { opacity:1; } }

            .fade-in {
            opacity:0;  /* make things invisible upon start */
            -webkit-animation:fadeIn ease-in 1;  /* call our keyframe named fadeIn, use animattion ease-in and repeat it only 1 time */
            -moz-animation:fadeIn ease-in 1;
            animation:fadeIn ease-in 1;

            -webkit-animation-fill-mode:forwards;  /* this makes sure that after animation is done we remain at the last keyframe value (opacity: 1)*/
            -moz-animation-fill-mode:forwards;
            animation-fill-mode:forwards;

            -webkit-animation-duration:1s;
            -moz-animation-duration:1s;
            animation-duration:1s;
            }

            .fade-in.one {
            -webkit-animation-delay: 2.0s;
            -moz-animation-delay: 2.0s;
            animation-delay: 2.0s;
            }
            /*  Hover Effect for Card */
            
        </style>
</head>
<body >
        
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script> 

    <div class="myMessage fade-in one">
        <div class="messageBoxText">
            <div class="row">
                <div class="col-3">
                    <img src="{{asset('images/logo/informationLogo.png')}}" style="height:80%;">
                </div>
                <div class="col-9">
                    <p class=" text-white text-center"><b>Welcome to the GU Studio Reservation System!</b>
                        <br> <i>For Globe Employees and Non-GU Reservations, please search for your Employee ID.</i></p>
                </div>
            </div>
            
            
        </div>
    </div>

    <div class="split left">
        <div class="centered text-white text-uppercase">
            <a href="/"><img src="{{asset('images/logo/Globe Logo White.png')}}" style="width:50%;">  </a><br><br>
            {!! Form::open(['action'=> 'MatchController@start','method'=>'POST']) !!}
            <h3 class="">Search for your name:</h3>    
            <label> ID Number: </label>
                <input type="number" name="idnumber" class="form-control" id="realtxt" onkeyup="searchSel()" placeholder="Ex. 09920">
                
                <label>Email:</label>
                <input type="text" name="employeeEmail" id="employeeEmail" class="form-control" placeholder="Ex. jdelacruz@globe.com.ph">
                <br>
                {{Form::submit('Select',['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
    
    <div class="split right">
        <div style="text-align:center;"><a href="/home"><img src="{{asset('images/logo/GU LOGO.png')}}" style="width:10%;"></a></div>
        <div class="centered">

                {!! Form::open(['action'=> 'PagesController@search','method'=>'GET']) !!}
                <div class="card card__one" style="width: 18rem;">
                    <img src="{{asset('images/logo/adminIcon.png')}}" style="width:100%;">
                    <div class="card-body">
                        <h3>Reservations Edit and Cancellation</h3>
                        <p class="card-text">Reference ID:</p>
                        <input type="text" name="referenceID" class="form-control" placeholder="Ex. GU0033411" required/>
                        <br>
                        <input type="submit" name="searchReference" class="btn btn-primary">
                    </div>
                </div>
                {!! Form::close() !!}
        
        </div>
    </div>

    
  
  
        

</body>
</html>


<html lang="{{config('app.locale')}}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>


    <title> {{config('app.name','GU Reservation System')}}</title>



    <style>
        @import url(https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300);
        
        .split {
            height: 100%;
            width: 50%;
            position: fixed;
            /* z-index: -1; */
            top: 0;
            overflow-x: hidden;
            padding-top: 20px;
        }
        
        .left {
            left: 0;
            background-color: #0759A7;
        }
        
        .right {
            right: 0;
            background:url("{{asset('images/logo/startBG.jpg')}}") no-repeat center center fixed;
            background-size: cover;
            -webkit-box-shadow: inset 8px 0px 15px -4px rgba(0,0,0,0.72);
-moz-box-shadow: inset 8px 0px 15px -4px rgba(0,0,0,0.72);
box-shadow: inset 8px 0px 15px -4px rgba(0,0,0,0.72);
        }
        
        .centered {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }
        
        .centered img {
            width: 150px;
            
        }
        /*Hover Effects*/
        .card:hover {
            transform: scale(1.0);
            /*background-color:#3FBAD5;
            color:white;*/
            transition:all 0.25s ease;
            -webkit-box-shadow: 6px 7px 12px -3px rgba(0,0,0,0.78);
-moz-box-shadow: 6px 7px 12px -3px rgba(0,0,0,0.78);
box-shadow: 6px 7px 12px -3px rgba(0,0,0,0.78);

        }
        /* footbar */
        .myMessage {
            position: fixed;
            float:inherit;
            bottom: 10px;
            left:10px;
            width:33%;
            height: 15%;
            z-index: 1;
            background-color: #574696;
            -webkit-box-shadow: 3px 5px 8px 0px rgba(0,0,0,0.71);
            -moz-box-shadow: 3px 5px 8px 0px rgba(0,0,0,0.71);
            box-shadow: 3px 5px 8px 0px rgba(0,0,0,0.71);
        }

        .messageBoxText {
            position: absolute;
            padding:10px;
        }

        .newContainer {position: fixed; top: 25%; left: 25%;}

            /* make keyframes that tell the start state and the end state of our object */
            @-webkit-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
            @-moz-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
            @keyframes fadeIn { from { opacity:0; } to { opacity:1; } }

            .fade-in {
            opacity:0;  /* make things invisible upon start */
            -webkit-animation:fadeIn ease-in 1;  /* call our keyframe named fadeIn, use animattion ease-in and repeat it only 1 time */
            -moz-animation:fadeIn ease-in 1;
            animation:fadeIn ease-in 1;

            -webkit-animation-fill-mode:forwards;  /* this makes sure that after animation is done we remain at the last keyframe value (opacity: 1)*/
            -moz-animation-fill-mode:forwards;
            animation-fill-mode:forwards;

            -webkit-animation-duration:1s;
            -moz-animation-duration:1s;
            animation-duration:1s;
            }

            .fade-in.one {
            -webkit-animation-delay: 2.0s;
            -moz-animation-delay: 2.0s;
            animation-delay: 2.0s;
            }
            /*  Hover Effect for Card */
            
        </style>
</head>
<body >
        
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script> 

    <div class="myMessage fade-in one">
        <div class="messageBoxText">
            <div class="row">
                <div class="col-3">
                    <img src="{{asset('images/logo/informationLogo.png')}}" style="height:80%;">
                </div>
                <div class="col-9">
                    <p class=" text-white text-center"><b>Welcome to the GU Studio Reservation System!</b>
                        <br> <i>For Globe Employees and Non-GU Reservations, please search for your Employee ID.</i></p>
                </div>
            </div>
            
            
        </div>
    </div>

    <div class="split left">
        <div class="centered text-white text-uppercase">
            <a href="/"><img src="{{asset('images/logo/Globe Logo White.png')}}" style="width:50%;">  </a><br><br>
            {!! Form::open(['action'=> 'MatchController@start','method'=>'POST']) !!}
            <h3 class="">Search for your name:</h3>    
            <label> ID Number: </label>
                <input type="number" name="idnumber" class="form-control" id="realtxt" onkeyup="searchSel()" placeholder="Ex. 09920">
                
                <label>Email:</label>
                <input type="text" name="employeeEmail" id="employeeEmail" class="form-control" placeholder="Ex. jdelacruz@globe.com.ph">
                <br>
                {{Form::submit('Select',['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
    
    <div class="split right">
        <div style="text-align:center;"><a href="/home"><img src="{{asset('images/logo/GU LOGO.png')}}" style="width:10%;"></a></div>
        <div class="centered">

                {!! Form::open(['action'=> 'PagesController@search','method'=>'GET']) !!}
                <div class="card card__one" style="width: 18rem;">
                    <img src="{{asset('images/logo/adminIcon.png')}}" style="width:100%;">
                    <div class="card-body">
                        <h3>Reservations Edit and Cancellation</h3>
                        <p class="card-text">Reference ID:</p>
                        <input type="text" name="referenceID" class="form-control" placeholder="Ex. GU0033411" required/>
                        <br>
                        <input type="submit" name="searchReference" class="btn btn-primary">
                    </div>
                </div>
                {!! Form::close() !!}
        
        </div>
    </div>

    
  
  
        

</body>
</html>


