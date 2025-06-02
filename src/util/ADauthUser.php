<?php

namespace abilioj\ToolToDev\util;

use abilioj\ToolToDev\models\ADUser;

/**
 * Description of ADauthUser
 *  Função de validação no AD via protocolo LDAP
 * como usar:
 * valida_ldap("servidor", "domíniousuário", "senha");
 * @package util
 * @author abilio.jose
 */
class ADauthUser {

    private $arrayData;
    private $configAD;
    private $conn;
    private $conn_authentication;
    private $ldap_server;
    private $ldap_domain;
    private $ldap_port;
    private $ldap_filter_ad;
    private $ldap_group_ad;
    private $auth_user;
    private $auth_pwd;
    private $stn_User_authentication;
    private $auth_msg;
    private $isOK;

    public function __construct() {
        $this->isOK = false;
        $this->arrayData = null;
        $this->conn = null;
        $this->conn_authentication = null;
        $this->configAD = new ConfigADClass();
        $this->ldap_server = $this->configAD->getHostServer();
        $this->ldap_domain = $this->configAD->getDnsname();
        $this->ldap_port = $this->configAD->getPort();
        $this->ldap_filter_ad = $this->configAD->getFilter_ad();
        $this->ldap_group_ad = $this->configAD->getGroup_ad();
    }

