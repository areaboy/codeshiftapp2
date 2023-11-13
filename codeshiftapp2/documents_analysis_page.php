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
  <meta name="keywords" content="landing page, website design" />
  <script src="scripts/jquery.min.js"></script>
  <script src="scripts/bootstrap.min.js"></script>
<link type="text/css" rel="stylesheet" href="scripts/bootstrap.min.css">

<link type="text/css" rel="stylesheet" href="scripts/store.css">
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

<center><h3 style='color:purple;'> ChatGPT AI Documents Analysis Page</h3></center>




<button data-toggle="modal" data-target="#myModal_translate" class="cat_cssa" title='Translate Documents Via ChatGPT AI'>
Translate This  Documents Via ChatGPT AI</button>
</div></div>
<script>

// clear Modal div content on modal closef closed
$(document).ready(function(){


$("#myModal_medication").on("hidden.bs.modal", function(){
    //$(".modal-body").html("");
 $('.mydata_empty3').empty(); 
//$('#q').val(''); 
});

});

<?php 
$id = strip_tags($_GET['id']); 
$tm = strip_tags($_GET['tm']); 

?>

// loads documents extracted Text

$(document).ready(function(){

var id='<?php echo $id; ?>';
var tm ='<?php echo $tm; ?>';

if(id == ''){
alert('Documents ID Cannot be Empty..');
return false;
}

if(tm == ''){
alert('Documents Identity Cannot be Empty..');
return false;
}


$('#loader_docs').fadeIn(400).html('<br><div style="color:black;background:#ddd;padding:10px;"><img src="ajax-loader.gif">&nbsp;Please Wait, Loading Extracted Documents Text...</div>');
var datasend = {id:id, tm:tm};	
		$.ajax({
			
			type:'POST',
			url:'documents_extracted_text_load.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){


                        $('#loader_docs').hide();

$('#result_docs').fadeIn('slow').html(msg);

			}
			
		});
		
					
});
</script>




<div class='row'>

<div class='col-sm-4 well'>



<div id="loader_docs"></div>
<div id="result_docs"></div>

</div>



<div class='col-sm-4 well'>
<h3>Step 2:</h3>
<h4 style='color:#800000'> Signing Text Documents AI Analysis</h4>




<script>


$(document).ready(function(){
$('#send_btn').click(function(){
		
var idx='<?php echo $id; ?>';
var tmx ='<?php echo $tm; ?>';
var sentiments = $(".sentiments:checked").val();
var keyphrases = $(".keyphrases:checked").val();
var summary = $(".summary:checked").val();
var entity = $(".entity:checked").val();
var generte= $(".generte:checked").val();

if(idx==""){
alert('Documents Id is Empty.');
}


else if(tmx==""){
alert('Documents Identity is Empty.');
}

else if(sentiments==undefined){
alert('please Select If You want to Perform Sentiments Analysis of the Text Documents');
}


else if(summary==undefined){
alert('please Select If You want to Perform summary Analysis of  Text Documents');
}

else if(entity==undefined){
alert('please Select If You want to Perform Entity Analysis of the Text Documents');
}


else{

$('#loader_o').fadeIn(400).html('<br><div style="color:black;background:#ddd;padding:10px;"><img src="ajax-loader.gif">&nbsp;Please Wait, Sending and Processing Your Text Documents via ChatGPT AI...</div>');
var datasend = {idx:idx,tmx:tmx,sentiments:sentiments, summary:summary, keyphrases:keyphrases, entity:entity, generte:generte};	
		$.ajax({
			
			type:'POST',
			url:'documents_analysis_send.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){


                        $('#loader_o').hide();
				//$('#result_o').fadeIn('slow').prepend(msg);

$('#result_o').fadeIn('slow').html(msg);

			//$('#documents').val('');
			}
			
		});
		
		}
		
	})
					
});




</script>

<style>


.ai_css{
background:fuchsia;
color:white;
padding:6px;
cursor:pointer;
border:none;
border-radius:20%;
//font-size:12px;
height:40px;
}

.ai_css:hover{
background: orange;
color:black;

}




.cat_cssa{
background: #ec5574;
color:white;
padding:6px;
cursor:pointer;
border:none;
border-radius:25%;
font-size:12px;
}

