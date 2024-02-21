<?php
include_once 'db.php';

if ($client_id == 'admin' && $client_secret == 'rahasia123') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!file_exists('files')) {
            mkdir('files', 0777, true);
        }
        
        $tmp = $_FILES["file"]["tmp_name"];
        
        $file_name = "files/".$_FILES["file"]["name"];
    
        if (file_exists($file_name)) {
            unlink($file_name);
        }
        
        $upload = move_uploaded_file($tmp, $file_name);
    
        if ($upload == 1) {
            $response = [
                'status'=> true,
                'message'=> "File Updated",
                'file'=> $_FILES["file"]["name"],
            ];
            
            http_response_code(200);
            echo json_encode($response);
        }else{
            http_response_code(403);
            echo json_encode(array('error' => "Sorry, there was an error uploading. Please contact the relevant admin."));
        };
    } else {
        http_response_code(405); 
        echo json_encode(array('error' => 'Method Not Allowed'));
    }
}else{
    http_response_code(401);
    echo json_encode(array("error" => "Unauthorized Access."));
}

