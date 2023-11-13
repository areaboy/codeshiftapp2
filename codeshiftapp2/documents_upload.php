<?php
error_reporting(0);

ini_set('max_execution_time', 300); //300 seconds = 5 minutes
// temporarly extend time limit
set_time_limit(300);

include ('settings.php');
include('data6rst.php');

session_start();
$userid_sess =  htmlentities(htmlentities($_SESSION['uid'], ENT_QUOTES, "UTF-8"));
$fullname_sess =  htmlentities(htmlentities($_SESSION['fullname'], ENT_QUOTES, "UTF-8"));
$token_sess =   htmlentities(htmlentities($_SESSION['token'], ENT_QUOTES, "UTF-8"));




if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

$file_content = strip_tags($_POST['file_fname']);
$title = strip_tags($_POST['title']);
$category = strip_tags($_POST['category']);


$mt_id=rand(0000,9999);
$dt2=date("Y-m-d H:i:s");
$ipaddress = strip_tags($_SERVER['REMOTE_ADDR']);
$timer = time();

$tm ="$mt_id$timer--";




if ($file_content == ''){
echo "<div style='background:red;color:white;padding:8px;border:none;'>Files Upload is empty</div>";
exit();
}


if ($title == ''){
echo "<div style='background:red;color:white;padding:8px;border:none;'>File Title is empty</div>";
exit();
}


$upload_path = "uploads/";


$filename_string = strip_tags($_FILES['file_content']['name']);
// thus check files extension names before major validations

$allowed_formats = array("pdf", "PDF");
$exts = explode(".",$filename_string);
$ext = end($exts);

if (!in_array($ext, $allowed_formats)) { 
echo "<div style='background:red;color:white;padding:8px;border:none;'> Only PDF Documents are allowed.<br></div>";
exit();
}




$fsize = $_FILES['file_content']['size']; 
$ftmp = $_FILES['file_content']['tmp_name'];
//$file_uploadname = $tm.$filename_string;
$file_uploadname = $filename_string;

if ($fsize > 30 * 1024 * 1024) { // allow file of less than 30 mb
echo "<div id='alertdata' class='alerts alert-danger'>File greater than 30mb not allowed<br></div>";
exit();
}

// Check if file already exists
if (file_exists($upload_path . $file_uploadname)) {
echo "<div style='background:red;color:white;padding:8px;border:none;'>This uploaded File <b>$file_uploadname</b> already exist<br></div>";
exit(); 
}


$allowed_types=array(
'application/json',
'application/octet-stream',
'text/plain',
'application/pdf',
'application/x-pdf'

);



if ( ! ( in_array($_FILES["file_content"]["type"], $allowed_types) ) ) {
  echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>Only PDF allowed bro..<br><br></div>";
exit();
}



//validate image using file info  method
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime = finfo_file($finfo, $_FILES['file_content']['tmp_name']);
if ( ! ( in_array($mime, $allowed_types) ) ) {
  echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>Only pdf are allowed...<br></div>";
exit();
}
finfo_close($finfo);


if (move_uploaded_file($ftmp, $upload_path . $file_uploadname)) {



/*
create table documents(id int primary key auto_increment,document_name text,category varchar(100), 
document_title text,document_extraction text,document_type varchar(20),timing varchar(20));
*/

$statement = $db->prepare('INSERT INTO documents

(document_name,category, document_title,document_extraction,document_type,timing)
 
                          values
(:document_name,:category, :document_title,:document_extraction,:document_type,:timing)');

$statement->execute(array( 
':document_name' => $file_uploadname,
':category' => $category,
':document_title' => $title,		
':document_extraction' =>'0',
':document_type' =>'Dropbox',
':timing' => $timer
));

$document_id = $db->lastInsertId();
                                   


//echo  "<script>alert('File Uploads Successful...');</script>";
echo "<br><div style='background:green;padding:8px;color:white;border:none;'>step 1.) File Uploads Successful...</div><br>";
//echo "<script>location.reload();</script>";



echo "
<script>
$(document).ready(function(){

var timer  = '$timer';
var d_id = '$document_id';
var file_name = '$file_uploadname';


if(timer==''){
alert('File Documents Cannot be Empty');

}

else{

$('#loader_ex').fadeIn(400).html('<br><div style=color:black;background:#ddd;padding:10px;><img src=loader.gif style=font-size:20px> &nbsp;Please Wait! .Extracting Text from the Uploaded Files and Documents</div>');
var datasend = {timer:timer,d_id:d_id, file_name:file_name};


$.ajax({
			
			type:'POST',
			url:'documents_pdf_extraction.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){

                        $('#loader_ex').hide();
				//$('#result_ex').fadeIn('slow').prepend(msg);
$('#result_ex').html(msg);



			
			}
			
		});
		
		}
		
					
	});


</script>




<br>
<div class='well'>
<div id='loader_ex'></div>
<div id='result_ex'></div>
</div>

";



}else{
echo "<div style='background:red;padding:8px;color:white;border:none;'>File Uploads Failed...</div>";

}


}
else{
echo "<div id='' style='background:red;color:white;padding:10px;border:none;'>
Direct Page Access not Allowed<br></div>";
}


?>



