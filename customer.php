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

$sql="SELECT * from customer_regstration";

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
elseif($_GET['type']=="InsertCustomer") {
    $Cust_Name =$_GET["CName"];
    $Cust_Housename=$_GET["CHousename"];
    $Cust_City=$_GET["CCity"];
    $Cust_Phonenumber=$_GET["CPhonenumber"];
    $Cust_Email=$_GET["CEmail"];
    $Cust_Mobile=$_GET["CMobile"];
    $Cust_Id_Proof_No=$_GET["CId"];
    $Refereneced_By=$_GET["Ref_by"];
    $sql="INSERT INTO `customer_regstration`(
        `Cust_Id`,
         `Cust_Name`,
         `Cust_Housename`,
         `Cust_City`,
         `Cust_Phonenumber`,
         `Cust_Email`,
         `Cust_Mobile`,
         `Cust_Id_Proof_No`,
         `Refereneced_By`)
    VALUES (
        Null,
       '$Cust_Name',
       '$Cust_Housename',
       ' $Cust_City',
       ' $Cust_Phonenumber',
       ' $Cust_Email',
      '  $Cust_Mobile',
      '$Cust_Id_Proof_No',
      '$Refereneced_By')";
    $result=mysqli_query($conn,$sql);
	if($result) {
             echo "added successfully";
               $resultCode =1;
 		}
 		else
 		{
             echo "Error: " . $sql . "<br>" . mysqli_error($conn);
              $resultCode = 0;
 		}
} 
//delete customer

else if($_GET['type']=="DeleteCustomers"){
    $Cust_Id=$_GET['id'];
$sql="DELETE FROM customer_regstration where Cust_Id = $Cust_Id ";
if (mysqli_query($conn,$sql)) {
	echo "deleted successfully";
}else
{
	echo "error deleting a record".mysqli_error($conn);
}
}
//select by id
elseif($_GET['type']=="getById"){
    $Cust_Id=$_GET['id'];
    $sql="SELECT * from customer_regstration where  Cust_Id = $Cust_Id ";
    
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
    //update 
    else if($_GET['type']=="Update"){
        $Cust_Id=$_GET['cid'];
        $Cust_Name =$_GET["CName"];
        $Cust_Housename=$_GET["CHousename"];
        $Cust_City=$_GET["CCity"];
        $Cust_Phonenumber=$_GET["CPhonenumber"];
        $Cust_Email=$_GET["CEmail"];
        $Cust_Mobile=$_GET["CMobile"];
        $Cust_Id_Proof_No=$_GET["CId"];
        $Refereneced_By=$_GET["Ref_by"];
    
        
        $sql = "UPDATE customer_regstration  SET 
         Cust_Name='$Cust_Name',
         Cust_Housename='$Cust_Housename',
         Cust_City='$Cust_City',
         Cust_Phonenumber='$Cust_Phonenumber',
         Cust_Email='$Cust_Email',
         Cust_Mobile='$Cust_Mobile',
         Cust_Id_Proof_No='$Cust_Id_Proof_No',
         Refereneced_By='$Refereneced_By'
         WHERE Cust_Id='$Cust_Id'";
    
         
        if (mysqli_query( $conn,$sql)) {
          echo"Updated sucessfully";
      }
      else
      {
          echo "error updating record".mysqli_error($conn);
      }
    } 
else {
    echo "0 results";
}  


?>