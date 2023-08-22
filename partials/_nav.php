<?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $loggedin= true;
}
else{
  $loggedin = false;
};
  

if(!$loggedin){
  echo'
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand">AccessAll</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button> 
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="signup.php">Signup</a>
      </li>
    </ul>
  </div>
  </nav> ';
  }

if($loggedin){
  echo'
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand text-white">AccessAll</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button> 
  <div class="collapse navbar-collapse mr-auto justify-content-between" id="navbarSupportedContent" >
  
  <div class="">
    <ul class="navbar-nav mr-auto ">';
    if($_SESSION['user_type_id'] == 1)
    {
      echo'<li class="nav-item active">
      <a class="nav-link" href="organizationhome.php">Home<span class="sr-only">(current)</span></a>
      </li>';
    }
    else
    {
      echo'<li class="nav-item active">
      <a class="nav-link" href="userhome.php">Home<span class="sr-only">(current)</span></a>
      </li>
      
      <form class="form-inline mx-3 my-2 my-lg-0" method="get" action="search.php">
    <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
    </form>';
    }
    

    echo'
      
  </ul>
  </div>

  <div class="">
    <ul class="navbar-nav mr-auto ">
    
    <li class="nav-item active float-right">
    <a class="nav-link" href="profile.php"><i>'. $_SESSION['name']. '</i></a> 
    </li>
        
    <li class="nav-item active float-right">
    <a class="nav-link" href="logout.php">Logout</a>
    </li>
    </ul>
  </div>
  
  </div>
  </nav>';
  }


?>