<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

/*
 * displays a translator email
 */

if (empty($argv[1]) or empty($argv[2])) {
    exit('usage: display_email <key> <obfuscated email>');
}

$key = $argv[1];
$obfuscated_email = $argv[2];
echo trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($obfuscated_email), MCRYPT_MODE_ECB));
