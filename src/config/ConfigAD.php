<?php

namespace abilioj\ToolToDev\config;

/**
 * Description of ConfigAD
 *
 * @author Abílio José
 */
class ConfigAD {
    
    private $hostServer;
    private $dnsname;
    private $user_auth;
    private $pwd_auth;
    private $port;
    private $stn_User_authentication;
    private $filter_ad;
    private $group_ad;
    private $isOk;
    private $op;
    
    public function __construct() {     
        $this->hostServer = $_ENV['AD_HOST'];
        $this->dnsname = $_ENV['AD_DNSNAME'];
        $this->user_auth = $_ENV['AD_USER'];
        $this->pwd_auth = $_ENV['AD_PWD'];
        $this->group_ad = $_ENV['AD_GROUP_AD'];
        $this->port = $_ENV['AD_port']; 
        $this->filter_ad = $_ENV['AD_FILTER'];
        $this->isOk = FALSE; 
    }
    
    public function getHostServer() {
        return $this->hostServer;
    }

    public function getDnsname() {
        return $this->dnsname;
    }

    public function getUser_auth() {
        return $this->user_auth;
    }

    public function getPwd_auth() {
        return $this->pwd_auth;
    }

    public function getPort() {
        return $this->port;
    }

    public function getStn_User_authentication() {
        return $this->stn_User_authentication;
    }

    public function getFilter_ad() {
        return $this->filter_ad;
    }

    public function getGroup_ad() {
        return $this->group_ad;
    }

    public function getIsOk() {
        return $this->isOk;
    }

    public function getOp() {
        return $this->op;
    }

    public function setUser_auth($user_auth) {
        $this->user_auth = $user_auth;
    }

    public function setPwd_auth($pwd_auth) {
        $this->pwd_auth = $pwd_auth;
    }

}
