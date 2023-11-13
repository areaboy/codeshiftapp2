





<!DOCTYPE html>
<html lang="en">

<head>
 <title> Openshift Mysql  Installations </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="description" content="Db Installations" />

  <link rel="stylesheet" href="bootstrap.min.css">
    <script src="jquery.min.js"></script>
    <script src="bootstrap.min.js"></script>







<style>
.imagelogo_li_remove {
list-style-type: none;
margin: 0;
 padding: 0;
}

.imagelogo_data{
 width:120px;
 height:80px;
}
  .navbar {
    letter-spacing: 1px;
    font-size: 14px;
    border-radius: 0;
    margin-bottom: 0;
   background-color:purple;

    z-index: 9999;
    border: 0;
    font-family: comic sans ms;
//color:white;
  }


.navbar-toggle {
background-color:orange;
  }

.navgate {
padding:16px;color:white;

}

.navgate:hover{
 color: black;
 background-color: orange;

}


.navbar-header{
height:60px;
}

.navbar-header-collapse-color {
background:white;
}

.dropdown_bgcolor{

background: fuchsia;
color:white;
}

.dropdown_dashedline{
 border-bottom: 2px dotted white;
}

.navgate101:hover{
background:purple;
color:white;

}



.invite_btn{
background-color: fuchsia;
padding: 6px;
color:white;
font-size:14px;
//border-radius: 50%;
border: none;
cursor: pointer;
text-align: center;
}
.invite_btn:hover {
background: black;
color:white;
}


.course_btn{
background-color: red;
padding: 6px;
color:white;
font-size:14px;
//border-radius: 50%;
border: none;
cursor: pointer;
text-align: center;
}
.course_btn:hover {
background: black;
color:white;
}


.creator_imagelogo_data{
 width:60px;
 height:60px;
}

/* make modal appear at center of the page */
.modal-appear-center {
margin-top: 25%;
//width:40%;
}


/* make modal appear at center of the page */
.modal-appear-center1 {
margin-top: 15%;
//width:40%;
}


.modal_head_color{
background-color: fuchsia;
padding: 6px;
color:white;
}


.modal_footer_color{
background-color: fuchsia;
padding: 6px;
color:white;
}


/* footer */


  .navbar_footer {
letter-spacing: 1px;
    font-size: 14px;
    border-radius: 0;
    margin-bottom: 0;
    //background-color:fuchsia;
    color:white;
    padding:20px;
    border: 0;
    font-family: comic sans ms;
  }


.footer_bgcolor{
background: black;
}

.footer_text1{
color:white;
font-size:20px;
border:none;
cursor:pointer;
}

.footer_text2{
color:grey;
font-size:14px;
border:none;
cursor:pointer;
}

.footer_text1:hover{
color:grey;
}


.footer_text2:hover{
color:orange;
}


.footer_dashedline{
 border-top: 1px dashed white;
}




			
</style>





    </head>
    <body>

 
</head>
<body>




<!-- start column nav-->


<div class="text-center">
<nav class="navbar navbar-fixed-top">
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






    </div>
  </div>



</nav>


    </div><br /><br />

<!-- end column nav-->














<br><br>








        <div class="row">



<!--Start Right-->
<div class='col-sm-12 well'>







<script>
$(document).ready(function(){
$('#install_btn').click(function () {

var accesss_code = $('#accesss_code').val();

 if(accesss_code==""){
alert('Access Code cannot be Empty');
}



else{


$("#loader-install").fadeIn(400).html('<br><div style="color:black;background:#ddd;padding:10px;"><img src="loader.gif">&nbsp;Please Wait,  Openshift Mysql  Tables is being Installed...</div>');
var datasend = {accesss_code:accesss_code};



	
		$.ajax({
			
			type:'POST',
			url:'db_installation_action.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){

$("#loader-install").hide();
$("#result-install").html(msg);
//setTimeout(function(){ $("#result-install").html(''); }, 5000);


	
}
			
		});
		
		}

});

});





</script>



<center><h2>  Apps  Tables Creation & Installations System...</h2></center><br>

&nbsp;&nbsp; Installations will automatically Check your Apps connection  to <b>Openshift Mysql  Cloud Database</b> and Create all tables needed to run  the application

<br><br>



 <div class="form-group">
              <label> Access Code: &nbsp;&nbsp;&nbsp; <span style='color:purple'>openshift2023</span></label>


<div style='background:#800000;padding:8px;color:white;border:none;'>If you are an Admin. 
You can always change this Access Code to anything by editing <b>db_installation_action.php</b> at code line <b>21</b>
</div>
<br>

              <input type="text" class="col-sm-12 form-control" id="accesss_code" name="accesss_code" placeholder="Enter Access Code" value="openshift2023" >
            </div>

<br><br>
<div id="loader-install"></div>
<div id="result-install"></div>
<br>

                   <input type="button" id="install_btn" class="btn btn-primary install_btn" value="Install Now!" />



<br><br>

<span style='color:red'><b>Special Warning:</b> As Admin, Its recommended that you always change your installation access code as stated above.<br><br>

However, the Best option will be to Manually Delete this 2 php installation scripts after you have successfully created and install your
<b>Openshift Mysql Tables</b> to keep your app safe.  here are the 2 scripts <b>( db_installation.php and db_installation_action.php )</b></span>


<br>



</div>
<!--End Right-->








</div>
<!--Row-->











<!-- footer Section start -->

<footer class=" navbar_footer text-center footer_bgcolor">

<div class="row">
        <div class="col-sm-12">

<p class="footer_text1">OpenShift 2023 App Contest</p>


        </div>



        </div>

<br/>
  <p></p>
</footer>

<!-- footer Section ends -->




   
</body>
</html>


