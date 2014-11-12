<?php
$local_directory=dirname(__FILE__).'/local_files/';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
    curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_URL, 'http://localhost/curl_image/uploader.php' );
	//most importent curl assues @filed as file field
    $post_array = array(
        "my_file"=>"@".$local_directory.'shreya.jpg',
        "upload"=>"Upload"
    );
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_array); 
    $response = curl_exec($ch);
	echo $response;
?>