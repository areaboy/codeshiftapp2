<style>
.css_ai{
background:#ddd;color:black;padding:6px;border:none;
//margin: 0 1%;
margin: 0.2%;
  display: inline-block;
}

.css_ai:hover{
background: orange;
color:black;

}
</style>
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


$trans_language= strip_tags($_POST['trans_language']);
$documents_id = strip_tags($_POST['id']);
$documents_time = strip_tags($_POST['tm']);

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


$docs = $row['document_extraction'];
$docs_name = $row['document_name'];
$docs_title = $row['document_title'];


if($count != 1){
echo "<div id='' style='background:red;color:white;padding:10px;border:none;'>Extracted Text Documents Not Found</div>";
exit();
}



if($trans_language == ''){
echo "<div style='background:red;color:white;padding:10px;border:none;'>Please Enter Translating Language</div><br>";
exit();
}



// sanitize Extracted Text documents

// Remove special characters except comma fullstop and space
$message = preg_replace('/[^A-Za-z0-9,. ]/', '', $docs);

$text_prompt= "Translate '$message' to $trans_language";




// Make API Call to ChatGPT AI


$url ="https://api.openai.com/v1/completions";
$data_param ='
{
   "model" : "text-davinci-003",
    "prompt":  "'.$text_prompt.'",
    "max_tokens": 1000,
"n": 1
}
';


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Authorization: Bearer $chatgpt_accesstoken"));  
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_param);
//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$output = curl_exec($ch); 

if($output == ''){
echo "<div style='background:red;color:white;padding:10px;border:none;'>API Call to Chatgpt AI Failed. Ensure there is an Internet  Connections...</div><br>";
exit();
}




$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// catch error message before closing
if (curl_errno($ch)) {
   // echo $error_msg = curl_error($ch);
}

curl_close($ch);


$json = json_decode($output, true);
$id = $json["id"];

$mx_error = $json["error"]["message"];
if($mx_error != ''){
echo "<div style='background:red;color:white;padding:10px;border:none;'>Chatgpt API Error Message: $mx_error.</div><br>";
exit();
}


if($id != ''){

//echo "<div style='color:white;background:green;padding:10px;'>3 Response Successfully Generated Via Chatgpt AI. See Below</div>";

}
else {
echo "<div style='color:white;background:red;padding:10px;'>There is an Issue Generating Via Chatgpt AI. Please Check Internet Connections</div>";
exit();

}   

$countx= 1;




echo "<div style='color:white;background:green;padding:10px;'><b>ChatGPT Documents Language Translation Successful.</b></div><br>";

foreach($json['choices'] as $row){
$countxx = $countx++;

$val = $row["text"];
$val2 = str_replace(',', ',<br>', $val);
$value = str_replace('.', '<br>', $val2);

echo $res = "<div class='css_ai'>".str_replace('-', "</div><div class='css_ai'>", $val)."</div>";

}





}
else{
echo "<div id='' style='background:red;color:white;padding:10px;border:none;'>
Direct Page Access not Allowed<br></div>";
}


?>
