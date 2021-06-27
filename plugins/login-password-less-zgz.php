<?php

/** Enable login for password-less database
* @link https://www.adminer.org/plugins/#use
* @author Jakub Vrana, https://www.vrana.cz/
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerLoginPasswordLess_zgz {
	/** @access protected */
	var $password_hash;
	
	/** Set allowed password
	* @param string result of password_hash
	*/
	function __construct($password_hash) {
		$this->password_hash = $password_hash;
	}

	function credentials() {
		$password = get_password();

		if (true) {
			// cool-admin 后台鉴权，token 作为用户密码传入
			$token = $password;
			$options = array(
				'http' => array(
					'method' => 'GET',
					'header' => "Content-Type: application/json\r\n" . 
								"Authorization: " . $token . "\r\n"
								,
					'timeout' => 0.1 * 60 // 超时时间（单位:s）
					)
			);
			$context = stream_context_create($options);
			$result = file_get_contents('http://127.0.0.1:8001/api/test/1', false, $context);
			$resultObject =  json_decode($result, false);
			$r = $resultObject->code;
			// echo $r;
	
			if ( $r === 1000 ) {
				return array(SERVER, "root", "123456");
			} else {
				return array(SERVER, "", "");
			}
			
		} else {
			return array(SERVER, $_GET["username"], $password);
		}

	}
	
	function login($login, $password) {
		// @zgz
		// if ($password != "") {
		// 	return true;
		// }
		return true;
	}

}
