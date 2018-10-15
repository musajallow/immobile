

<?php
echo "<h1 class='page-header'>User: ". $data['userInfo']['username']. "</h1>";
echo "<div class='form-container'>";
echo "<a href=".URLrewrite::BaseAdminURL('manageusers')."><button>Go back</button></a>";
$form = new Form();

$form->textInput('accountInfo[username]', $data['userInfo']['username'], 'Username', 'form-control', $data['userInfo']['username']);
$form->hiddenInput('hidden[oldUserName]', $data['userInfo']['username']);
$form->textInput('userInfo[fname]', $data['userInfo']['fname'], 'First Name');
$form->textInput('userInfo[lname]', $data['userInfo']['lname'], 'Last Name');
$form->textInput('userInfo[phone]', $data['userInfo']['phone'], 'Phone - 10 digits');
$form->textInput('userInfo[email]', $data['userInfo']['email'], 'Email');
$form->numInput('userInfo[level_id]', $data['userInfo']['level_id'], 'Level');

//address

if($data['adress']){
    $form->textInput('userAdress[adress]', $data['adress']['adress'], 'Street');
    $form->textInput('userAdress[post_nr]', $data['adress']['post_nr'], 'Zip Code');
    $form->textInput('userAdress[stad]', $data['adress']['stad'], 'City');
    $form->textInput('userAdress[land]', $data['adress']['land'], 'Country');
    $form->hiddenInput('hidden[aid]', $data['adress']['aid']);
} else {
    echo "<h4>No address in database for <strong>" . $data['userInfo']['username']."</strong></h4>";
}

$action = URLrewrite::BaseAdminURL('manageUsers/updateUserInfo/').$data['userInfo']['uid'];
$form->button('Save');
$form->render($action, 'Edit User Information', 'g-form', 'userForm');
?>
</div>
<div class="form-container">
<?php
if (isset($_SESSION['updatePass']['status']) && $_SESSION['updatePass']['status'] == false) {
    echo '<div class="alert alert-danger alert-dismissible grid-alert" role="alert">The submitted passwords do not match! Try again.</div>';
    unset($_SESSION['updatePass']['status']);
    unset($_SESSION['updatePass']['newPass']);   
}
$passForm = new Form();
$newPass = isset($_SESSION['updatePass']['newPass']) ? $_SESSION['updatePass']['newPass'] : 'Password';  
$passForm->textInput('userPass[new]', '', 'Enter Password', 'form-control', $newPass);
$passForm->textInput('userPass[confirm]', 'Enter same password as above', 'Confirm Password');
$passForm->hiddenInput('hidden[username]', $data['userInfo']['username']);
$action = URLrewrite::BaseAdminURL('manageUsers/updatePassword/').$data['userInfo']['uid'];;
$passForm->button('Save');
$passForm->render($action, 'Change User Password', 'g-form', 'userPass');


?>
</div>