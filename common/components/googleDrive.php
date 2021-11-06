<?php

namespace common\components;


use Yii;
use yii\base\Component;

/**
 * Class googleDrive
 * @package common\components
 */
class googleDrive extends Component
{
    public $client_id;
    public $client_secret;
    public $client_refresh_token;
    public $grant_type;
    public $files_api;
    public $refresh_token_api;
    public $access_token;
    public $scope;
    public $is_enabled = false;

    const CLIENT_ID = 'client_id';
    const CLIENT_SECRET = 'client_secret';
    const REFRESH_TOKEN = 'refresh_token';
    const GRANT_TYPE = 'grant_type';


    public function init()
    {
        parent::init();
        $this->is_enabled = Yii::$app->params['googleDrive_enabled'];
    }


    /* This Function to get all root data from google drive for client */
    public function getDriveData()
    {
        /* check if service is enable or not */
        if(!$this->is_enabled) {
            return;
        }
        $url = $this->files_api;

        $token = $this->getToken();

        if($token) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer ' . $token
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            return json_decode($response, 'true');
        }

        return 401;

    }

    /* Function to generate new token */
    private function getToken()
    {
        try {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->refresh_token_api,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => self::CLIENT_SECRET . '=' . $this->client_secret . '&' . self::GRANT_TYPE . '=' . $this->grant_type . '&' . self::REFRESH_TOKEN . '=' . $this->client_refresh_token . '&' . self::CLIENT_ID . '=' . $this->client_id,
                CURLOPT_HTTPHEADER => array(
                    'Content-Length: 279',
                    'Content-Type: application/x-www-form-urlencoded',
                    'user-agent: google-oauth-playground'
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);

            $response = json_decode($response, true);
            $this->access_token = isset($response['access_token']) ? $response['access_token'] : null;

            return $this->access_token;

        } catch (\Exception $ex) {
            return $ex;
        }
    }
}