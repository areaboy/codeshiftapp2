  <script src="jquery.min.js"></script>
<?php
error_reporting(0);
session_start();
$userid_sess =  htmlentities(htmlentities($_SESSION['uid'], ENT_QUOTES, "UTF-8"));

include('data6rst.php');

$result_verified = $db->prepare('select * from users where id=:id');
$result_verified->execute(array(':id' =>$userid_sess));
$rowv = $result_verified->fetch();
$count = $result_verified->rowCount();

$chatgpt_accesstoken = $rowv['api_key'];


if($chatgpt_accesstoken !=''){

echo "<div id='' style='background:green;color:white;padding:10px;border:none;'>ChatGPT API Key already updated and set</div>";

}else{

echo "<div id='' style='background:red;color:white;padding:10px;border:none;'>Please Set Update Your ChatGPT API Key Or Ask Admin to Do it</div>";
exit();
}



if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {



if($chatgpt_accesstoken ==''){
echo "<div  style='background:red;color:white;padding:10px;border:none;'>Please Ask Admin to Set ChatGPT Access Token at <b>settings.php</b> File</div><br>";
exit();
}


$documents_id= strip_tags($_POST['idx']);
$documents_time= strip_tags($_POST['tmx']);
$sentiments= strip_tags($_POST['sentiments']);
$keyphrases= strip_tags($_POST['keyphrases']);
$entity= strip_tags($_POST['entity']);
$summary= strip_tags($_POST['summary']);
$generte= strip_tags($_POST['generte']);

if($documents_id == ''){
echo "<div style='background:red;color:white;padding:10px;border:none;'>Documents ID is Empty</div><br>";
exit();
}

if($documents_time == ''){
echo "<div style='background:red;color:white;padding:10px;border:none;'>Documents ID 2 is Empty</div><br>";
exit();
}


$result_verified = $db->prepare('select * from documents where id=:id and timing = :timing');
$result_verified->execute(array(':id' =>$documents_id, ':timing' =>$documents_time));
$row = $result_verified->fetch();
$count = $result_verified->rowCount();

$docs =$row['document_extraction'];
$docs_name = $row['document_name'];



// sanitize Extracted Text documents

//$doc1 = str_replace("'", '', $docs);
//$doc2 = str_replace('"', '', $doc1);
//$doc3 = str_replace("’", '', $doc2);
//$message1 =  str_replace("_", '', $doc3);
//$message = trim(str_replace("\r\n", "", $message1));


$message = preg_replace('/[^A-Za-z0-9,. ]/', '', $docs);

//$message = 'I am feeling sad: about the products';


if($count != 1){
echo "<div id='' style='background:red;color:white;padding:10px;border:none;'>Extracted Text Documents Not Found</div>";
exit();
}



// start ajax call



if($count == '1'){

//echo "<div style='background:green;color:white;padding:10px;border:none;'> Documents Found</div><br>";







// Documents Text  Keywords and keyphrases Analysis starts Here
if($keyphrases == 'yes'){


echo "
<script>
$(document).ready(function(){

var msg_text  = '0';
var docs_id ='$documents_id';
var docs_identity = '$documents_time';



$('#loader_keyphrases').fadeIn(400).html('<br><div style=color:black;background:#ddd;padding:10px;><img src=loader.gif style=font-size:20px> &nbsp;Please Wait!. Documents Keyword and KeyPhrases Analysis via ChatGPT </div>');
var datasend = {msg_text:'msg_text',docs_id:docs_id, docs_identity:docs_identity};


$.ajax({
			
			type:'POST',
			url:'documents_chatgpt_keyphrases.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){

                        $('#loader_keyphrases').hide();
				//$('#result_keyphrases').fadeIn('slow').prepend(msg);
                                 $('#result_keyphrases').html(msg);



			
			}
			
		});
		
					
	});


</script>




<br>
<div class='well'>
<div id='loader_keyphrases'></div>
<div id='result_keyphrases'></div>
</div>

";

}


// Documents Text Summary Analysis ends





// Documents Text  Summary Analysis starts Here
if($summary == 'yes'){


echo "
<script>
$(document).ready(function(){

var msg_text  = '0';
var docs_id ='$documents_id';
var docs_identity = '$documents_time';



$('#loader_summmary').fadeIn(400).html('<br><div style=color:black;background:#ddd;padding:10px;><img src=loader.gif style=font-size:20px> &nbsp;Please Wait!. Summarizing Text Document via Chatgpt AI </div>');
var datasend = {msg_text:'msg_text',docs_id:docs_id, docs_identity:docs_identity};


$.ajax({
			
			type:'POST',
			url:'documents_chatgpt_summary.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){

                        $('#loader_summmary').hide();
				//$('#result_summmary').fadeIn('slow').prepend(msg);
                                 $('#result_summmary').html(msg);



			
			}
			
		});
		
					
	});


</script>




<br>
<div class='well'>
<div id='loader_summmary'></div>
<div id='result_summmary'></div>
</div>

";

}


