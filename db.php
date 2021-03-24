<?php
//phpinfo();
header('Content-type: text/html; charset=utf-8');
session_start();
	
	DEFINE('UNCONFIRMED',0);
	DEFINE('CONFIRMED',1); 
	DEFINE('BUYER',2); 
	DEFINE('SELLER',3);
	DEFINE('BANNED',50);
	DEFINE('MODERATOR',100);
	DEFINE('ADMIN', 101);
	DEFINE('DEVELOPMENT', 1);
	DEFINE('KEY', "testtest");
	if (DEVELOPMENT == 1) {
		ini_set('display_errors', 1);
		error_reporting(E_ALL);
	 } else {
		ini_set('display_errors', 0);
		error_reporting(~0);
	 }
    //konektimi me databaze.
    function db(){
        static $conn;
        if($conn == null){
            $conn = mysqli_connect("localhost", "root", "", "dealaim");
            if(mysqli_connect_errno()){
                die ("Deshtoi lidhja me server: ". mysqli_connect_error() . "( " . mysqli_connect_errno() . " )");
            }
        }
        return $conn;
    }
    function user_id(){
		$conn = db();
		$user_id = "";
		if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){
			$sel_user_id = prep_stmt("SELECT user_id FROM users WHERE username = ?", $_SESSION['user']['username'], "s");
			$sel_user = mysqli_fetch_array($sel_user_id);
			$user_id = $sel_user['user_id'];
		}
		return $user_id;
	}
    //prepared statments
    //1 parameter -> $test1 = prep_stmt("SELECT * FROM `users` WHERE id=?", $id, "i");
	//pa parameter -> $test2 = prep_stmt("SELECT id FROM users", null, null);
	//ma shume se 1 parameter -> $test3 = prep_stmt("SELECT * FROM users WHERE username = ? AND password = ?", array($user, $pass), "ss");
    function prep_stmt($query, $args = NULL, $types = NULL)
	{
		$conn = db();
		$select = false;
		$query2 = explode(" ", $query)[0];
		if($query2 == "SELECT"){
			$select = true;
		}
		$query = mysqli_prepare($conn, "$query");
		if(!$query) {
			if(DEVELOPMENT == 1){
				die ("ERROR :" .mysqli_error($conn));
			}
			else {
				return false;
			}
		}
		if(!is_null($args)){
			if(is_array($args)) {
				$stmt_bp = mysqli_stmt_bind_param($query, $types, ...$args);
			} else {
				$stmt_bp = mysqli_stmt_bind_param($query, $types, $args);
			}
			if(!$stmt_bp) {
				if(DEVELOPMENT == 1 ){
					die("ERROR : Probleme me bind_param()");	
				}
				else {
					return false;
				}
			}
		}
		$stmt_exec = mysqli_stmt_execute($query);
		if(!$stmt_exec) {
			if(DEVELOPMENT == 1 ){
				die ("ERROR : Gabim tek ekzekutimi i prepared statements." . mysqli_stmt_errno($query));
			}
			else {
				return false;
			}
		}
		$result = mysqli_stmt_get_result($query);		
		if($select){
			return $result;
		}
		else {
			return mysqli_stmt_affected_rows($query);
		}
		mysqli_stmt_close($query);
	}

	//encrypt_txt
	function encrypt_txt($plaintext, $password = KEY) {
		$method = "AES-128-CBC";
		$key = hash('sha256', $password, true);
		$iv = openssl_random_pseudo_bytes(16);
		$ciphertext = openssl_encrypt($plaintext, $method, $key, OPENSSL_RAW_DATA, $iv);
		$hash = hash_hmac('sha256', $ciphertext . $iv, $key, true);
		return $iv . $hash . $ciphertext;
	}
	//decrypt txt
	function decrypt_txt($ivHashCiphertext, $password = KEY) {
		$method = "AES-128-CBC";
		$iv = substr($ivHashCiphertext, 0, 16);
		$hash = substr($ivHashCiphertext, 16, 32);
		$ciphertext = substr($ivHashCiphertext, 48);
		$key = hash('sha256', $password, true);
		if (!hash_equals(hash_hmac('sha256', $ciphertext . $iv, $key, true), $hash)) return null;
		return openssl_decrypt($ciphertext, $method, $key, OPENSSL_RAW_DATA, $iv);
	  }	
?>