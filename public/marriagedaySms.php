<?php 
//$dblink = mysqli_connect("localhost", "devuser", "$dpuseR", "employee_info");
$dblink = mysqli_connect("127.0.0.1", "root", "!sister", "employee_info");
if (mysqli_connect_errno()) {
    echo "Could  not connect to database: Error: ".mysqli_connect_error();
    exit();
}
$sqlquery = "SELECT e.mobile, e.name, f.wife_name FROM employees e, family_details f WHERE e.id = f.employee_id AND DATE_FORMAT(f.marriage_date, '%m-%d') = DATE_FORMAT(CURRENT_DATE(), '%m-%d') AND e.organization_id = 1 AND e.status = 'active' AND e.id IN (819, 822, 823, 828, 830, 831, 832, 833, 834, 854, 855, 859, 864, 865, 866, 869, 870, 889, 905, 919, 924, 925, 931, 936, 950, 969, 970, 981, 996, 997, 1014, 1028, 1042, 1049, 1064, 1072, 1090, 1102, 1137, 1913, 1920, 1921, 1930, 1994, 1126, 835)";
if ($result = mysqli_query($dblink, $sqlquery)) {
    while ($row = mysqli_fetch_assoc($result)) {
		$number 		= $row["mobile"]; 
		$EmployeeName 	= $row["name"]; 
		$SpouseName	 	= $row["wife_name"];
		

		//$arr = array();
		//"পোলার পরিবারের পক্ষ থেকে আপনাদের বিবাহ বার্ষিকীতে অনেক শুভেচ্ছা এবং শুভ কামনা। মন ভালো থাক।"
		$message1 = "পোলার পরিবারের পক্ষ থেকে আপনাদের বিবাহ বার্ষিকীতে অনেক শুভেচ্ছা এবং শুভ কামনা।";
		$message2 = "মন ভালো থাক।";
		$message = 'Mr.'. ' '.$EmployeeName. ' '. '&'. ' '.'Mrs.'.' '. $SpouseName. ' '.'-'.' '.'"'.$message1.'"'.' '.$message2;  
		$sms = strtoupper(bin2hex(iconv('UTF-8', 'UCS-2BE', $message)));
        //$sms = urlencode($message);
		//echo $sms; die();
       	
		//---------------------------------------------
			$user = "POLAR"; 
			$pass = "i@57X322"; 
			$sid = "PolarBNG"; 
			
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
		