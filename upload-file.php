<?php

require 'sibas-db.class.php';

$data = array(
    'error' => 401,
    'mess'  => 'Error: El Archivo no puede ser Subido',
    'file'  => null,
);

if (isset($_POST['product']) && isset($_FILES['attached']) && isset($_POST['attached'])) {
    $link = new SibasDB();
    
    //$type = $link->real_escape_string(trim($_GET['type']));
    $product = $link->real_escape_string(trim($_POST['product']));
    $attached = $link->real_escape_string(trim(base64_decode($_POST['attached'])));

    $arr_type = array();
    $arr_extension = array();

    if ($product === 'AU' || $product === 'TRM') {
        $arr_type = array(
            'application/pdf', 
            'image/jpeg', 
            'image/png', 
            'image/pjpeg', 
            'image/x-png'
        );

        $arr_extension = array('rar', 'zip');
    } elseif ($product === 'DE') {
        $arr_type = array(
            'text/plain'
        );
    }
    
    $sw = FALSE;
    if (empty($attached) === FALSE) { $sw = TRUE; }
    
    $file_name = $_FILES['attached']['name'];
    $file_type = $_FILES['attached']['type'];
    $file_size = $_FILES['attached']['size'];
    $file_error = $_FILES['attached']['error'];
    $file_tmp = $_FILES['attached']['tmp_name'];
    
    $file_id = date('U') . '_' . strtolower($product) . '_' . md5(uniqid('@F#1$' . time(), true));
    $ext = explode(".", $file_name);
    $file_extension = end($ext);
    $file_new = $file_id.'.'.$file_extension;
    
    if ($_FILES['attached']['error'] > 0) {
        $data['mess'] = fileUploadErrorMsg($_FILES['attached']['error']);
    } else {
        if ((20 * 1024 * 1024) >= $file_size 
            && (in_array($file_type, $arr_type) === TRUE 
                || in_array($file_extension, $arr_extension))) {
            
            $dir = 'files/';
            if (!is_dir($dir)) {
                mkdir($dir, 0777);
            } else {
                chmod($dir, 0777);
            }
            
            if (file_exists($dir . $file_new) === TRUE) {
                $data['mess'] = 'El Archivo ' . $file_new . ' ya existe.';
            } else {
                if ($sw) {
                    if (file_exists($dir . $attached) === TRUE) {
                        //$old = getcwd(); // Save the current directory
                        //chdir($dir);
                        unlink($dir . $attached);
                        //chdir($old); // Restore the old working directory
                    }
                }
                
                if (move_uploaded_file($file_tmp, $dir . $file_new) === TRUE) {
                    $data['error'] = 200;
                    $data['mess'] = 'OK';
                    $data['file'] = base64_encode($file_new);
                } else {
                    $data['mess'] = 'El Archivo no pudo ser Subido.';
                }
            }
        } else {
            $data['mess'] = 'El Archivo no puede ser Subido ';
        }
    }
}

echo json_encode($data);

function fileUploadErrorMsg($error_code) {
    switch ($error_code) {
        case UPLOAD_ERR_INI_SIZE:
            return "El archivo es más grande que lo permitido por el Servidor."; break;
        case UPLOAD_ERR_FORM_SIZE: 
            return "El archivo subido es demasiado grande."; break;
        case UPLOAD_ERR_PARTIAL: 
            return "El archivo subido no se terminó de cargar (probablemente cancelado por el usuario)."; break;
        case UPLOAD_ERR_NO_FILE: 
            return "No se subió ningún archivo"; break;
        case UPLOAD_ERR_NO_TMP_DIR: 
            return "Error del servidor: Falta el directorio temporal."; break;
        case UPLOAD_ERR_CANT_WRITE: 
            return "Error del servidor: Error de escritura en disco"; break;
        case UPLOAD_ERR_EXTENSION: 
            return "Error del servidor: Subida detenida por la extención"; break;
        default: 
            return "Error del servidor: ".$error_code; break;
    } 
}