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
<nav class="navbar navbar-fixed-top" style='background:purple'>
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
<button data-toggle="modal" data-target="#myModal_document" class="invite_btnx btn btn-warning" title='Upload Files & Documents'>Upload Files & Documents</button>
</li>

<li class="navgate">

<button class="invite_btnx btn btn-warning"><a style="color:white;" href='chatgpt_settings.php' title='Set ChatGPT Access Token'>Set ChatGPT <br>Access Token</a></button>

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
<div class='col-sm-12 well'>
<h3>Users Info</h3>
<b>Name: </b><?php echo htmlentities(htmlentities($fullname_sess, ENT_QUOTES, "UTF-8")); ?>
</div></div>









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



<script>

// clear Modal div content on modal closef closed
$(document).ready(function(){


$("#myModal_medication").on("hidden.bs.modal", function(){
    //$(".modal-body").html("");
 $('.mydata_empty3').empty(); 
//$('#q').val(''); 
});

});

</script>




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





&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Search Documents and Files by <b>Title, Category and Documents Filename...</b><br><br>


<div class="container">
<div class="row">
<div class="col-sm-12 table-responsive">
<div class="alert_server_response"></div>
<div class="loader_x"></div>
<table id="bc" class="table table-bordered table-striped">
<thead><tr>
<th>Document Title</th>
<th>Document Name</th>
<th>Category</th>
<th>Extracted Text of Signing Documents</th>
<th>Uploaded Time</th>
<th>Analyze Via AI & Send Documents for Signing</th>
</tr></thead>
</table>
</div>
</div>
</div>






<span class="alert_server_response"></span>
<span class="loader_x"></span>

<script>
$(document).ready(function(){

var get_content = 'get_data';
var backup_type = 'g';
if(get_content=="" && backup_type==""){
alert('There is an Issue with Content Database Retrieval');
}
else{
$('.loader_x').fadeIn(400).html('<br><div style="background:#ccc;color:black; width:100%;height:30%;text-align:center"><img src="ajax-loader.gif">&nbsp;Please Wait, Your Data is being Loaded</div>');
		
 var bck = $('#bc').DataTable({
  "processing":true,
  "serverSide":true,
  "order":[],
  "ajax":{
   url:"documents_load.php",
   type:"POST",
   data:{get_content:get_content, backup_type:backup_type}
  },
  "columnDefs":[
   {
    "orderable":false,
   },
  ],
  "pageLength": 10
 });

if(bck !=''){
$('.loader_x').hide();
}

}

 
});

</script>


</div>









<script>

function imagePreview(e) 
{
 var readImage = new FileReader();
 readImage.onload = function()
 {
  var displayImage = document.getElementById('imageupload_preview');
  displayImage.src = readImage.result;
 }
 readImage.readAsDataURL(e.target.files[0]);
}


            $(function () {
                $('#save_btn').click(function () {
					
                    var title = $('#title').val();
                    var file_fname = $('#file_content').val();
var category =  $(".category:checked").val();
    


 if(category==undefined){
alert('Please Select Documents Uploads Category');
//return false;
}
              
// start if validate
else if(file_fname==""){
alert('please Select File to Upload');
}


else if(title==""){
alert('please Enter File Title Name');
}

else{

var fname=  $('#file_content').val();
var ext = fname.split('.').pop();
//alert(ext);

// add double quotes around the variables
var fileExtention_quotes = ext;
fileExtention_quotes = "'"+fileExtention_quotes+"'";

 var allowedtypes = ["pdf", "PDF"];
    if(allowedtypes.indexOf(ext) !== -1){
//alert('Good this is a valid Image');
}else{
alert("Please Upload a valid PDF Documents");
return false;
    }


          var form_data = new FormData();
          form_data.append('file_content', $('#file_content')[0].files[0]);
          form_data.append('file_fname', file_fname);
          form_data.append('title', title);
          form_data.append('category', category);
        
                    $('.upload_progress').css('width', '0');

                    $('#loader').fadeIn(400).html('<br><div class="well" style="color:black"><img src="ajax-loader.gif">&nbsp;Please Wait, Documents File is being Uploaded....</div>');
                    $.ajax({
                        url: 'documents_upload.php',
                        data: form_data,
                        processData: false,
                        contentType: false,
                        ache: false,
                        type: 'POST',
                        xhr: function () {
                      //var xhr = new window.XMLHttpRequest();
                            var xhr = $.ajaxSettings.xhr();
                            xhr.upload.addEventListener("progress", function (event) {
                                var upload_percent = 0;
                                var upload_position = event.loaded;
                                var upload_total  = event.total;

                                if (event.lengthComputable) {
                                    var upload_percent = upload_position / upload_total;
                                    upload_percent = parseInt(upload_percent * 100);
                                  //upload_percent = Math.ceil(upload_position / upload_total * 100);
                                    $('.upload_progress').css('width', upload_percent + '%');
                                    $('.upload_progress').text(upload_percent + '%');
                                }
                            }, false);
                            return xhr;
                        },
                        success: function (msg) {
				$('#loader').hide();
				$('#result_data').html(msg);
				


//strip all html elemnts using jquery
var html_stripped = jQuery(msg).text();
//alert(html_stripped);

//check occurrence of word (Successful) from backend output already html stripped.
var Frombackend = html_stripped;
var bcount = (Frombackend.match(/Successful/g) || []).length;
//alert(bcount);

if(bcount > 0){
$('#file_fname').val('');
$('#title').val('');
}




                        }
                    });
} // end if validate




                });
            });



