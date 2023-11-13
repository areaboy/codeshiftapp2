<?php
//error_reporting(0);
session_start();
include ('authenticate.php');
include ('settings.php');

$userid_sess =  htmlentities(htmlentities($_SESSION['uid'], ENT_QUOTES, "UTF-8"));
$fullname_sess =  htmlentities(htmlentities($_SESSION['fullname'], ENT_QUOTES, "UTF-8"));
$token_sess =   $userid_sess;
$email_sess =  htmlentities(htmlentities($_SESSION['email'], ENT_QUOTES, "UTF-8"));



?>
<!DOCTYPE html>
<html lang="en">

<head>
 
<title>Welcome <?php echo htmlentities(htmlentities($fullname, ENT_QUOTES, "UTF-8")); ?> to Dropbox Documents Analyzer System </title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keywords" content="" />
  <script src="scripts/jquery.min.js"></script>
  <script src="scripts/bootstrap.min.js"></script>
<link type="text/css" rel="stylesheet" href="scripts/bootstrap.min.css">

<link type="text/css" rel="stylesheet" href="scripts/store.css">

<script src="scripts/jquery.dataTables.min.js"></script>
  <script src="scripts/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="scripts/dataTables.bootstrap.min.css" />
<script src="scripts/moment.js"></script>
	<script src="scripts/livestamp.js"></script>

  


</head>
<body>



<div class="text-center">
<nav class="navbar navbar-fixed-top style='background:purple' ">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navgator">
        <span class="navbar-header-collapse-color icon-bar"></span>
        <span class="navbar-header-collapse-color icon-bar"></span>
        <span class="navbar-header-collapse-color icon-bar"></span> 
        <span class="navbar-header-collapse-color icon-bar"></span>                       
      </button>
     
<li class="navbar-brand home_click imagelogo_li_remove" ><img class="img-rounded imagelogo_data" src="logo.png"></li>
    </div>
    <div class="collapse navbar-collapse" id="navgator">

      <ul class="nav navbar-nav navbar-right">

<li class="navgate">

<button class="invite_btnx btn btn-warning"><a style="color:white;" href='dashboard.php' title='Back to Dashboard'>Back to Dashboard</a></button>

</li>


<li class="navgate">

<button class="invite_btnx btn btn-warning"><a style="color:white;" href='logout.php' title='Logout'>Logout</a></button>

</li>
</ul>





    </div>
  </div>


</nav>


    </div><br />
<br /><br />



<div style='width:100vw; height: 100vh;  min-height:600px;'>
 

<div class='row'>
<div class='col-sm-12'>
Welcome <b> <?php echo htmlentities(htmlentities($fullname_sess, ENT_QUOTES, "UTF-8")); ?></b>
</div></div><br>









<style>
.report_cssx{
background:#ddd;
padding:10px;
height:70px;
border:none;
color:black;
border-radius:20%;
font-size:16px;
text-align:center;


}


.report_cssx:hover{
background:orange;
color:black;

}

</style>







<style>



.red_css {
    background:red;
    color: white;
    padding: 6px;
border:none;
border-radius:15%;
text-align:center;
font-size:12px;
}

.green_css {
    background:green;
    color: white;
    padding: 6px;
border:none;
border-radius:15%;
text-align:center;
font-size:12px;
width: 90px;
}

.purple_css {
    background:purple;
    color: white;
    padding: 6px;
border:none;
border-radius:15%;
text-align:center;
font-size:12px;
width: 90px;
}

.fuchsia_css {
    background:fuchsia;
    color: white;
    padding: 6px;
border:none;
border-radius:15%;
text-align:center;
font-size:12px;
width: 90px;
}


.c_css{
background: navy;
color:white;
padding:6px;
cursor:pointer;
border:none;
font-size:12px;
//border-radius:25%;
//font-size:16px;
}

.c_css:hover{
background: black;
color:white;

}

</style>



<div class='row'>

<div class='col-sm-2'></div>
<div class='col-sm-8'>

<center><h3>Set ChatGPT Access API Key</h3></center>



<?php

include('data6rst.php');

$result_verified = $db->prepare('select * from users where id=:id');
$result_verified->execute(array(':id' =>$userid_sess));
$rowv = $result_verified->fetch();
$count = $result_verified->rowCount();

$api_keyx = $rowv['api_key'];


if($api_keyx !=''){

echo "<div id='' style='background:green;color:white;padding:10px;border:none;'>ChatGPT API Key already updated and set</div>";

}else{

echo "<div id='' style='background:red;color:white;padding:10px;border:none;'>Please Set Update Your ChatGPT API Key Or Ask Admin to Do it</div>";
}



?>

<br><br>

To obtain Chatgpt API Keys. Goto this link below and signup
 <a href='https://beta.openai.com/account/api-keys'>https://beta.openai.com/account/api-keys </a>. <br><br> After that go to 

 this link and get and generate ChatGPT api key and click on <b>View API Keys</b>
<a href='https://platform.openai.com/account/api-keys'> https://platform.openai.com/account/api-keys </a>




<script>


$(document).ready(function(){
$('#key_btn').click(function(){
//$(document).on( 'click', '.key_btn', function(){ 
		
var api_key  = $('#api_key').val();


if(api_key==""){
alert('Please Enter ChatGPT API Key');
//return false;   
}



else{
$('#loader_s').fadeIn(400).html('<br><div style="color:black;background:#ddd;padding:10px;"><img src="ajax-loader.gif"> Please Wait! .Updating ChatGPT API Key in Progress..</div>')

var datasend = {api_key:api_key};	
		$.ajax({
			
			type:'POST',
			url:'chatgpt_settings_action.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){
 		
$('#loader_s').hide();
$('#result_s').html(msg);
//setTimeout(function(){ $('#result_s').html(''); }, 9000);


			}
			
		});
		
		}
	
	})
					
});



</script>

 <div class="form-group col-sm-12 ">
              <label>Enter ChatGPT API Key </label>
              <input type="text" class="col-sm-12 form-control" id="api_key" name="api_key" placeholder="Enter ChatGPT API Key">
            </div>
<br>

 <div class="form-group col-sm-12 ">
			<div id="loader_s"></div>
                        <div id="result_s"></div>
                       </div>






<br>




 <div class="form-group">


                    <input type="button" id="key_btn" class="pull-right btn btn-primary key_btn" value="Update ChatGPT Access Token" />
			
                    </div>


</div>
<div class='col-sm-2'></div>


</div>











</body>
</html>
