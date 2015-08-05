<?php

function test(){
    $json = file_get_contents('http://api.kme.si/v1/articles?resource_id=22&order=desc&limit=20');
    $data = json_decode($json, true);
    //echo $data->{'token'}; //if json not true

    for ($i = 0; $i <= 19; $i++) {

        $title = $data['data']['list'][$i]['title'];
        $section = $data['data']['list'][$i]['section_name'];
        $image = $data['data']['list'][$i]['image'];

        echo $title . "<br>" . $section . "<br>" . $image . "<br><br>";
    }
}

function redir(){

    if(Auth::check()) {
        $value = Cookie::get('access_token');
        if(!isset($value)) {
            $ch = curl_init("http://laravel.task/oauth/access_token");
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            $fields = array(
                'grant_type' => 'password',
                'client_id' => 'NNhYYhR1P4V5ADWU',
                'client_secret' => 'jdI2Hu5KQ2uCuBu8pImdFjgXDyP5hO7e',
                'username' => Auth::user()->name,
                'password' => "test123"
            );
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            $data = curl_exec($ch);
            $resp = json_decode($data, true);
            $access_token = $resp['access_token'];
            $minutes = 1;

            Cookie::queue('access_token', $access_token, $minutes);
        }

        function get_articles($token){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://laravel.task/api/articles/". Auth::user()->id);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $headers = array();
            $headers[] = 'Authorization: Bearer '. $token;
            $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=utf-8';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $server_output = curl_exec($ch);
            curl_close($ch);

            return $server_output;
        }

        return get_articles(isset($access_token) ? $access_token : $value);

    } else {
        return redirect('auth/login');
    }
}