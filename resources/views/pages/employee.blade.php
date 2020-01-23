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
        html {
        scroll-behavior: smooth;
        }
        
        .right {
            right: 0;
            background:url("{{asset('images/logo/startBG.jpg')}}") no-repeat center center fixed;
            background-size: cover;
            -webkit-box-shadow: inset 8px 0px 15px -4px rgba(0,0,0,0.72);
-moz-box-shadow: inset 8px 0px 15px -4px rgba(0,0,0,0.72);
box-shadow: inset 8px 0px 15px -4px rgba(0,0,0,0.72);
        }
        
        .popMessage {
            position: fixed;
            float:inherit;
            bottom:0px;
            width:100%;
            height: 80px;
            z-index: 1;
            background-color: #435864;
            -webkit-box-shadow: 3px 5px 8px 0px rgba(0,0,0,0.71);
            -moz-box-shadow: 3px 5px 8px 0px rgba(0,0,0,0.71);
            box-shadow: 3px 5px 8px 0px rgba(0,0,0,0.71);
        }
        
        /* footbar */
        .myMessage {
            position: fixed;
            float:inherit;
            bottom: 10px;
            left:10px;
            width:80%;
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
            
            .padding-0{
            padding-right:0;
            padding-left:0;
            }
            .landingHome {
  height:100vh;
  background: linear-gradient(to right,
  rgba(0,0,0,0.8),
  rgba(87,70,150,0.8),
  rgb(0,167,231)),
  url("{{asset('/images/stock/Stock05.jpg')}}") no-repeat center !important;
  background-size: cover !important;
  filter:blur(5px);
  filter:brightness(50%);
  height:200%;
  widows: 100%;
}
.homeHeader {
    top: 0;
    height:100vh;
    width:100vw;
    position: absolute;
}
.homeContent {
    position: relative;
    top:35%;
    transform: translateY(-50%);
}
/*New Box */
.bg1 {
    background: 
    linear-gradient(
      rgba(0,0,0,0.5),
      #0759a7
    ),
    url("{{asset('/images/stock/Stock07.jpg')}}");
}

.bg2 {
    background: 
    linear-gradient(
      rgba(0,0,0,0.5),
      rgba(255,129,0.9)
    ),
    url("{{asset('/images/stock/Stock08.jpg')}}");
}

.bg3 {
    background: 
    linear-gradient(
      rgba(0,0,0,0.5),
      rgba(139,1,71)
    ),
    url("{{asset('/images/stock/Studio.jpg')}}");
}
.module {
  
  background-size: cover;
  width: 100%;
  height: 65vh;
  margin: 10px 0 0 10px;
  -webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;
}
.mid {
  margin: 0;
  bottom: 20%;
  left: 40%;
  font-size: 100%;
}

.myTextCard {
  margin: 0;
  top: 20%;
  left: 40%;
  font-size: 100%;
}


.hr-button {
    background:none;
    border:1;
    color:white;
}

.module:hover {
    transform: scale(1.1);
    transition: transform .5s;
    
}

.card__one {
  transition: transform .5s;

  &::after {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    transition: opacity 2s cubic-bezier(.165, .84, .44, 1);
    box-shadow: 0 8px 17px 0 rgba(0, 0, 0, .2), 0 6px 20px 0 rgba(0, 0, 0, .15);
    content: '';
    opacity: 0;
    z-index: -1;
  }

  &:hover,
  &:focus {
    transform: scale3d(1.006, 1.006, 1);

    &::after {
      opacity: 1;
    }
  }
}

        </style>
        
</head>
<body >
    <button class="btn btn-primary" onclick="topFunction()" id="myBtn" title="Go to top">Make | Edit | Cancel Reservation</button>

    <div id="top" style="position:relative;height:125vh; background: linear-gradient(to right,
            rgba(0,0,0,0.8),
            rgba(67, 54, 117, 0.8),
            rgb(26, 94, 121)),
            url('{{asset('/images/stock/Stock05.jpg')}}') no-repeat center !important;background-size: cover !important;">
        <nav class="navbar navbar-expand-lg navbar-dark " style="margin-left:3%;" >
            <a class="navbar-brand"href="{{route('home')}}"><img src="{{asset('images/logo/gu_logo_white.png')}}" style="width:8vw;"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Reserve <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#editCancel">Manage Reservations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tutorial">Tutorials</a>
                </li>
                
                </ul>
                <span class="navbar-text">
                </span>
            </div>
        </nav>
        <div class="text-white" style="position: absolute;">
            <div class="homeHeader">
                <div class="homeContent" style="margin:5%; ">
                    
                



                    <div class="row">
                        <div clas="col-sm-12">
                        @include('inc.messages')
                            <div class="display-2">SCHED IT.</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="lead">The Globe University Studio Reservation Portal. Bringing you closer to your learning experience.</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            {!! Form::open(['action'=> 'MatchController@start','method'=>'POST']) !!}
                            {{ csrf_field() }}
                            <label class="text-uppercase"> ID Number: </label>
                                <input type="number" name="idnumber" class="form-control" id="realtxt" onkeyup="searchSel()" placeholder="Login with your ID Number. Ex. 09920" required>
                                
                                <label class="text-uppercase">Email:</label>
                                <input type="text" name="employeeEmail" id="employeeEmail" class="form-control" placeholder="And your Email. Ex. jdelacruz@globe.com.ph" required>
                                <br>
                                {{Form::submit('Start Reservation',['class'=>'btn btn-primary'])}}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    
    <div id="editCancel" style="position:relative;" >
        <div style="height: 100vh;">
                    <div class="row ">
                        <div class="col-sm-12" style="text-align:center;">
                        <img src="{{asset('images/stock/sampletristan.png')}}" style="height:50%;">
                        <div class="display-3 text-uppercase">Manage.</div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center" style="text-align:center;">
                            <div class="col-sm-6">
                                <div class="lead">Edit or Cancel your Reservation in just a click.</div>
                            </div>
                        </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-sm-4" style="text-align:center;">
                                {!! Form::open(['action'=> 'PagesController@search','method'=>'GET']) !!}<br>
                                {{ csrf_field() }}
                                        <input type="text" name="referenceID" class="form-control" placeholder="Input your Reference ID. Ex. GU0033411" required/><br>
                                        <input type="submit" name="searchReference" class="btn btn-primary">
                                {!! Form::close() !!}
                        </div>
                    </div>
        </div>
    </div>
    
    <div class="row"id="tutorial" style="position:relative; background:url('{{asset('images/logo/startBG.jpg')}}') no-repeat center center fixed;
    background-size: cover;padding-top:70px;padding-bottom:70px;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="display-3 text-uppercase text-center">Initiate, Explore.</div>
                </div>
            </div>
        </div>

    </div>

    <div class="row text-white" style="background:#06adff;" >

        <div class="container" style=" padding-top:50px;padding-bottom:50px;">
            <br>
            <h1 class="text-uppercase text-center font-weight-light">The Guide to a <p class="font-weight-bold">Studio Reservation</p></h1>
            <div class="row" style="">
                    <div class="col-sm-4">
                        <div class="bg1 module  text-uppercase text-white card__one d-flex justify-content-center align-items-center text-center">
                            <div class="myTextCard ">
                                <div>
                                <h3 class="font-weight-normal"><p>Login with your <span class="font-weight-bold">credentials.</span></h3>
                                    <a href="#top" style="color:white;text-decoration:none;" class="btn btn-info">Start Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="bg2 module  text-uppercase text-white card__one d-flex justify-content-center align-items-center text-center">
                            <div class="myTextCard">
                                <div>
                                <h3 class="font-weight-normal">Set your preferred <span class="font-weight-bold">Date and Time.</span> </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="bg3 module  text-uppercase text-white card__one d-flex justify-content-center align-items-center text-center">
                            <div class="myTextCard">
                                <div>
                                <h3 class="font-weight-normal">Grab your <span class="font-weight-bold"> recommended room.</span></h3>
                                <a href="#rooms" style="color:white;text-decoration:none;" class="btn btn-info">See Rooms</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
        </div>
    </div>
