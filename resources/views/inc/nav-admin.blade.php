
<!--
<div class="container upperheader fixed-top" style="margin-top:20px;margin-bottom:20px;" >
    <div class="row">
        <div class="col-10">
            <a href="/"><img src="{{asset('images/logo/gu_logo_white.png')}}" style="width:15%;">  </a>
        </div>
        <div class="col-2" style="float:right;">
            <button type="button" class="btn btn-outline-info" style="width:100%;">Login Administrator</button>
        </div>
    </div>
</div>-->



<nav class="navbar nav-wrapper navbar-expand-lg navbar-light navbar-dark fixed-top">
    <a class="navbar-brand" href="#">
        <a href="{{route('home')}}"><img src="{{asset('images/logo/gu_logo_white.png')}}" style="width:10vh;">  </a>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse w-100 order-3 dual-collapse2" id="navbarNav">
        <!--<p class="nav navbar-text pull-right text-uppercase text-white">Reservation Progress</p>-->
        <?php 
        $host = $_SERVER['SERVER_NAME']  . $_SERVER['REQUEST_URI'];
        if($host == '/') 
        {?>
            
            <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div><?php
        }
        
        ?>

      <!--<div class="nav navbar-text progress" style="width: 300px; margin-top:10px">
            <div class="bar" style="width: 30%;"></div>
        </div>-->
        <ul class="navbar-nav ml-auto text-uppercase text-white">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Administrator Login') }}</a>
                    </li>
                    <!--<li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>-->
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Monitoring
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            
                            <a class="dropdown-item" href="#">Reserved</a>
                            <a class="dropdown-item" href="#">Available</a>
                            
                            </div>
                        </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Manage
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        
                        <a class="dropdown-item" href="{{route('rooms.index')}}">Rooms</a>
                        <a class="dropdown-item" href="#">Reservations</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('admin/reserve/manual/first')}}">Manual Reserve</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Employees</a>
                        <a class="dropdown-item" href="#">Groups</a>
                        <a class="dropdown-item" href="#">Divisions</a>
                        <a class="dropdown-item" href="#">Department</a>
                        <a class="dropdown-item" href="#">Sections</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Reports</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
        
                        <div class="dropdown-menu dropdown-menu-right text-white" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('register')}}">Register Admin</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
        
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
      
    </div>
    

    
  </nav>


  <div class="container">
      <div class="navbar navbar-static-top">
          <div class="navbar-inner">
              <ul class="nav">
                  <li><a href="#"><i class="icon-play"></i></a></li>
                  <li><a href="#"><i class="icon-stop"></i></a></li>
              </ul>
              
          </div>
      </div>
  </div>