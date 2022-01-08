<?php 
    $db = mysqli_connect('localhost','root','','store');
    // var_dump($_POST);
    if(isset($_POST['name']) && isset($_POST['address']) && isset($_POST['contact_number']) && isset($_FILES['image'])){
        $name = $_POST['name'];
        $address = $_POST['address'];
        $contact_number = $_POST['contact_number'];
        

        $upload_dir = __DIR__."\\uploads\\";
        $return['path'] = $upload_dir;
        $filename = time().'_'.$_FILES['image']['name'];
        $fileuploadstatus = move_uploaded_file($_FILES['image']['tmp_name'],$upload_dir.$filename);
        $image = "http://localhost/my_store/uploads/".$filename;

        if($fileuploadstatus){
            $insert = "INSERT INTO profile(name,address,contact_number,image) VALUES 
            ('".$name."','".$address."','".$contact_number."','".$image."')";
            $query = mysqli_query($db,$insert);

            $return['successs'] = true;
            $return['message'] = "uploaded successfully";
        }else{
            $return['error'] = true;
            $return['message'] = "image upload failed";
        }

    }else{
        $return['reslut'] = false;
        $return['message'] = "fill all fields correctly";
    }
    mysqli_close($db);
    header('Content-Type: application/json');
    // tell browser that its a json data
    echo json_encode($return);
    //converting array to JSON string
?>