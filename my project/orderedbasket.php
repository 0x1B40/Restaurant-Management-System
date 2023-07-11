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
<td>
  <form method='post' action='userorder.php'> <button type='submit'> back to orders </button> </form>
</td>
</tr>
</table>

<?php
extract($_POST);
// select basket table using userid as foreign key( each user has a basket)
$basketID = $viewButton;

$sql = "select * from basket where id=$basketID";
$rows = $db->query($sql);

echo "<table class='table table-borderless table-warning table-hover'>";
echo "<caption>Basket </caption>";
echo "<tr>  <th>Name </th> <th> Price </th> <th> Quantity </th>   </tr>";


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



echo "<tr>";
echo "<td> $name</td> <td>$price $</td> <td> $quantity </td>";
echo   "</tr> ";



   $total_price = $total_price + ($price * $quantity);




}










echo "</table>";
echo "</br>";



echo "<form method='post' action='orderedbasket.php' >";
echo "<input type='submit' name='placeOrder' value='re-order' >";
echo "<input type='hidden' name='viewButton' value='$viewButton'>";
echo "</form>";


echo "<table class='table table-borderless table-warning table-hover'>";
echo "<tr> <td>basket total price: </td> <td>$total_price </td> </tr>";
echo "<tr> <td> delivery charges: <td>  <td> 5 $ </td> </tr> ";
$total = $total_price + 5;
echo "<tr> <td> total order cost: </td> <td> $total </td> </tr>";
echo "</table>";


extract($_POST);





if(isset($placeOrder))
{


  // an issue with baskets

$sql = "INSERT INTO menuorder VALUES (NULL,$basketID,$userid,'awaiting')"; // use $userid to select the basket and insert new order

$db->query($sql);


echo "<p class='green'> order placed successfully. </p>";


}




?>



</body>




</html>
