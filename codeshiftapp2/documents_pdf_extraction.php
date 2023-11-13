
<?php

ini_set('max_execution_time', 300); //300 seconds = 5 minutes
// temporarly extend time limit
set_time_limit(300);

error_reporting(0);


if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

include('data6rst.php');
include('settings.php');


$timer= strip_tags($_POST['timer']);
$document_id= strip_tags($_POST['d_id']);
$file_name= strip_tags($_POST['file_name']);

// Include Composer autoloader if not already done.
include './pdfparser/vendor/autoload.php';

// Parse pdf file and build necessary objects.
$parser = new \Smalot\PdfParser\Parser();
$pdf    = $parser->parseFile("uploads/$file_name");

$text = $pdf->getText();
$text;

if($text !=''){


$stmt = $db->prepare('UPDATE documents SET document_extraction = :document_extraction where id = :id');
$stmt->execute(array(
':document_extraction' => $text,
':id' => $document_id
    ));


echo "<div style='color:white;background:green;padding:10px;'>PDF File Documents Extraction Successful</div>";
echo  "<script>alert('PDF File Documents Extraction Successful...');</script>";
echo "<script>location.reload();</script>";

}
else {
echo "<div style='color:white;background:red;padding:10px;'>PDF File Documents Extraction Failed. Please Check Internet Connections</div>";
}   


}
else{
echo "<div id='' style='background:red;color:white;padding:10px;border:none;'>
Direct Page Access not Allowed<br></div>";
}


?>
