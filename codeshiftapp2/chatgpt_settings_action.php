<?php


session_start();
include ('authenticate.php');
include ('settings.php');

$userid_sess=  htmlentities(htmlentities($_SESSION['uid'], ENT_QUOTES, "UTF-8"));
$fullname_sess =  htmlentities(htmlentities($_SESSION['fullname'], ENT_QUOTES, "UTF-8"));
$token_sess =   $userid_sess;
$email_sess =  htmlentities(htmlentities($_SESSION['email'], ENT_QUOTES, "UTF-8"));



if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

//error_reporting(0);
$api_key = strip_tags($_POST['api_key']);



if($api_key ==''){

echo "<div  style='background:red;color:white;padding:10px;border:none;'>ChatGPT API KEY to Check Cannot be Empty</div><br>";
exit();
}


include('data6rst.php');

$api_key_x = trim($api_key);

$stmt = $db->prepare('UPDATE users SET api_key = :api_key where id = :id');
$stmt->execute(array(
':api_key' => $api_key_x,
':id' => $userid_sess
    ));





if($stmt){
echo "<div id='' style='background:green;color:white;padding:10px;border:none;'>ChatGPT API KEY Successfully Updated..</div>";


echo "<script>alert('ChatGPT API KEY Successfully Updated..'); location.reload();</script><br><br>";


}else{

echo "<div id='' style='background:red;color:white;padding:10px;border:none;'>ChatGPT API KEY Updates Failed...</div>";

}








}
else{
echo "<div id='' style='background:red;color:white;padding:10px;border:none;'>
Direct Page Access not Allowed<br></div>";
}


?>