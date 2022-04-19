<?php
class Anymarket
{
    public static function create(array $params)
    {
        $config_url = get_option('anymarket_input_0') . "/orders";
        $config_token = get_option('anymarket_input_1');
        $params_json = json_encode($params);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $config_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $params_json,
            CURLOPT_HTTPHEADER => array(
                'gumgaToken: ' . $config_token . '',
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public static function products()
    {
        $config_url = get_option('anymarket_input_0') . "/products";
        $config_token = get_option('anymarket_input_1');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $config_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'gumgaToken: ' . $config_token . '',
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public static function registerdb($data){
        global $wpdb;
        $table_name = $wpdb->prefix . 'anymarket';        
        $wpdb->insert($table_name,array('content' => $data,'time' => current_time('mysql')));
    }

    public static function response()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'anymarket';
        $results = $wpdb->get_results(
            "SELECT * FROM $table_name"
        );
        return $results;
    }
}
