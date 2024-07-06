<?php 
include 'dbconnection.php'; 
include 'session.php';

$old_password=$_POST['old_password'];
$new_password=$_POST['new_password'];

$query="SELECT id FROM user WHERE id='$dbemployee_id' AND password='$old_password'";
$result=$con->query($query);
if($result->num_rows>0){
$con->query("UPDATE user SET password='$new_password' WHERE id='$dbemployee_id'");
echo'
<script>
alert("Password Updated successfully");
window.location.replace("logout.php");
</script>
';
}else{
echo'
<script>
alert("Wrong Old Password");
window.history.back();
</script>
';
}
?>