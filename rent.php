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
if($_GET['type']=="Insert") {
    $Cust_Name=$_GET["CName"];
    $Total_Price=$_GET["TPrice"];
    $Total_Item=$_GET["TItem"];
    $Rent_Date=$_GET["RDate"];
    $Due_Date=$_GET["DDate"];
    $Status=$_GET["Status"];
    $rid=$_GET["rid"];
   $TPrice= $Total_Price*$Total_Item*5;

    $sql="INSERT INTO `rent_table`(
        `Rent_Id`,
        `Rent_Rfid`,
          `Cust_Name`,
          `Total_Price`,
          `Total_Item`,
          `Rent_Date`,
          `Due_Date`,
          `Status`)
    VALUES (Null,
    '$rid',
    '$Cust_Name',
    '$TPrice',
    '$Total_Item',
    '$Rent_Date',
    '$Due_Date',
    '$Status')";
    $result=mysqli_query($conn,$sql);
	if($result) {
 			echo "added successfully";
 		}
 		else
 		{
 			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
 		}
} 
elseif($_GET['type']=="getByAllId"){
    $sql="SELECT * from rent_table ";
    $cdate=date("d-m-Y");
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
    else if($_GET['type']=="Update"){
        $Rent_Id=$_GET['id'];
        $Status="Returned";
        $sql = "UPDATE rent_table  SET 
         Status='$Status'
         WHERE Rent_Id='$Rent_Id'";
     
         
        if (mysqli_query( $conn,$sql)) {
          echo"Updated sucessfully";
      }
      else
      {
          echo "error updating record".mysqli_error($conn);
      }
    }
    elseif($_GET['type']=="getById"){
        $Rent_Id=$_GET['id'];
        $sql="SELECT * from rent_table where  Rent_Id = $Rent_Id ";
        
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

    else if($_GET['type']=="Delete"){
        $Rent_Id=$_GET['id'];
    $sql="DELETE FROM rent_table where Rent_Id = $Rent_Id ";
    $sqlRent_Item="DELETE FROM rent_item where Rent_Rfid = $Rent_Id ";
    if (mysqli_query($conn,$sql)) {
        echo "deleted successfully";
    }else
    {
        echo "error deleting a record".mysqli_error($conn);
    }
    }
    
    
else {
    $data = array('resultCode' => 0, );
    echo json_encode($data);
}  




?>