<?php
header('Access-Control-Allow-Origin: *');
$servername="localhost";
$username="root";
$password="";
$database="t_rent";
$conn=mysqli_connect($servername,$username,$password,$database);
if (!$conn) {
	die("conection failed".mysqli_connect_error());
}
if($_GET['type']=="getByAllId"){
    $Username=$_GET['Username'];
    $Password=$_GET['Password'];
$sql="SELECT * from admin_login where Username='$Username'AND Password='$Password'";

$result = mysqli_query($conn, $sql);
$dbdata=array();

$row = mysqli_fetch_assoc($result);
    $userdata = array(
        'resultCode' => 1,
        'userData'=>$row,
    );
   
    echo json_encode($userdata);
}
else if($_GET['type']=="Update"){
    $Username=$_GET['Username'];
    $Password=$_GET['Password'];
    
    $sql = "UPDATE admin_login  SET 
    Password='$Password'
    
     WHERE Username='$Username'";

     
    if (mysqli_query( $conn,$sql)) {
      echo"Updated sucessfully";
  }
  else
  {
      echo "error updating record".mysqli_error($conn);
  }
} 
 else {
    $data = array('resultCode' => 0, );
    echo json_encode($data);
}  




?>