<?php

// @zgz
// 针对嵌入 iframe 的应用场景，重新设计了鉴权方式

class AdminerLoginPasswordLess_zgz {
	
	var $mode;
	
	function __construct($p = "normal") {
		$this->mode = $p;
	}

	function credentials() {
		$password = get_password();

		if ($this->mode === "token") {
			// cool-admin 后台鉴权
			// 用户名为数据库用户名
			// 用户密码为 cool-admin token
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
				// 鉴权通过，设置数据库账号密码
				return array(SERVER, "root", "123456");
			} else {
				return array(SERVER, "", "");
			}

		} else if ($this->mode === "normal"){

			// 用户名密码鉴权
			return array(SERVER, $_GET["username"], $password);

		} else if ($this->mode === "none"){

			// 无鉴权，有安全风险！
			return array(SERVER, "root", "123456");

		} else {

			// 用户名密码鉴权
			return array(SERVER, $_GET["username"], $password);
			
		}

	}
	
	function login($login, $password) {
		// @zgz 允许无密码用户登录
		// if ($password != "") {
		// 	return true;
		// }
		return true;
	}

}
