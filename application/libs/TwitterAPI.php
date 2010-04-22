<?php

class TwitterAPI {

    const TWITTER_URL = 'http://twitter.com/';

    private $user;
    private $password;

    public function __construct($user, $password) {
        $this->user = $user;
        $this->password = $password;
    }

    public function tweet($msg) {
        $url = self::TWITTER_URL . 'statuses/update.json';
        $params = array('status', $msg);
        return $this->request($url, $params);
    }

    public function timeline() {
        $url = self::TWITTER_URL . 'statuses/user_timeline.json';
        return $this->request($url);
    }

    public function search($query) {}

    private function request($url, $params = array()) {
        $context = stream_context_create(array(
            'http' => array(
                'method'  => 'POST',
                'header'  => $this->header(),
                'content' => http_build_query($params),
                'timeout' => 5,
            ),
        ));
        $ret = file_get_contents($url, false, $context);
        return json_decode($ret);
    }

    private function header() {
        $auth = base64_encode($this->user . ':' . $this->password);
        return sprintf("Authorization: Basic %s\r\n", $auth)
               . "Content-type: application/x-www-form-urlencoded\r\n";
    }

}

?>
