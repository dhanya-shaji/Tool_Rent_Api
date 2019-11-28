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
    $sqlT="SELECT * from tools_add";
    $sqlR="SELECT * from rent_table";

    $resultCustomer = mysqli_query($conn, $sql);
    $resultTool = mysqli_query($conn, $sqlT);
    $resultRent = mysqli_query($conn, $sqlR);


    $C_Cust=mysqli_num_rows($resultCustomer);
    $C_Tool=mysqli_num_rows($resultTool);
    $C_Rent=mysqli_num_rows($resultRent);

$cdate=date("d-m-Y");
$Date = date('d-m-Y', strtotime($cdate. ' + 5 days'));
//ref number
$brand = 'RENT';
$invoice = $brand;
$customer_id = rand(00000 , 99999);
$RefNo = $invoice.$customer_id;

    $dbdata=array(
        "C_Cust"=>$C_Cust,
        "C_Tool"=>$C_Tool,
        "C_Rent"=>$C_Rent,
        "date"=>date("d-m-Y"),
        "duedate"=>$Date,
        "Refno"=>$RefNo

    );
     echo json_encode($dbdata);
    
    }


else {
    echo "0 results";
}  


?>