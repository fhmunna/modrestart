<?php
class ModemHandler
{
    private $username;
    private $password;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function restart()
    {
        $this->completeAuth();
        $this->triggerRestart();
    }

    private function completeAuth()
    {

        $hiddenPassword = md5($this->password);
        $postData = "LoginUserName={$this->username}&LoginPassword=ZyXEL+ZyWALL+Series&hiddenPassword={$hiddenPassword}&Prestige_Login=Login&Adv1_Language=00000000";

        $curl = curl_init("http://192.168.1.1/Forms/rpAuth_1");
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    private function triggerRestart()
    {
        return file_get_contents("http://192.168.1.1/RestartDone.html");
    }

}


$modem = new ModemHandler("user", "phpGeek");
$modem->restart();