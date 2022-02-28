<?php  
include 'control.php';
$get_data = new data();
$ID = $_GET['read'];
$select_pdf = $get_data->list_hoso($ID);
foreach($select_pdf as $select){}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <embed src="images/<?php echo $select['name_file'] ?>" type="application/pdf" width="100%" height="700px">
</body>
</html>