.cat_cssa:hover{
background: black;
color:white;

}

.cssx{
background:fuchsia;color:white;padding:6px;border:none;border-radius:25%;
}


.cssx:hover{
background: black;
color:white;

}


</style>
      


<p>


        <div class="well">
    		<label style='color:purple'>Document Sentiments Analysis Via ChatGPT AI</label><br>
Easily analyze Documents  for <b>Positivity, negativity or neutrality</b> statements.<br>

<div class='col-sm-6 ai_css'>
<input type="radio" id="sentiments" name="sentiments" value="yes" class="sentiments" />Yes <br>
</div>


<div class='col-sm-6 ai_css'>
<input type="radio" id="sentiments" name="sentiments" value="no" class="sentiments" checked/>No<br>
</div>

</div>




        <div class="well">
    		<label style='color:purple'>Document Keywords, Keyphrases and Entities Analysis Via ChatGPT</label><br>
Discover all the <b>keywords and keyphrases</b> in the Documents.<br>
Easily analyze documents to list all the <b>People, Persons, Organisations, Companies, Locations and all the entities</b> involved in the Documents<br>


<div class='col-sm-6 ai_css'>
<input type="radio" id="keyphrases" name="keyphrases" value="yes" class="keyphrases" />Yes <br>
</div>


<div class='col-sm-6 ai_css'>
<input type="radio" id="keyphrases" name="keyphrases" value="no" class="keyphrases" checked/>No<br>
</div>

</div>



 <div class="well">
    		<label style='color:purple'>Document Summary Analysis Via ChatGPT AI</label><br>
Easily <b>summarize Documents</b>  to help <b>save time and energy</b><br>


<div class='col-sm-6 ai_css'>
<input type="radio" id="summary" name="summary" value="yes" class="summary" />Yes <br>
</div>


<div class='col-sm-6 ai_css'>
<input type="radio" id="summary" name="summary" value="no" class="summary" checked/>No<br>
</div>

</div>



 <div class="well" style='display:none;'>
    		<label style='color:purple'>Document Content/Insight Analysis Via ChatGPT AI Cohere Generte</label><br>
Easily get New Relevants Content/Insight about the Documents<br>


<div class='col-sm-6 ai_css'>
<input type="radio" id="generte" name="generte" value="yes" class="generte" />Yes <br>
</div>


<div class='col-sm-6 ai_css'>
<input type="radio" id="generte" name="generte" value="no" class="generte" checked/>No<br>
</div>

</div>






        <div class="well" style='display:none'>
    		<label style='color:purple'>Documents Entity Analysis</label><br>
Easily analyze documents to list all the <b>People, Persons, Organisations, Companies, Locations and all the entities</b> involved<br>

<div class='col-sm-6 ai_css'>
<input type="radio" id="entity" name="entity" value="yes" class="entity"/>Yes <br>
</div>


<div class='col-sm-6 ai_css'>
<input type="radio" id="entity" name="entity" value="no" class="entity" checked/>No<br>
</div>

</div>




<div class="form-group">

                    <br>
<div id="loader_o"></div>

<div id="result_o"></div><br>

<button type="button" id="send_btn" class="cat_cssa"  >Analyze Documents Via ChatGPT AI</button><br><br>


</div>


</p>


</div>


<div class='col-sm-4 well'>
<h3>Step 3:</h3>
<h4 style='color:#800000'> Ask ChatGPT AI Any Question</h4>
You have any <b>Question</b> about the Signing Documents. Please ask ChatGPT AI for further explanation. Eg. 
<span style='color:red'>Ask ChatGPT to explain any<b> keywords, Keyphrases or any
sentences etc.</b> you don't understand about the documents</span><br><br>


<script>
$(document).ready(function(){
$('#generate_chatgpt_btn').click(function(){
		
var question = $('.question').val();

if(question==""){
alert('ChatGPT Question Cannot be empty.');

}

else{

$('#loader_chatgpt').fadeIn(400).html('<br><div style="color:black;background:#ddd;padding:10px;"><img src="ajax-loader.gif">&nbsp;Please Wait, ChatGPT Generation Response...</div>');
var datasend = {question:question};	
		$.ajax({
			
			type:'POST',
			url:'documents_ask_chatgpt.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){


                        $('#loader_chatgpt').hide();
				//$('#result_chatgpt').fadeIn('slow').prepend(msg);

$('#result_chatgpt').fadeIn('slow').html(msg);

			//$('#documents').val('');
			}
			
		});
		
		}
		
	})
					
});
</script>