</script>
<style>
.upload_progress{
padding:10px;
background:green;
color:white;
cursor:pointer;
min-width:30px;
}

#imageupload_preview
{
max-height:200px;
max-width:200px;
}
</style>








<!--Document  Modal start -->



<div id="myModal_document" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header"  style='background:purple;color:white;padding:10px;'>
        <h4 class="modal-title">Documents and Files Uploads System</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">


Easily Upload Your Documents before sending for Signing<br><br>



        <div class="well">
    		<label>Documents Uploads Category</label><br>

<div class='col-sm-6 time_css'>
<input type="radio"  value="Employement Documents" id="category" name="category"  class="category"/>Employement Documents <br>
</div>


<div class='col-sm-6 time_css'>
<input type="radio"  value="Medical Documents" id="category" name="category" class="category"/>Medical Documents <br>
</div>




<div class='col-sm-6 time_css'>
<input type="radio" value="Contract Documents" id="category" name="category" class="category"/>Contract Documents <br>
</div>


<div class='col-sm-6 time_css'>
<input type="radio" value="Business Documents" id="category" name="category" class="category"/>Business Documents <br>
</div>

</div>

<br>
<br>




<style>
.time_css{
background:#ccc;padding:6px;border-radius:20%;
}

.time_css:hover{
background:orange;color:black;
}



</style>



   <div class="form-group">
<label style="">Select Documents File: </label>
<input style="background:#c1c1c1;" class="col-sm-12 form-control" type="file" id="file_content" name="file_content" accept="pdf/*" onchange="imagePreview(event)" />
 <img id="imageupload_preview"/>
</div><br>


<br>


 <div class="form-group">
              <label> Enter File Title: </label>
              <input type="text" class="col-sm-12 form-control" id="title" name="title" placeholder="Enter File Title" value="Contract Documents Sample 1">
            </div>




 <div class="form-group">
                            <div class="upload_progress" style="width:0%">0%</div>

                        <div id="loaderx"></div>
						<div id="loader"></div>
                        <div id="result_data"></div>
                    </div>

                    <input type="button" id="save_btn" class="pull-right btn btn-primary" value="Upload File" />
 	





</p>


<br>
      </div>
<br><br>
</div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- Documents Modal ends -->










<script>
$(document).ready(function(){
//$('.btn_call').click(function(){
$(document).on( 'click', '.btn_call', function(){ 


var id = $(this).data('id');
var document_extraction = $(this).data('document_extraction');
var fullname = $(this).data('fullname');
var title = $(this).data('title');
var desc = $(this).data('desc');


$('.p_id').html(id);
$('.p_document_extraction').html(document_extraction);



$('.p_document_extraction_value').val(document_extraction).value;


});

});

</script>




<input type="hidden" class="p_id_value" value="">







<!--Read More start -->

<div id="myModal_readmore" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header"   style='background: purple;color:white;padding:10px;'>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Extracted Signing Documents Contents </h4>
      </div>

      <div class="modal-body">

        <p>  

<div class="form-group well">
<b>Extracted Signing Documents Contents:</b> <br><br><span class='p_document_extraction'></span><br>

<br>
</div>

</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- read more ends -->




</div>

</body>
</html>