<div style="position:relative; background:url('{{asset('images/logo/startBG.jpg')}}') no-repeat center center fixed;
background-size: cover;">
    <div class="container" style="padding-top:50px;padding-bottom:50px;">
            <h1 class="text-uppercase text-center font-weight-light">Claim your <p class="font-weight-bold">Boarding Pass.</p></h1>
        <div class="row">
            <div class="col-sm-12 text-center">
                <img src="{{asset('images/stock/boardingpass.png')}}" style="width:100%;">
            </div>
        </div>


    </div>
</div>

<div id="rooms" style="position:relative;height:125vh; background: linear-gradient(to right,
            rgba(0,0,0,0.8),
            rgba(67, 54, 117, 0.8),
            rgb(26, 94, 121)),
            url('{{asset('/images/stock/stock02.jpg')}}') no-repeat center !important;background-size: cover !important;color:white;">
   <div class="container" style="padding-top:50px;padding-bottom:50px;">
        <h1 class="text-uppercase text-center font-weight-light">Welcome to<p class="font-weight-bold">Globe University.</p></h1>
    <div class="row">
        <div class="col-sm-12 text-center">
                <video class="" alt="Card image cap" style="height:auto;width:70vw" controls>
                        <source src="{{asset('video/GlobeUniversityVirtualTourVideo.mp4')}}" type="video/mp4">
                    </video>
        </div>
    </div>


</div>





    <script>
        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {scrollFunction()};
        
        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("myBtn").style.display = "block";
            } else {
                document.getElementById("myBtn").style.display = "none";
            }
        }
        
        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }


        </script>

</body>

</html>