// Documents Text Summary Analysis ends









// Documents Text Generte Analysis starts Here
if($generte == 'yes'){


echo "
<script>
$(document).ready(function(){

var msg_text  = '0';
var docs_id ='$documents_id';
var docs_identity = '$documents_time';



$('#loader_generte').fadeIn(400).html('<br><div style=color:black;background:#ddd;padding:10px;><img src=loader.gif style=font-size:20px> &nbsp;Please Wait!. Generating Text Document Insight via ChatGPT Generte</div>');
var datasend = {msg_text:'msg_text',docs_id:docs_id, docs_identity:docs_identity};


$.ajax({
			
			type:'POST',
			url:'documents_chatgpt_generte.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){

                        $('#loader_generte').hide();
				//$('#result_generte').fadeIn('slow').prepend(msg);
                                 $('#result_generte').html(msg);



			
			}
			
		});
		
					
	});


</script>




<br>
<div class='well'>
<div id='loader_generte'></div>
<div id='result_generte'></div>
</div>

";

}


// Documents Text generte  Analysis ends








// Documents  Text  Entity Analysis starts Here
if($entity == 'yes'){

echo "
<script>
$(document).ready(function(){

var msg_text  = '0';
var docs_id ='$documents_id';
var docs_identity = '$documents_time';

$('#loader_entity').fadeIn(400).html('<br><div style=color:black;background:#ddd;padding:10px;><img src=loader.gif style=font-size:20px> &nbsp;Please Wait!. Documents Entity Analysis via ChatGPT</div>');
var datasend = {msg_text:msg_text,docs_id:docs_id, docs_identity:docs_identity};


$.ajax({
			
			type:'POST',
			url:'documents_chatgpt_entities.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){

                        $('#loader_entity').hide();
		        //$('#result_entity').fadeIn('slow').prepend(msg);
                        $('#result_entity').html(msg);

			
			}
			
		});
					
	});


</script>




<br>
<div class='well'>
<div id='loader_entity'></div>
<div id='result_entity'></div>
</div>

";

}


// Documents Text Entity  Analysis ends









// Documents Text  Sentiments Analysis starts Here
if($sentiments == 'yes'){

echo "
<script>
$(document).ready(function(){

var msg_text  = '0';
var docs_id ='$documents_id';
var docs_identity = '$documents_time';

$('#loader_sentiments').fadeIn(400).html('<br><div style=color:black;background:#ddd;padding:10px;><img src=loader.gif style=font-size:20px> &nbsp;Please Wait! .Analyzing Documents for Sentimentss via chatgpt</div>');
var datasend = {msg_text:msg_text,docs_id:docs_id, docs_identity:docs_identity};


$.ajax({
			
			type:'POST',
			url:'documents_chatgpt_sentiments.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){

                        $('#loader_sentiments').hide();
				//$('#result_sentiments').fadeIn('slow').prepend(msg);
$('#result_sentiments').html(msg);



			
			}
			
		});
					
	});


</script>




<br>
<div class='well'>
<div id='loader_sentiments'></div>
<div id='result_sentiments'></div>
</div>

";

}


// Documents Text  Sentiments Analysis ends





}

// end ajax call




}
else{
echo "<div id='' style='background:red;color:white;padding:10px;border:none;'>
Direct Page Access not Allowed<br></div>";
}


?>