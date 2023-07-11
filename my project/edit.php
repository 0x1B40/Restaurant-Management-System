
<?php
// and it will do session_start()
require("head.php");
require("navigation.php");
extract($_POST);
if(!isset($_SESSION['logged']))
{
  die("cannot access this page, user not logged");
}


// validation should be Client side

?>
<html>

<head>
  <title>
    Edit Your Profile
  </title>
  <script>
    var nameFlag=dobFlag=usernameFlag=passwordFlag=emailFlag= true;

    //var m,c;

    function checkName(n){
      var nameExp=/^[a-z]{3,18}$/i;

      if(document.getElementById('firstNameCheckbox').checked)
      {

      if (n.length==0 ){
        m="Field empty";
        c="red";
        nameFlag=false;
      }
      else if (!nameExp.test(n) ){
          m=" Name unaccepted";
          c="red";
          nameFlag=false;
        }
      else{

          m=" Name accepted";
          c="green";
          nameFlag=true;

        }
      document.getElementById('validName').style.color=c;
      document.getElementById('validName').innerHTML=m;
    }

    else {


      document.getElementById('validName').innerHTML="";

    }

    }


    function checkLastName(n){

      if(document.getElementById('lastNameCheckbox').checked)
      {

      var nameExp=/^[a-z]{3,18}$/i;
      if (n.length==0){
        m="Field empty";
        c="red";
        nameFlag=false;
      }
      else if (!nameExp.test(n)){
          m=" Name unaccepted";
          c="red";
          nameFlag=false;
        }
      else{
          m=" Name accepted";
          c="green";
          nameFlag=true;
        }
      document.getElementById('validLastName').style.color=c;
      document.getElementById('validLastName').innerHTML=m;
    }

    else {
      document.getElementById('validLastName').innerHTML="";
    }
}
    function checkPassword(ps)
    {
      if(document.getElementById('passwordCheckbox').checked)
      {


      var passExp= /.{8,50}/i;
      if(!passExp.test(ps))
      {
        m=" password is too weak";
        c="red";
        passwordFlag=false;
      }
      else
      {
        m="password is good";
        c="green";
        passwordFlag=true;
      }

      document.getElementById('validPassword').style.color=c;
      document.getElementById('validPassword').innerHTML=m;
      }
      else {
        document.getElementById('validPassword').innerHTML="";
      }
    }




    function checkDOB(dob)
    {
      if(document.getElementById('dobCheckbox').checked)
      {

      var dobExp =/[1|2][9|0][0-9][0-9]\-[0|1][0-9]\-[0-3][0-9]/i;
      if(dob.length==0)
      {
        m="field empty";
        c="red";
        dobFlag = false;
      }
      else if(!dobExp.test(dob))
      {
        m="invalid date,click on textbox to validate";
        c="red";
        dobFlag=false;
      }
      else {
        m="valid date";
        c="green";
        dobFlag=true;

      }
      document.getElementById('validDOB').style.color=c;
      document.getElementById('validDOB').innerHTML=m;

    }

    else {
      document.getElementById('validDOB').innerHTML="";
    }
}
    function checkEmail(email){
      if(document.getElementById('emailCheckbox').checked)
      {


      var emailExp=/[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}/i;
      if (email.length==0){
        m="field empty";
        c="red";
        emailFlag=false;
      }
      else if (!emailExp.test(email)){
          m="Invalid Email";
          c="red";
          emailFlag=false;
        }
      else{
          m="Valid Email";
          c="green";
          emailFlag=true;
        }
      document.getElementById('validEmail').style.color=c;
      document.getElementById('validEmail').innerHTML=m;
      }
      else {
        document.getElementById('validEmail').innerHTML="";
      }
    }

    function checkUserInputs(){
      document.forms[0].JSEnabled.value="TRUE";
      return (nameFlag && dobFlag  && passwordFlag && emailFlag );

    }

  </script>

</head>




<body>

