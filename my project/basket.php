<?php
// and it will do session_start()
require("head.php");
require("navigation.php");

if(!isset($_SESSION['logged']))
die( "you're not logged in");

$userid =$_SESSION['logged'];

// validation should be Client side

?>

<html>

<header>
  <title>
    Basket Page
  </title>
</header>

<body>
 <table class='table table-borderless table-warning table-hover'>
   <tr>
     <td>
  <form method ='post' action='browse.php'><button type='submit'>go to browse </button> </form>
</td>
<td>
  <form method='post' action='index.php'> <button type='submit'> main menu </button> </form>
</td>
</tr>
</table>

<?php

// select basket table using userid as foreign key( each user has a basket)
$sql = "select * from basket where userid = $userid AND ORDEREDBASKET ='no'";
$rows = $db->query($sql);

echo "<table class='table table-borderless table-warning table-hover'>";

echo "<tr>  <th>Name </th> <th> Price </th> <th> Quantity </th> <th> update quantity</th> <th> delete </th>   </tr>";


$total_price = 0;

foreach($rows as $row)
{
$id = $row['id'];
$foodid = $row['foodid'];
$sql = "select * from menu where id=$foodid";
$result =  $db->query($sql);
$result =$result->fetch();

$name = $result['foodname'];
$price = $result['price'];
$quantity= $row['quantity'];


echo "<form method ='post' action='basket.php'>";
echo "<tr>";
echo "<td> $name</td> <td>$price $</td> <td> <input type='number' name='qty[]' value='$quantity'></td>";

echo "<td> <button name='update[]' type='submit' value='$id'> Update </button> </td>";
echo "</form>";
echo "<form method ='post' action='basket.php'>";
echo "  <td> <button type='submit' name='delete[]' value='$id'>Delete  </button> </td>";
echo   "</tr> ";
echo "</form>";

   $total_price = $total_price + ($price * $quantity);




}





$num =  $rows->rowCount();




echo "</table>";
echo "</br>";

echo "<input type='hidden' name='basketLength' value='$num'> ";

echo "<form method='post' action='basket.php' >";
echo "<input type='submit' name='placeOrder' value='place order' >";
echo "</form>";


echo "<table class='table table-borderless table-warning table-hover'>";
echo "<tr> <td>basket total price: </td> <td>$total_price </td> </tr>";
echo "<tr> <td> delivery charges: <td>  <td> 5 $ </td> </tr> ";
$total = $total_price + 5;
echo "<tr> <td> total order cost: </td> <td> $total </td> </tr>";
echo "</table>";


extract($_POST);

if(isset($num))
{


for($i = 0;$i<$num;$i++)
{

if(isset($update[$i]))
{
  if($qty[$i] <1)
{
  echo "<p ='red'>  invalid Quantity. </p> ";
  // no need for die();
}

$quant = $qty[$i];
$basketid= $update[$i];

  $sql = "UPDATE BASKET SET QUANTITY =$quant where id=$basketid AND userid=$userid" ; // update statement using  $qty[$i], $update[$i]

  $db->query($sql);
header("Location:basket.php");

}
if(isset($delete[$i]))
{

  $basketid= $delete[$i];

  $sql ="DELETE FROM BASKET WHERE id=$basketid AND userid =$userid";
  $db->query($sql); // delete statement using $delete[$i]
header("Location:basket.php");
}

}



}


if(isset($placeOrder))
{

  $sql = "select * from basket where userid = $userid AND orderedbasket='no'";
  $rows = $db->query($sql);
  $result = $rows->fetch();
  $basketid = $result['id'];
  if(!isset($basketid))
  die();
  // an issue with baskets

$sql = "INSERT INTO menuorder VALUES (NULL,$basketid,$userid,'awaiting')"; // use $userid to select the basket and insert new order

$db->query($sql);

$sql = " UPDATE basket  set orderedbasket='yes' where id=$basketid";
$db->query($sql);
echo "<table class='table table-borderless table-warning table-hover'> <tr> <td>  <p class='green'> order placed successfully. </td> </p></tr> </table>";


}



?>



</body>




</html>
