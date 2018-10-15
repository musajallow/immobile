<?php

class CreateNewPosts extends Base_controller
{
    public function Index()
    {
        // instantiate new model using the function built in from the Base Controller
        $this->initModel('CreateNewPosts_model');
    
        //We request modelObjs from the database
        $data = $this->modelObj->CreateNewPosts();

        //Display  the view given
        $this->reqView('CreateNewPosts', $data);

    }

    //This is a function that allows one to save an image of 'jpg', 'jpeg', 'png', 'pdf' in one's computer to later display on Contact Page
    /* However this function has been decided not to be used
    public function createNewPosts() {
        if(isset($_POST['submit'])){

            $file = $_FILES['file'];
        
            $fileName = $_FILES['file']['name'];
            $fileTmpName = $_FILES['file']['tmp_name'];
            $fileSize = $_FILES['file']['size'];
            $fileError = $_FILES['file']['error'];
            $fileType = $_FILES['file']['type'];
        
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));
        
            $allowed = array('jpg', 'jpeg', 'png', 'pdf');
        
            if(in_array($fileActualExt, $allowed)) {
                if($fileError === 0){
                    if($fileSize < 1000000) {
                            $fileNameNew = uniqid('', true).".".$fileActualExt;
                            $fileDestination = URLrewrite::BaseURL().'/uploads'.'/'.$fileNameNew;
                            move_uploaded_file($fileTmpName,$fileDestination );
                            echo $fileNameNew;
                            echo '<img src="'.URLrewrite::BaseURL().'/uploads'.'/'.$fileNameNew.'"/>';
                            $this->reqView('home');
                        
                    } else{
                        echo "Your file is too big!";
                    }
                }else{
                    "There was an error uploading your file!";
                }
            } else{
                echo "You cannot upload files of this type";
            }
        }
    }
    */

}