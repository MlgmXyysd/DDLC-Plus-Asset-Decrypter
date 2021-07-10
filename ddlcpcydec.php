<?php
/**
 * Doki Doki Literature Club Plus Asset Decrypter
 * 
 * Used to decrypt encrypted Streaming Asset Bundle files (*.cy) in DDLC-Plus.
 * 
 * @author MlgmXyysd
 * @version 1.1
 */

$ver = "1.1";

/* Maximum cache capacity, out of memory if too large */
$cache_capacity = 10 * 1024 * 1024; // 10485760 for 10MB

print("\033[32m**************************************************\033[0m\n");
print("\033[32m* Doki Doki Literature Club Plus Asset Decrypter *\033[0m\n");
print("\033[32m* By MlgmXyysd                                   *\033[0m\n");
print("\033[32m**************************************************\033[0m\n");
print("- Version " . $ver . "\n");

if ($argc >= 2) {
	$argument_file_in = $argv[1];
	if (substr($argument_file_in, -3) !== ".cy") {
		exit("! \033[31mUsage: ddlcpcydec.php <asset file *.cy> [output file]\033[0m\n");
	}
	if ($argc >= 3) {
		$argument_file_out = $argv[2];
	} else {
		$argument_file_out = substr($argument_file_in, 0, -2) . "assets";
	}
} else {
	exit("- \033[33mUsage: ddlcpcydec.php <asset file *.cy> [output file]\033[0m\n");
}

/**
 * XOR for string
 * 
 * @access public
 * @param string $str String to be processed
 * @param int $key XOR Key
 * @return string Processed string
 */
function xor_string($str, $key = 40) {
	$result = "";
	for ($i = 0; $i < strlen($str); $i++) {
		$result .= chr(ord($str[$i]) ^ $key);
	}
	return $result;
}

$file_in = fopen($argument_file_in, "r") or exit("! \033[33mUnable to open in file!\033[0m\n");
$file_out = fopen($argument_file_out, "a") or exit("! \033[33mUnable to open out file!\033[0m\n");

print("- Loading encrypted file " . $argument_file_in . "...\n");
print("- File size: " . filesize($argument_file_in) . " Bytes.\n");
print("- Cache size: " . $cache_capacity . " Bytes.\n");

$cache = "";

while (!feof($file_in)){
	$cache .= fgetc($file_in);
	if (strlen($cache) >= $cache_capacity) {
		print("- Decrypting cached data...\n");
		fwrite($file_out, xor_string($cache));
		$cache = "";
	}
}
if ($cache !== "") {
	print("- Decrypting cached data...\n");
	fwrite($file_out, xor_string($cache));
}

fclose($file_in);
fclose($file_out);

exit("- \033[32mDone!\033[0m Decrypted file is output to " . $argument_file_out . ".\n");
?>