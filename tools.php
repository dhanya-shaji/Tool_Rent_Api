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
//select all tools
if($_GET['type']=="getByAllId"){

$sql="SELECT * from tools_add";

$result = mysqli_query($conn, $sql);
$dbdata=array();

if (mysqli_num_rows($result)>0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $dbdata[]=$row;
    }
    echo json_encode($dbdata);
}
} 
//select tool by id
elseif($_GET['type']=="getById"){
    $Tool_Id=$_GET['id'];
    $sql="SELECT * from tools_add where  Tool_Id = $Tool_Id ";
    
    $result = mysqli_query($conn, $sql);
    $dbdata=array();
    
    if (mysqli_num_rows($result)>0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $dbdata[]=$row;
        }
        echo json_encode($dbdata);
    }
    } 
//insert tools

elseif($_GET['type']=="InsertTool") {
    $Tool_Name=$_GET["TName"];
    $Tool_Quantity=$_GET["TQuantity"];
    $Tool_Rentcharge=$_GET["TRentcharge"];

    $sql="INSERT INTO `tools_add`(`Tool_Id`,`Tool_Name`,`Tool_Quantity`,
    `Tool_Rentcharge`)
    VALUES (Null,'$Tool_Name',' $Tool_Quantity',' $Tool_Rentcharge')";
    $result=mysqli_query($conn,$sql);
	if($result) {
 			echo "added successfully";
 		}
 		else
 		{
 			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
 		}
} 
//delete tools
else if($_GET['type']=="DeleteTools"){
    $Tool_Id=$_GET['id'];
$sql="DELETE FROM tools_add where Tool_Id = $Tool_Id ";
if (mysqli_query($conn,$sql)) {
	echo "deleted successfully";
}else
{
	echo "error deleting a record".mysqli_error($conn);
}
}
//update 
else if($_GET['type']=="Update"){
    $Tool_Id=$_GET['tid'];
    $Tool_Name=$_GET["TName"];
    $Tool_Quantity=$_GET["TQuantity"];
    $Tool_Rentcharge=$_GET["TRentcharge"];

    
    $sql = "UPDATE tools_add  SET 
     Tool_Name='$Tool_Name',
     Tool_Quantity='$Tool_Quantity',
     Tool_Rentcharge='$Tool_Rentcharge'
     WHERE Tool_Id='$Tool_Id'";

     
    if (mysqli_query( $conn,$sql)) {
      echo"Updated sucessfully";
  }
  else
  {
      echo "error updating record".mysqli_error($conn);
  }
}
else if($_GET['type']=="getByToolName"){
    $Tool_Name =$_GET['Tnamevalue'];
    $sql="SELECT * from tools_add WHERE Tool_Name ='$Tool_Name'";
    
    $result = mysqli_query($conn, $sql);
    $dbdata=array();
   
    if (mysqli_num_rows($result)>0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $dbdata[]=$row;
        }
        echo json_encode($dbdata);
    }
    }

else {
    echo "0 results";
}  


?>