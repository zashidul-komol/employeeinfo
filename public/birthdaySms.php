<?php 
//$dblink = mysqli_connect("localhost", "devuser", "$dpuseR", "employee_info");
$dblink = mysqli_connect("127.0.0.1", "root", "!sister", "employee_info");
if (mysqli_connect_errno()) {
    echo "Could  not connect to database: Error: ".mysqli_connect_error();
    exit();
}
$sqlquery = "SELECT mobile FROM employees WHERE DATE_FORMAT(birthdate, '%m-%d') = DATE_FORMAT(CURRENT_DATE(), '%m-%d') AND organization_id = 1 AND status = 'active' ";
if ($result = mysqli_query($dblink, $sqlquery)) {
    while ($row = mysqli_fetch_assoc($result)) {
		$number = $row["mobile"]; 


		//$arr = array();
		$message = "Happy Birth Day To You. Polar Wishes You a Success and Endless Happiness! Wishing you an awesome Birthday!\nStay Safe. \nPolar Management Team.";
        $sms = urlencode($message);
		//echo $sms; die();
       	
		//---------------------------------------------
			$user = "POLAR"; 
			$pass = "i@57X322"; 
			$sid = "PolarIceCream"; 
			
			$param="user=$user &pass=$pass &sms[0][0]= $number &sms[0][1]=$sms &sms[1][2]=123456790 &sid=$sid";
			
			$url="http://sms.sslwireless.com/pushapi/dynamic/server.php"; 
            $crl = curl_init(); 
            curl_setopt($crl,CURLOPT_SSL_VERIFYPEER,FALSE); 
            curl_setopt($crl,CURLOPT_SSL_VERIFYHOST,2); 
            curl_setopt($crl,CURLOPT_URL,$url); 
            curl_setopt($crl,CURLOPT_HEADER,0); 
            curl_setopt($crl,CURLOPT_RETURNTRANSFER,1); 
            curl_setopt($crl,CURLOPT_POST,1); 
            curl_setopt($crl,CURLOPT_POSTFIELDS,$param); 
            $response = curl_exec($crl); 
            curl_close($crl); 
	//---------------------------------------------
	}
} 

?>
		