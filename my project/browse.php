
<?php
// and it will do session_start()
require("head.php");
require("navigation.php");
$userid = $_SESSION["logged"];

// validation should be Client side
// buttons are always client side ( i think)

?>


<html>

<header>
  <title>
    Browse Menu
  </title>
</header>



<body>

<form method='post' action='browse.php'>
<table class='table table-borderless table-warning table-hover'>
<tr><td> Select Menu: </td>
   <td>

  <select  name='catagory' >
    <option value='starters'> Starters </option>
      <option value='main Dish'> Main Dish </option>
      <option value='desert'> Desert </option>
      <option value='drinks'> Drinks </option>
  </select>


</td>
<td>

  <input type='submit' value ='select'></form>
</td>

<td> <form method='post' action='basket.php'  ><input type='submit' value='Go to Basket'> </form> </td>
  </tr>


</table>




<?php
// menu table
// id, foodname, price,catagory, description
extract($_POST);
if(!isset($catagory))
die();



$sql = "select * from menu where catagory='$catagory'";
$rows = $db->query($sql);


echo "<table class='table table-borderless table-warning table-hover'>";
echo "<caption> $catagory </caption>";
echo "<th> Name  </th> <th> Price </th> ";

foreach($rows as $row)
{
echo "<form method= 'post' action='view.php'>";
  $id = $row['id'];
  $foodName = $row['foodname'];
  $price = $row['price'];
  $image = $row['image'];
  echo "<tr> <td> $foodName </td> <td> $price </td> <td> <button type ='submit' name='viewButton' value='$id'   > View </button> </td> <td> ";
  echo "</form>";
  echo '<img width="100" height="100" src="data:image/jpeg;base64,'.base64_encode( $image ).'"/>  </td>   ';
  echo "<td> <form method='post' action='browse.php'> <button type='submit' name='addBasket' value='$id'> Add to basket </button></td> <td><input type='number' name='qty' </td>  ";
  echo "<input type ='hidden' name='catagory' value='$catagory'>";
  echo" </form> ";
  echo "  </tr> ";

}

extract($_POST);
if(isset($addBasket))
{

$sql = "INSERT INTO basket (id,userid,foodid,quantity,orderedbasket) VALUES(?,?,?,?,?)";





$statement= $db->prepare($sql);

$statement->execute(array(NULL,$userid,$addBasket,$qty,"no"));


}



echo "</table>";

$db->connection = null;
?>



</body>



</html>
