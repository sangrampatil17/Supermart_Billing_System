<?php
include("dbconnection.php");
$id = $_GET['id'];
$table = $_GET['table'];
$query = "DELETE FROM $table WHERE id = $id";
$data=mysqli_query($con,$query);
$url=$table."tb.php";
if($data)
{
    echo "<script>window.alert('Record Deleted');
    window.location.replace('$url');
    </script>";
}
else{
    echo "<script>window.alert('Something went wrong. Please try again!')</script>"; 
}

?>