<form onSubmit="return checkUserInputs();" method ='post' action='edit.php' >
<table class='table table-borderless table-warning table-hover'>

  <tr> <td>First Name: </td> <td>   <input type ='text' name='firstName' onkeyup="checkName(this.value)" onclick="checkName(this.value)" id='firstName' > </td> <td><input type='checkbox' onclick="checkName(firstName.value)" name='firstNameCheckbox' id='firstNameCheckbox' > </td> <td>
    <span id='validName'>
    <span> <td> </tr>
  <tr> <td>Last Name: </td> <td>   <input type ='text' name='lastName' onkeyup="checkLastName(this.value)" onclick="checkLastName(this.value)" id='lastName' > </td>  <td><input type='checkbox' onclick="checkLastName(lastName.value)" name='lastNameCheckbox'id='lastNameCheckbox' > </td> <td>
    <span id='validLastName'> <span>
    <td></tr>
  <tr> <td>Date Of Birth: </td> <td>   <input type ='date' name='dob' onkeyup="checkDOB(this.value)" onclick="checkDOB(this.value)" id='dob' > </td> <td><input type='checkbox' name='dobCheckbox' id='dobCheckbox' onclick="checkDOB(dob.value)" > </td><td>
    <span id='validDOB'> <span> <td> </tr>
  <tr> <td>password: </td> <td>   <input type ='password' name='password' onkeyup="checkPassword(this.value)" onclick="checkPassword(this.value)" id='password' > </td> <td><input type='checkbox' id='passwordCheckbox' name='passwordCheckbox'onclick="checkPassword(password.value)" >  </td> <td>
    <span id='validPassword'> <span>
    <td></tr>
  <tr> <td>email: </td> <td>   <input type ='text' name='email' onkeyup="checkEmail(this.value)" onclick="checkEmail(this.value)" id='email'> </td> <td><input type='checkbox' onclick="checkEmail(email.value)" name='emailCheckbox' id='emailCheckbox' > </td> <td>
    <span id='validEmail'> <span>
    <td> </tr>
  <tr> <td>male</td> <td>   <input type ='radio' name='gender' value ='male' > </td> <td><input type='checkbox' name='genderCheckbox'> </td> </tr>
  <tr> <td>female</td> <td>   <input type ='radio' name='gender' value ='female' > </td>  </tr>
  <tr> <td> <input type='submit' name='submit' value='update'>  </td> <td><input type='reset' name='reset' value='clear' > </td> </tr>
    <input type='hidden' name='JSEnabled' value='FALSE' />
</table>
</form>
<form method ='post' action="index.php"> <button type='submit'> back to home page </button> </form>

<?php
extract($_POST);

if(!isset($JSEnabled))
die();

if ($JSEnabled=="FALSE")
  {
    echo "You should validate again using PHP";
  }

if(isset($submit))
{
$securePassword = md5($password);
if(($firstName =="" && isset($firstNameCheckbox) ) || ($lastName =="" && isset($lastNameCheckbox)) || ( $dob=="" && isset($dobCheckbox))
|| ($securePassword=="" && isset($passwordCheckbox) )

|| ($email=="" && isset($emailCheckbox))
 || (!isset($gender) && isset($genderCheckbox)))



{
echo "<p class='red'> checkbox(s) are ticked, but fields are empty </p>";
}
else {

  $id = $_SESSION['logged'];



  if(isset($firstNameCheckbox))
  {
    $sql = "UPDATE USERS SET firstname='$firstName' where id=$id";
    $db->query($sql);

  }

  if(isset($lastNameCheckbox))
  {
    $sql = "UPDATE USERS SET lastname='$lastName' where id=$id";
    $db->query($sql);
  }

  if( isset($dobCheckbox))
  {
    $sql = "UPDATE USERS SET dob='$dob' where id=$id";
    $db->query($sql);

  }
  if(isset($passwordCheckbox))
  {
    $sql = "UPDATE USERS SET password='$securePassword' where id=$id";
    $db->query($sql);

  }
  if(isset($emailCheckbox))
  {
    $sql = "UPDATE USERS SET email='$email' where id=$id";
    $db->query($sql);

  }
  if(isset($genderCheckbox))
  {
    $sql = "UPDATE USERS SET gender='$gender' where id=$id";
    $db->query($sql);

  }


echo "<p class='green'> Transaction Complete. </p>";
echo "</br>";
echo "<button href='index.php'> Back to homepage </button> ";

$db->connection = null;
}


}




?>


</body>



</html>
