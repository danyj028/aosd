<?php

function confirm_email($f_m_name)
{

//$email_txt = "dadada";

/* $email_txt = <<<end_txt
        
        To : $f_m_name\n
        
        Thank you for registering with the Australian Open Source Directory, hosted by OSIA.\r\n
        
        If you did not register, please go to aosd.com.au and use the contact link to contact OSIA immediately.\r\n
        
        If you believe that you are entitled to OSIA Member priority listing, please contact OSIA immediately.  \r\n
        Your profile be upgraded after verification of your status. \r\n
        
        Please give us feedback on this service so we can make it better.\r\n
        \r\n        
       
        OSIA
        
end_txt;        */

$email_txt = <<< endt

To : $f_m_name\n
        
  Thank you for registering with the Australian Open Source Directory, hosted by OSIA.\r\n
  If you did not register, please go to aosd.osia.com.au and use the contact link to contact OSIA immediately.\r\n
  If you believe that you are entitled to OSIA Member priority listing, please contact OSIA immediately.  \r\n
  Your profile will be upgraded after verification of your status. \r\n
  Please provide us with your feedback on this service so we can make it better.\r\n
  \r\n        
  admin@osia.com.au
  \r\n
  Please also note, this system is currently in early beta status, and available for testing.  While it is useable, some features may change.
  


endt;


echo $email_txt;

$headers = "From: admin@osia.com.au" . "\r\n" .
    "Reply-To: admin@osia.com.au" ."\r\n" .
    "X-Mailer: PHP/" . phpversion();
    
$w_msg = $email_txt;

mail("danyj@greenwareit.com.au", "AOSD Registration confirmation", $w_msg, $headers);


}

confirm_email("Dany J");

echo "Email done";


?>
