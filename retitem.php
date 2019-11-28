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
    $Rent_Rfid =$_GET['rfid'];
    $sql="SELECT * from rent_item WHERE Rent_Rfid ='$Rent_Rfid'";
    
    $result = mysqli_query($conn, $sql);
    $dbdata=array();
   $sum=0;
    if (mysqli_num_rows($result)>0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $dbdata[]=$row;
        }
        echo json_encode($dbdata);
    }
    }
    elseif($_GET['type']=="InsertRentItem") {
        $Rent_Rfid =$_GET["Rent_Rfid"];
        $Tool_id=$_GET["Tname"];
        $Tool_Price=$_GET["TPrice"];
        $Tool_Quantity=$_GET["Tquantity"];
        $Status=$_GET["Status"];
       $tp=$Tool_Price*$Tool_Quantity*5;


       $name = "SELECT Tool_Name FROM tools_add WHERE Tool_Id=$Tool_id";
       $res = mysqli_query($conn,$name);
       if (mysqli_num_rows($res) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($res)) {
            $data=$row["Tool_Name"];
        }
    } else {
        echo "0 results";
    }
    
        $sql="INSERT INTO `rent_item`(
            `Rent_Item_Id`,
             `Rent_Rfid`,
             `Tool_Name`,
             `Tool_Price`,
             `Tool_Quantity`,
             `Total_Price`,
             `Status`
             )
        VALUES (
            Null,
           '$Rent_Rfid',
           '$data',
           '$Tool_Price',
           ' $Tool_Quantity',
           '$tp',
           ' $Status')";
        $result=mysqli_query($conn,$sql);

        if($result) {
        $dbdata=array(
        'usercode'=>1

    );
     echo json_encode($dbdata);
    
    }
             else
             {
                 echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                 $resultCode =0;
             }
    }    
    else if($_GET['type']=="Delete"){
        $Rent_Item_Id=$_GET['id'];
    $sql="DELETE FROM rent_item where Rent_Item_Id = $Rent_Item_Id ";
    if (mysqli_query($conn,$sql)) {
        $dbdata=array(
            'usercode'=>1
    
        );
         echo json_encode($dbdata);
    }else
    {
        echo "error deleting a record".mysqli_error($conn);
    }
    }
    elseif($_GET['type']=="getById"){
        $Rent_Item_Id=$_GET['id'];
        $sql="SELECT * from rent_item WHERE Rent_Item_Id =$Rent_Item_Id";
        
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
    $Rent_Item_Id=$_GET['id'];
    $Status="Returned";
    $sql = "UPDATE rent_item  SET 
     Status='$Status'
     WHERE Rent_Item_Id='$Rent_Item_Id'";

     
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
    