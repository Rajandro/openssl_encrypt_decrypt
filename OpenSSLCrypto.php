<?php

class OpenSSLCrypto
{
	/**
	 * Encrypts
	 * 
	 * @param string $string - plaintext message
	 * @param boolean $encrypt_method - encryption method		 
	 * @param string $key - encryption key
	 * @param string $iv - iv - encrypt method AES-256-CBC
	 * @return string (raw binary)
	 */

	public static function encrypt($string, $encrypt_method, $key, $iv)
	{
	    $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
	    $output = base64_encode($output);
		
		return $output;
	}
	
	/**
	 * Decrypts 
	 * 
	 * @param string $string - ciphertext message
	 * @param boolean $encrypt_method - encryption method		 
	 * @param string $key - encryption key
	 * @param string $iv - iv - encrypt method AES-256-CBC
	 * @return string
	 */
	public static function decrypt($string, $encrypt_method, $key, $iv)
	{
		$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		
		return $output;
	}
}

// Encrypt method
$encrypt_method = "AES-256-CBC";

// secret key
$secret_key = 'This is my secret key';

// secret iv
$secret_iv = 'This is my secret iv';

// hash
$key = hash('sha256', $secret_key);

// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
$iv = substr(hash('sha256', $secret_iv), 0, 16);	


	
$plain_txt = "This is my plain text";
echo "Plain Text =" .$plain_txt. "\n";

$encrypted_txt = OpenSSLCrypto::encrypt($plain_txt, $encrypt_method, $key, $iv);
echo "Encrypted Text = " .$encrypted_txt. "\n";

$decrypted_txt = OpenSSLCrypto::decrypt($encrypted_txt, $encrypt_method, $key, $iv);;
echo "Decrypted Text =" .$decrypted_txt. "\n";

if ( $plain_txt === $decrypted_txt ) {
	echo "SUCCESS";
} else {
	echo "FAILED";
}	



/**
 *   TEST CASE (Encrypts and Decrypts)
 *
 */
	// Encrypts
	// $encrypted = OpenSSLCrypto::encrypt($plain_txt, $encrypt_method, $key, $iv);
	
	// Decrypts
	// $decrypted = OpenSSLCrypto::decrypt($encrypted, $encrypt_method, $key, $iv);

?>






