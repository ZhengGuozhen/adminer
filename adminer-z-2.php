<?php

$token = '';

if (isset($_GET["token"])) {
    
    $token = $_GET['token'];
    echo "<div>$token</div>";

    $res = send_get('http://127.0.0.1:8001/api/test/1', $token);
    echo $res;
        
    exit;
}

// php 后端模拟登录 post 请求
// 失败
	if (isset($_GET["login"])) {
        setcookie("adminer_key",'6f42d5f366e66da79e571691623d7812');
        setcookie("adminer_sid",'1a6ac02584b1d7b184073b0415e92cf7');
        
        $test = $_GET['login'];
        echo "<div>$test</div>";

        $post_data = array(
            'auth[driver]' => 'server',
            'auth[server]' => '127.0.0.1:3306',
            'auth[username]' => 'root',
            'auth[password]' => '123456',
            'auth[db]' => ''
        );
        $res = send_post('http://127.0.0.1:8090/adminer-zgz.php', $post_data);
        echo $res;
            
        exit;
    }

    function send_post($url, $post_data) {
        $postdata = http_build_query($post_data);
        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n" . 
                            "User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\r\n" . 
                            "Cookie: adminer_key=6f42d5f366e66da79e571691623d7812; adminer_sid=1a6ac02584b1d7b184073b0415e92cf7;\r\n"
                            ,
                'content' => $postdata,
                'timeout' => 0.05 * 60 // 超时时间（单位:s）
                )
        );
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        return $result;
    };
    //使用方法
    // $post_data = array(
    // 'auth[driver]' => 'server',
    // 'auth[server]' => '127.0.0.1:3306',
    // 'auth[username]' => 'root',
    // 'auth[password]' => '123456',
    // 'auth[db]' => ''
    // );
    // send_post('http://127.0.0.1:8090/adminer-zgz.php', $post_data);


    function send_get($url, $token) {
        // print_r($token);
        $options = array(
            'http' => array(
                'method' => 'GET',
                'header' => "Content-Type: application/json\r\n" . 
                            "Authorization: " . $token . "\r\n"
                            ,
                'timeout' => 0.05 * 60 // 超时时间（单位:s）
                )
        );
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        return $result;
    };
	