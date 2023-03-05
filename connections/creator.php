<?php
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
 if (isset($_GET['creator-id'])) {

  $curl = curl_init();

  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

  $creator_id = htmlentities(strtolower($_GET['creator-id'])); //FJEkejfdkf = fjekjfdkf

  $ts = time();
  $public_key = 'd5f0f5449bd3c02b3efa96222131c286';
  $private_key = '8d5642f6a655623694ef15d167bab320550adeed';
  $hash = md5($ts . $private_key . $public_key);

  $query = array(
   'apikey' => $public_key,
   'ts' => $ts,
   'hash' => $hash,
  );

  curl_setopt($curl, CURLOPT_URL,
   "https://gateway.marvel.com:443/v1/public/creators/" . $creator_id . "?" . http_build_query($query)
  );

  $result = json_decode(curl_exec($curl), true);

  curl_close($curl);

  echo json_encode($result);

 } else {
  echo "Error comic-id invalid.";
 }
} else {
 echo "Error: wrong server.";
}