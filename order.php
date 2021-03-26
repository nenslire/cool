<?php

$key = "tGC07GgBc4-8pmBEDxWu05f5kZEftA3j";


//ip
$ip = (isset($_SERVER["HTTP_CF_CONNECTING_IP"])?$_SERVER["HTTP_CF_CONNECTING_IP"]:$_SERVER['REMOTE_ADDR']);

$post_data['name'] = $_POST['name'];
$post_data['phone'] = preg_replace('/[^0-9]/', '', $_POST['phone']);


if (isset($post_data['phone']) and ($post_data['phone'] !== '') ) {
	

    $params = array(
      'goods_id' => '155652', 
      'ip' => $ip,
      'msisdn' => $_POST['phone'],
      'name' => $_POST['name'],
      'country' => 'CO',
      'url_params[sub1]' => $_POST['subid'],
	  'url_params[sub2]' => $_POST['w'],
	  'url_params[sub3]' => $_POST['s'],

    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api-new.leadreaktor.lat/api/order/create.php?api_key=".$key);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    $return = curl_exec($ch);
    curl_close($ch);
    $array = json_decode($return, true);

  	
    if (isset($array['response'])) $array = $array['response'];
    if ($array['msg'] == "error") {
  		print_r($array);
  	} else {
  		header("Location: success.php?p=".$_POST['p']); 
  	}
    


} else {
	echo 'Ошибка 2!';
}

?>