<p>


<div class="col-sm-12 form-group" style='background:#f1f1f1; padding:16px;color:black'>
<label>Enter Question</label>


<textarea class="form-control question"cols="5" cols="5"  placehoder="Ask ChatGPT Any Question Regarding Your Signing Documents">Eg. What is Mutual Contract Agreement</textarea>


            </div>

<br>



<div class="form-group">

                    <br>
<div id="loader_chatgpt"></div>

<div id="result_chatgpt"></div><br>

<button type="button" id="generate_chatgpt_btn" class="cat_cssa"  >Ask ChatGPT Now</button><br><br>


</div>


</p>



</div>





</div>







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

// loads

$(document).ready(function(){

var idx2='<?php echo $id; ?>';
var tmx2 ='<?php echo $tm; ?>';
$('#loader_sign').fadeIn(400).html('<br><div style="color:black;background:#ddd;padding:10px;"><img src="ajax-loader.gif">&nbsp;Please Wait, Loading Documents Details...</div>');
var datasend = {id:idx2, tm:tmx2};	
		$.ajax({
			
			type:'POST',
			url:'documents_extracted_text_load2.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){


                        $('#loader_sign').hide();

$('#result_sign').fadeIn('slow').html(msg);


			}
			
		
});					
});



$(document).ready(function(){
$('#sg_btn').click(function(){


var sign_title= $('.sign_title').val();
var sign_subject= $('.sign_subject').val();
var sign_message= $('.sign_message').val();
var sign_name= $('.sign_name').val();
var sign_email= $('.sign_email').val();
		
var idx3='<?php echo $id; ?>';
var tmx3 ='<?php echo $tm; ?>';

if(sign_title==""){
alert('Documents Title Cannot be Empty.');
}
else if(sign_subject==""){
alert('Subject Cannot be Empty.');
}

else if(sign_message==""){
alert('Message Cannot be Empty.');
}
else if(sign_name==""){
alert('Signer Name Cannot be Empty.');
}
else if(sign_email==""){
alert('Signer Email Cannot be Empty.');
}

else{

$('#loader_sg').fadeIn(400).html('<br><div style="color:black;background:#ddd;padding:10px;"><img src="ajax-loader.gif">&nbsp;Please Wait, Sending Documents for Signing...</div>');
var datasend = {id:idx3, tm:tmx3, sign_title:sign_title, sign_subject:sign_subject, sign_message:sign_message, sign_name:sign_name, sign_email:sign_email};	
		$.ajax({
			
			type:'POST',
			url:'documents_signing_send_signature.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){
                        $('#loader_sg').hide();
                        $('#result_sg').html(msg);
//setTimeout(function(){ $('#result_sg').html(''); }, 9000);

/*

//strip all html elemnts using jquery
var html_stripped = jQuery(msg).text();
//check occurrence of word (successful) from backend output already html stripped.
var Frombackend = html_stripped;
var bcount = (Frombackend.match(/successful/g) || []).length;
if(bcount > 0){
//$('.sign_title').val('');
//$('.sign_subject').val('');
//$('.sign_message').val('');
$('.sign_name').val('');
$('.sign_email').val('');
}
*/

			}
			
		});
		
		}
		
	})
					
});


</script>




<!--docs  Modal start -->

<div id="myModal_docs" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header"   style='background:purple;color:white;padding:10px;'>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Send Document For Signing</h4>
      </div>
      <div class="modal-body">
        <p>  <div class="form-group">
			<div id="loader_sign"></div>
                        <div id="result_sign"></div>
                       </div>



<div class="col-sm-12 form-group">
<label>Document Subject</label>
<input type='text' class="form-control sign_subject" placeholder="Document Title"  value='This is Signing Document we Talk about' />
</div><br>



<div class="col-sm-12 form-group">
<label>Message</label>
<textarea rows="3" cols="3" class="form-control sign_message" placeholder="Message">
 Please Sign This Documents</textarea>
