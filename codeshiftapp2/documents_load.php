
<?php 

if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

include('data6rst.php');
$document_type ='Dropbox';



// get total count
$pstmt = $db->prepare('SELECT * FROM documents where document_type=:document_type');
$pstmt->execute(array(':document_type' =>$document_type));
$total_count = $pstmt->rowCount();

// ensure that they cotain only alpha numericals
if(strip_tags(isset($_POST["get_content"]))){
$get_content = strip_tags($_POST["get_content"]);
if($get_content == 'get_data'){

$sql_query = '';
$error = '';
$message='';
$response_bl = array();

$sql_query .= "SELECT * FROM documents ";
if(strip_tags(isset($_POST["search"]["value"]))){

//$search_value= strip_tags($_POST["search"]["value"]);
$search_value1= strip_tags($_POST["search"]["value"]);
$search_value=  htmlentities(htmlentities($search_value1, ENT_QUOTES, "UTF-8"));
$sql_query .= 'WHERE (document_type =:document_type) AND  (document_name LIKE "%'.$search_value.'%"  OR  category LIKE "%'.$search_value.'%" OR document_title LIKE "%'.$search_value.'%")';
  }


//ensure that order post is set
$start = $_POST['start'];
$length = $_POST['length'];
$draw= $_POST["draw"];
if(strip_tags(isset($_POST["order"]))){
$order_column = strip_tags($_POST['order']['0']['column']);
$order_dir = strip_tags($_POST['order']['0']['dir']);

$sql_query .= 'ORDER BY '.$order_column.' '.$order_dir.' ';
}
else{
$sql_query .= 'ORDER BY id DESC ';
}
if($length != -1){
$sql_query .= 'LIMIT ' . $start . ', ' . $length;
}

$pstmt = $db->prepare($sql_query);
$pstmt->execute(array(':document_type' =>$document_type));
$rows_count = $pstmt->rowCount();

//$result = $pstmt->fetchAll();
//foreach($result as $row){
while($row = $pstmt->fetch()){
$rows1 = array();
$id = $row['id'];
$document_name = $row['document_name'];
$category = $row['category'];
$document_title = $row['document_title'];
$timing = $row["timing"];
$document_extraction = $row["document_extraction"];

$microcontent_document_extraction = substr($document_extraction, 0, 100)."...";
$document_extraction_replaced = str_replace("'", '', $document_extraction);
$document_extraction_replaced2 = str_replace(".", '.<br>', $document_extraction_replaced);

// remove first 100 characters of a text
$microcontent_document_extraction2 = substr($document_extraction, 100);

if($category == 'Employement Documents'){
$cat = "<div class='red_css'>Employement Documents</div>";
//$colorx ="red_css";
}

if($category == 'Medical Documents'){
$cat = "<div class='green_css'>Medical Documents</div>";
//$colorx ="red_css";
}

if($category == 'Contract Documents'){
$cat = "<div class='purple_css'>Contract Documents</div>";
//$colorx ="red_css";
}

if($category == 'Business Documents'){
$cat = "<div class='fuchsia_css'>Business Documents</div>";
//$colorx ="red_css";
}




$rows1[] = $document_title;
$rows1[] = $document_name;
$rows1[] = $cat;
$rows1[] = $microcontent_document_extraction." <button type='button'  class='btn btn-warning btn-xs btn_call'  data-toggle='modal' data-target='#myModal_readmore'
data-id='$id'
data-document_extraction='$document_extraction_replaced2'
>Read More </button>";
$rows1[] = '<span data-livestamp="'.$timing.'"></span>';
$rows1[] = "<button class='c_css'><a target='_blank' class='c_css' href='documents_analysis_page.php?id=$id&tm=$timing' title='Analyze Documents Via ClarifAI' >
Analyze Documents Via AI</a></button>";




$response_bl[] = $rows1;
}

$data = array(
"draw"    => $draw,
"recordsTotal"  => $rows_count,
"recordsFiltered" => $total_count,
"data"    => $response_bl);
}// you can close this



 echo json_encode($data);
}



}
else{
echo "<div id='alertdata_uploadfiles' style='background:red;color:white;padding:10px;border:none;'>
Direct Page Access not Allowed<br></div>";
}




?>