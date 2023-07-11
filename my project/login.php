
<?php


require("head.php");
require("navigation.php");

extract($_POST);
if(isset($logout))
{

session_destroy();
header("Location:login.php");
}

if(isset($_SESSION['logged']))
{
  echo "<form method='post' action='login.php'>";

  echo "<table class='table table-borderless table-warning table-hover'> <tr><td> you're logged in </td> <td> <button name ='logout' type='submit' > log out </button></td>  </form>";
  echo "<form method='post' action='index.php'> <td> <button name='home' type='submit'> back to homepage </button></td> </tr> </table> </form>";

  // this portion can be done on the client side

  die();

}

?>

<html>

<head>
  <title>
    Welcome To Login
  </title>
  <script>

  function checkUsername(un){
    var unameExp=/^[a-z]\w{3,9}$/i;
    if (un.length==0){
      m="field empty";
      c="red";
      usernameFlag=false;
    }
    else if (!unameExp.test(un)){
        m="we dont allow these types of usersnames";
        c="red";
        usernameFlag=false;
      }
    else{
        m="";
        c="green";
        usernameFlag=true;
      }
    document.getElementById('validUsername').style.color=c;
    document.getElementById('validUsername').innerHTML=m;
  }

  function checkPassword(ps)
  {
    var passExp= /.{8,50}/i;
    if(!passExp.test(ps))
    {
      m=" we dont allow weak passwords into our system";
      c="red";
      passwordFlag=false;
    }

    else
    {
      m="";
      c="green";
      passwordFlag=true;
    }

    document.getElementById('validPassword').style.color=c;
    document.getElementById('validPassword').innerHTML=m;
  }
  function checkUserInputs(){
    document.forms[0].JSEnabled.value="TRUE";
    return (usernameFlag && passwordFlag);

  }

  </script>
</head>



<body>

<form onSubmit="return checkUserInputs();" method ='post' action='login.php' >
<table class='table table-borderless table-warning table-hover'>

  <tr> <td>username: </td> <td>   <input type ='text' name='username' onkeyup="checkUsername(this.value)" > </td> <td>  <span id='validUsername'> </td>  </tr>
  <tr> <td>password: </td> <td>   <input type ='password' name='password' onkeyup="checkPassword(this.value)" > </td> <td> <span id='validPassword'> </span> </td>  </tr>
  <input type='hidden' name='JSEnabled' value='FALSE' />
  <tr> <td> <input type='submit' name='submit' value='login'>   </td> <td><input type='reset' name='reset' value='clear' > </form> <form method='post' action='index.php'> </td> <td><button type='submit'> back to homepage</button> </td></tr>
</table>
</form>

<?php

extract($_POST);

if(!isset($JSEnabled))
die();

if(isset($submit))
{
  if($JSEnabled =="FALSE")
  {
  echo "<p class='red'> invalid field(s).</p>";
}

$securePassword = md5($password);
$sql = "select id from users where username = '$username' AND password = '$securePassword'";
$userID = $db->query($sql);

$userID = $userID->fetch();

if($userID !="")
{
echo "<p class='green'>  Login Successful. </p>";

$id = $userID[0];
$_SESSION['logged'] = $id;
header("Location:login.php");
}
else {
  echo "<p class='red'> incorrect username/password </p>";
}


}

$db->connection =null;
?>

</body>

<?php
require("footer.php");

?>

</html>
