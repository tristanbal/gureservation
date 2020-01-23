
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



<nav class="navbar nav-wrapper navbar-expand-lg navbar-light bg-dark fixed-top">
    <a class="navbar-brand" href="#">
        <a href="{{route('/')}}"><img src="{{asset('images/logo/gu_logo_white.png')}}" style="width:10%;">  </a>
    </a>
    
    <div class="collapse navbar-collapse" id="navbarNav">
        <!--<p class="nav navbar-text pull-right text-uppercase text-white">Reservation Progress</p>-->
        <?php 
        $host = $_SERVER['SERVER_NAME']  . $_SERVER['REQUEST_URI'];
        if($host == '/') 
        {?>
            
            <div class="progregss">
            <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div><?php
        }
        
        ?>

      <!--<div class="nav navbar-text progress" style="width: 300px; margin-top:10px">
            <div class="bar" style="width: 30%;"></div>
        </div>-->
        
      
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