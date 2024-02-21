<?php
include_once 'db.php';

if ($client_id == 'admin' && $client_secret == 'rahasia123') {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'];
    $base_url = $protocol . $host;
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $request = json_decode(file_get_contents("php://input"));
        $file_name_complete = 'files/'.$request->file_name;

        $delete = $db->delete('files', 'file_name', '"'.$file_name_complete.'"');

        if ($delete['status'] == 1) {
            if (file_exists($file_name_complete)) {
                unlink($file_name_complete);
            }
            
            $response = [
                'status'=> true,
                'message'=> "File Deleted",
            ];
            
            http_response_code(200);
            echo json_encode($response);
        }else{
            http_response_code(403);
            echo json_encode(array("error" => "File Not Found."));
        }
    } else {
        http_response_code(405);
        echo json_encode(array('error' => 'Method Not Allowed'));
    }
}else{
    http_response_code(401);
    echo json_encode(array("error" => "Unauthorized Access."));
}