    /**
     * Metodo para coneceta no ad
     * @access private
     * @param String ${user} logan
     * @param String ${pwd}
     * @return boolean
     */
    private function getConnect($user, $pwd): bool {
        $this->auth_user = $user;
        $this->auth_pwd = $pwd;
        $this->stn_User_authentication = $this->auth_user . "@" . $this->ldap_domain;
        // Tenta se conectar com o servidor
        if (!($this->conn = ldap_connect($this->ldap_server, $this->ldap_port))) {
            $this->auth_msg = "Não foi possível conexão com Active Directoy";
            $this->isOK = FALSE;
        }
        ldap_set_option($this->conn, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($this->conn, LDAP_OPT_REFERRALS, 0);
        // Tenta autenticar no servidor
        if (!($this->conn_authentication = @ldap_bind($this->conn, $this->stn_User_authentication, $this->auth_pwd))) {
            $this->auth_msg = "Não foi possível pesquisa no AD.";
            ldap_close($this->conn);
            $this->isOK = FALSE;
        } else {
            $this->auth_msg = "retorna true";
            $this->isOK = TRUE;
        }
        return $this->isOK;
    }

    /**
     * Metodo para desconeceta do ad
     * @access private
     * @return void
     */
    private function disconnects() {
        ldap_close($this->conn);
        unset($this->conn);
        unset($this->conn_authentication);
    }

    public function Authenticate_AD($user, $pwd): bool {
        $this->isOK = false;
        if ($user == "" || $user == NULL && $pwd == "" || $pwd == NULL):
            return $this->isOK;
        endif;
        // Tenta se conectar com o servidor
        $this->isOK = $this->getConnect($user, $pwd);
        if (!$this->isOK) {
            return $this->isOK;
        }
        $search = ldap_search($this->conn, $this->ldap_group_ad, $this->ldap_filter_ad . ")"); 
        if (!$search):
            $this->auth_msg = ldap_errno($this->conn);
            $this->isOK = false;
        else:
            $this->isOK = true;
        endif;
        $this->disconnects();
        return $this->isOK;
    }

    public function User_Authenticate_AD($user, $pwd): mixed {
        $this->isOK = false;
        $OadUser = new ADUser();
        if ($user == "" || $user == NULL && $pwd == "" || $pwd == NULL):
            return $this->isOK;
        endif;
        // Tenta se conectar com o servidor
        $this->isOK = $this->getConnect($user, $pwd);
        if (!$this->isOK) {
            return $this->isOK;
        }
        $search = ldap_search($this->conn, $this->ldap_group_ad, $this->ldap_filter_ad . "(sAMAccountname={$user}))");
        if (!$search):
            $this->auth_msg = ldap_errno($this->conn);
            $this->isOK = false;
        else:
            $arrayData = ldap_get_entries($this->conn, $search);
            $rowData = ldap_count_entries($this->conn, $search);
            $OadUser = $this->copularObject($arrayData, $rowData);
        endif;
        $this->disconnects();
        return $OadUser;
    }

    public function Users_Authenticate_AD($user, $pwd, $isUser = false): array {
        $this->arrayData = [];
        $this->isOK = false;
        if ($user == "" || $user == NULL && $pwd == "" || $pwd == NULL):
            return $this->arrayData;
        endif;
        // Tenta se conectar com o servidor
        $this->isOK = $this->getConnect($user, $pwd);
        if (!$this->isOK) {
            return $this->arrayData;
        }
        $search = ldap_search($this->conn, $this->ldap_group_ad, $this->ldap_filter_ad . ""); //(sAMAccountname={$user})
        if (!$search):
            $this->auth_msg = ldap_errno($this->conn);
            $this->isOK = false;
        else:
            $arrayData = ldap_get_entries($this->conn, $search);
            $rowData = ldap_count_entries($this->conn, $search);

            if ($isUser):
                for ($i = 0; $i < $rowData; $i++) {
                    if ($arrayData[$i]["samaccountname"][0] == $user):

                    $dn = $arrayData[$i]["distinguishedname"][0];
                    // Expressão regular para extrair todas as OUs
                    preg_match_all('/OU=([^,]+)/', $dn, $matches);
                    $organizationalUnits = $matches[1];

                    $this->arrayData = array(
                        "nomeCompleto" => $arrayData[$i]["name"][0]
                        , "nome" => $arrayData[$i]["givenname"][0]
                        , "sobrenome" => $arrayData[$i]["sn"][0]
                        , "silga" => $arrayData[$i]["initials"][0]
                        , "login" => $arrayData[$i]["samaccountname"][0]
                        , "dn" => implode('/', array_reverse($organizationalUnits))
                        , "grupos" => isset($arrayData[$i]["memberof"]) ? $arrayData[$i]["memberof"] : []
                        , "email" => $arrayData[$i]["mail"][0]
                    );
                        break;
                    endif;
                }
            else:
                for ($i = 0; $i < $rowData; $i++) {

                    $dn = $arrayData[$i]["distinguishedname"][0];
                    // Expressão regular para extrair todas as OUs
                    preg_match_all('/OU=([^,]+)/', $dn, $matches);
                    $organizationalUnits = $matches[1];

                    $this->arrayData[] = array(
                        "nomeCompleto" => $arrayData[$i]["name"][0]
                        , "nome" => $arrayData[$i]["givenname"][0]
                        , "sobrenome" => $arrayData[$i]["sn"][0]
                        , "silga" => $arrayData[$i]["initials"][0]
                        , "login" => $arrayData[$i]["samaccountname"][0]
                        , "dn" => implode('/', array_reverse($organizationalUnits))
                        , "grupos" => isset($arrayData[$i]["memberof"]) ? $arrayData[$i]["memberof"] : []
                        , "email" => $arrayData[$i]["mail"][0]
                    );
                }
            endif;

        endif;
        $this->disconnects();
        return $this->arrayData;
    }

    private function copularObject($arrayData, $rowData): ADUser {
        $OadUser = new ADUser();
        for ($i = 0; $i < $rowData; $i++) {
            $OadUser->setFullName($arrayData[$i]["name"][0]);
            $OadUser->setName($arrayData[$i]["givenname"][0]);
            $OadUser->setLastName($arrayData[$i]["sn"][0]);
            $OadUser->setInitials($arrayData[$i]["initials"][0]);
            $OadUser->setAuthName($arrayData[$i]["samaccountname"][0]);
            $OadUser->setDn($arrayData[$i]["distinguishedname"][0]);
            $OadUser->setGroups($arrayData[$i]["memberof"][0]); 
            $OadUser->setMail($arrayData[$i]["mail"][0]);
        }
        return $OadUser;
    }

    public function getAuth_msg() {
        return $this->auth_msg;
    }

    public function getIsOK() {
        return $this->isOK;
    }
}