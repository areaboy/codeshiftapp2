
<?php


ini_set('max_execution_time', 300); //300 seconds = 5 minutes
// temporarly extend time limit
set_time_limit(300);

error_reporting(0);


session_start();
include ('authenticate.php');

$userid =  htmlentities(htmlentities($_SESSION['uid'], ENT_QUOTES, "UTF-8"));
$fullname =  htmlentities(htmlentities($_SESSION['fullname'], ENT_QUOTES, "UTF-8"));
$email =  htmlentities(htmlentities($_SESSION['email'], ENT_QUOTES, "UTF-8"));


if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

include('settings.php');
include('data6rst.php');
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


//$document_extraction_replaced = str_replace(".", '.<br>', $docs);
echo "<div class=''>
<h4 style='color:#800000'>Signing Documents</h4>

<b>Documents Title:</b> $docs_title<br>
<b>Documents Filename: </b><a href='uploads/$docs_name'>$docs_name</a><br><br>


<div class='col-sm-12 form-group'>
<label>Document Title</label>
<input type='text' class='form-control sign_title' placeholder='Document Title'  value='$docs_title'/>
</div>

</div>";



}
else{
echo "<div id='' style='background:red;color:white;padding:10px;border:none;'>
Direct Page Access not Allowed<br></div>";
}



?>
