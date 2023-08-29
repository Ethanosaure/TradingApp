<?php
namespace App\Models;

use App\Core\connect;

class ApiSite {
    public function ApiGet() {

    
$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://global-stock-market-api-data.p.rapidapi.com/stocks_countrywise_by_price/usa",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: global-stock-market-api-data.p.rapidapi.com",
		"X-RapidAPI-Key: 0df32aefb3msh0052a0ea8bccf19p191813jsn042008c53eff"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	$array = json_decode($response, true);
	$i = 0;
	$SpecificCompany;

	foreach ($array as $company) {
    if ($company['name'] === 'Walt Disney'){
        $SpecificCompany[$i] = $company;
        $i++;
    }
    if ($company['name'] === 'Freightcar'){
        $SpecificCompany[$i] = $company;
        $i++;
    }
	if ($company['name'] === 'Coca-Cola'){
		$SpecificCompany[$i] = $company;
		$i++;
		echo '<br>';
	}
	 if ($company['name'] === 'Amphenol'){
        $SpecificCompany[$i] = $company;
        $i++;
    }
	 if ($company['name'] === 'American Airlines'){
        $SpecificCompany[$i] = $company;
        $i++;
    }

}
return json_encode($SpecificCompany);
     
		}
	}
}


?>