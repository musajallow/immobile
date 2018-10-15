<html>
<head>
<title> <?php echo $data[0]['fname']; ?>'s page</title> <!-- prints out the users surname, is currently overrided with the header.php file -->
<link rel="stylesheet" href="css/account.css" type="text/css"/>
</head>
<div class="container">
<?php
if (Registry::getStatus('userFromOrder') != null && Registry::getStatus('userFromOrder') == true) {
    echo "Your account has been created!";
}
if(!isset($_SESSION['loggedIn']['uid'])){ //if login in session is not set, return to index-page
    header("Location: index.php");
}

//var_dump($data);

//Users title 

printf("<h1 class='text-uppercase text-center'> %s</h1>", $data[0] ['fname'] . " " . $data[0] ['lname']); //displays the users surname and lastname

//var_dump($_SESSION['loggedIn']);
?>

<a  href="<?php echo URLrewrite::BaseURL().'account'?>"><button id="" class="btn btn-primary">My details</button></a> 
<a  href="<?php echo URLrewrite::BaseURL().'orderhistory/'.$data[0]['uid']?>"><button id="" class="btn btn-primary">My Order History</button></a> <!-- here is the options between the users account and order history -->
<a href="<?php echo URLrewrite::BaseURL().'updateuser' ?>"><button id="updateUser" class="btn btn-primary updateButton">Update User Information</button></a>
<a href="<?php echo URLrewrite::BaseURL().'changepassword' ?>" class="btn btn-primary">Change password</a>
<?php
if ($_SESSION['loggedIn']['level'] == 4) {
    echo "<a href='".URLrewrite::BaseAdminURL('index')."' class='btn btn-primary'>Admin page</a>";
} 
?>
<!--- Page info for the users account -->

<h3 class="text-center">Account Details </h3> <br>

<?php 

    printf("<ul><li class='list-unstyled'>Firstname: %s</li></ul>", $data[0] ['fname']);
    printf("<ul><li class='list-unstyled'>Lastname: %s</li></ul>", $data[0] ['lname']);
    printf("<ul><li class='list-unstyled text-center'>Phone: %s</li></ul>", $data[0] ['phone']);
    printf("<ul><li class='list-unstyled'>Email: %s</li></ul>", $data[0] ['email']);

    /*$i = 0; 
    foreach ($data[0] as $key => $value) {
        if ($i++ < 2) { //ignores the first two values in the $data[0]-array 
            continue;
        }         
        //print("<ul><li></li></ul> {$value} "); 

    }*/

?>

<!-- DELETE ACCOUNT BUTTON -->

<a onclick="confirmDelete()" class="btn btn-danger" href="<?php echo URLrewrite::BaseURL()."Account/deletePerson"."/".$_SESSION['loggedIn']['uid'] ?>">Delete</a>


<!--<form method="POST" onsubmit="return confirm('Are you sure you want to delete this account?');">
    <input type="hidden" name="_METHOD" value="DELETE">
    <input type="hidden" name="uid" value="<?php echo $uid; ?>"> 
    <button class="btn btn-danger" type="submit">Delete Account</button> <!-- https://stackoverflow.com/questions/16962280/delete-button-and-confirmation -->
</form>

<script>
function confirmDelete() {
    if (!confirm("Are you sure you want to delete your account?")) //deletes anyway :< 
    {
        return false;

   } 
}
   </script>     

</div>