</div><br>

<div class="col-sm-12 form-group">
<label>Signer Name</label>
<input type='text' class="form-control sign_name" placeholder="Signer Name"  value='Esedo Fredrick' />
</div><br>

<div class="col-sm-12 form-group">
<label>Signer Email</label>
<input type='text' class="form-control sign_email" placeholder="Signer Email"  value='esedofredrick@gmail.com' />
</div><br>


<div class="form-group">
			<div id="loader_sg"></div>
</div>
<div class="form-group">
                        <div id="result_sg"></div>
                       </div>


<div class="form-group">
<button type="button" id="sg_btn" class="btn btn-primary cat_cssa"  >Send</button><br><br>
</div>






</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- docs Modal ends -->





<script>

// loads

$(document).ready(function(){

var idx2a='<?php echo $id; ?>';
var tmx2a ='<?php echo $tm; ?>';
$('#loader_sign2').fadeIn(400).html('<br><div style="color:black;background:#ddd;padding:10px;"><img src="ajax-loader.gif">&nbsp;Please Wait, Loading Documents Details...</div>');
var datasend = {id:idx2a, tm:tmx2a};	
		$.ajax({
			
			type:'POST',
			url:'documents_extracted_text_load3.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){


                        $('#loader_sign2').hide();

$('#result_sign2').fadeIn('slow').html(msg);


			}
			
		
});					
});




$(document).ready(function(){
$('#trans_btn').click(function(){
		
var trans_language = $('.trans_language').val();

var idx4a='<?php echo $id; ?>';
var tmx4a ='<?php echo $tm; ?>';

if(trans_language==""){
alert('Translating Language Cannot be empty.');

}

else{

$('#loader_trans').fadeIn(400).html('<br><div style="color:black;background:#ddd;padding:10px;"><img src="ajax-loader.gif">&nbsp;Please Wait, ChatGPT Translating Documents...</div>');
var datasend = {trans_language:trans_language, id:idx4a, tm:tmx4a};	
		$.ajax({
			
			type:'POST',
			url:'documents_chatgpt_translate.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){


                        $('#loader_trans').hide();
				//$('#result_trans').fadeIn('slow').prepend(msg);

$('#result_trans').fadeIn('slow').html(msg);

			//$('#documents').val('');
			}
			
		});
		
		}
		
	})
					
});
</script>





<!--ChatGPT Translate Modal Starts -->

<div id="myModal_translate" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header"   style='background:purple;color:white;padding:10px;'>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Translate Documents Via ChatGPT AI</h4>
      </div>
      <div class="modal-body">
        <p>  

Leveraging <b>ChatGPT</b> to easily translate documents to any Languages in the World...<br>

<div class="form-group">
			<div id="loader_sign2"></div>
                        <div id="result_sign2"></div>
                       </div>


<div class='col-sm-12 form-group'>
<b>From Language: </b> English<br><br>


<label>To Language(Translating Language)</label>
<select class='form-control trans_language' placeholder='Enter Translating Language'>
<option value=''>--Select--</option>
<option value='Spanish'>Spanish</option>
<option value='Hindi'>Hindi</option>
<option value='Arabic'>Arabic</option>
<option value='French'>French</option>
<option value='Portuguese'>Portuguese</option>
<option value='Bengali'>Bengali</option>
<option value='Russian'>Russian</option>
<option value='Japanese'>Japanese</option>
<option value='German'>German</option>
<option value='Korean'>Korean</option>
<option value='Indonesian'>Indonesian</option>
<option value='Italian'>Italian</option>
<option value='Viatnameese'>Viatnameese</option>
<option value='Urdu'>Urdu</option>
<option value='Telugu'>Telugu</option>
<option value='Chinese'>Chinese</option>
<option value='Turkish'>Turkish</option>
<option value='English'>English</option>
<option value='Latin'>Latin</option>

</select>
</div>



<div class="form-group">
			<div id="loader_trans"></div>
                        <div id="result_trans"></div>
                       </div>
<div class="form-group">
<button type="button" id="trans_btn" class="btn btn-primary cat_cssa"  >Translate Now</button><br><br>
</div>


</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- ChatGPT Translate Modal ends -->





</div>

</body>
</html>
