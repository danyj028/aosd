<?php

//These functions encrypts-decrypts data in excelearn

function el_encrypt(&$w_data)
{

   /* Data */
    $key = 'this is a very long key, even too long for the cipher';
    /* Open module, and create IV */
    $td = mcrypt_module_open ('tripledes', '', 'cbc', '');
    $key = substr (md5($key), 0, mcrypt_enc_get_key_size ($td));
    $iv_size = mcrypt_enc_get_iv_size ($td);
    $iv = "abcdefgh";

    //echo "key:".$key;
	 /* Initialize encryption handle */
    if (mcrypt_generic_init ($td, $key, $iv) != -1)
	{

        /* Encrypt data */
        $w_edata = mcrypt_generic ($td, $w_data);

        /* Clean up */
        mcrypt_generic_deinit ($td);
        mcrypt_module_close ($td);
	  }

//$w_edata = $w_data;

return($w_edata);
}

function el_decrypt(&$w_edata)
{

 	/* Data */
	$key = "this is a very long key, even too long for the cipher";

	 /* Open module, and create IV */
    $td = mcrypt_module_open ('tripledes', '', 'cbc', '');
    $key = substr (md5($key), 0, mcrypt_enc_get_key_size ($td));
    $iv_size = mcrypt_enc_get_iv_size ($td);
    $iv = "abcdefgh";

//	echo "key:".$key;

    /* Initialize encryption handle */
    	if (mcrypt_generic_init ($td, $key, $iv) != -1)
		{

        	$w_data = mdecrypt_generic ($td, $w_edata);

        /* Clean up */
        	mcrypt_generic_deinit ($td);
        	mcrypt_module_close ($td);
		}

//$w_data = $w_edata;

return(rtrim($w_data));
}

?>