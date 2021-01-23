<?php

namespace frontend\components;

use Yii;
use yii\helpers\Json;
use yii\base\Widget;

class InstagramWidget extends Widget
{
    /**
     * The API base URL
     */
    const API_URL = 'https://api.instagram.com/v1/';

    /**
     * Access Token
     */
    public $_accessToken;

    public $isCacheEnabled = true;
    public $cacheTime = 3600;

    public $count = 6;

    public function init()
    {
        parent::init();
    }

    public function run()
    {

        $media = $this->findMediaByUser('self', $this->count);

        return $this->render('instagram', [
            'media' => $media,
        ]);
    }

    /**
     * @param $user
     * @param $count
     * @return bool|mixed
     * @throws \Exception
     */
    public function findMediaByUser($user, $count)
    {
        if (empty($user)) {
            throw new \Exception('Empty \'user\' argument');
            //return false;
        }

        $key = 'app_instagram_find_media_by_user_' . $user . '_' . $count;

        if ($this->isCacheEnabled) {
            $media = Yii::$app->cache->get($key);
        }

        if ($media === false || !$this->isCacheEnabled) {
            $media = $this->getUserMedia($user, $count);

            if ($this->isCacheEnabled) {
                Yii::$app->cache->set($key, $media, $this->cacheTime);
            }
        }

        if (!empty($media->meta->error_message)) {
            throw new \Exception($media->meta->error_message);
        }

        return $media;
    }

    /**
     * Get user recent media
     * @param string [optional] $id        Instagram user ID
     * @param integer [optional] $limit     Limit of returned results
     * @return mixed
     * @throws \Exception
     */
    public function getUserMedia($id = 'self', $limit = 0) {
        return $this->_makeCall('users/' . $id . '/media/recent', true, ['count' => $limit]);
    }

    /**
     * The call operator
     *
     * @param string $function              API resource path
     * @param boolean [optional] $auth      Whether the function requires an access token
     * @param array [optional] $params      Additional request parameters
     * @param string [optional] $method     Request type GET|POST
     * @return mixed
     * @throws \Exception
     */
    protected function _makeCall($function, $auth = true, $params = null, $method = 'GET') {
        if(true === $auth) {

            if (true === isset($this->_accessToken)) {
                $authMethod = '?access_token=' . $this->_accessToken;
            } else {
                throw new \Exception("Error: _makeCall() | $function - This method requires an authenticated users access token.");
            }
        } else {
            throw new \Exception("Error: _makeCall() | $function - This method requires an authenticated users access token.");
        }

        if (isset($params) && is_array($params)) {
            $paramString = '&' . http_build_query($params);
        } else {
            $paramString = null;
        }

        $apiCall = self::API_URL . $function . $authMethod . (('GET' === $method) ? $paramString : null);

        $headerData = ['Accept: application/json'];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiCall);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headerData);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $jsonData = curl_exec($ch);
        if (false === $jsonData) {
            throw new \Exception("Error: _makeCall() - cURL error: " . curl_error($ch));
        }
        curl_close($ch);

        return Json::decode($jsonData, false);
    }
}