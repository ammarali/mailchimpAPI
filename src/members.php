<?php
class members{

    private $username= ""; //String
    private $api_key = ""; //String
    private $list_id = ""; //String
    private $members = array();

	public function members($api_key, $username, $list_id){

		$this->api_key = $api_key;
        $this->username = $username;
        $this->list_id = $list_id;

        if(isset($list_id)) {
            $this->intialize_members();
        }

	}

    private function intialize_members() {

        $results = $this->GetAllMembers();

        foreach($results->{'members'} as $result) {

            $id = $result->{'id'};
            $email_address = $result->{'email_address'};
            $status = $result->{'status'};

            array_push($this->members,array( 'id' => $id, 'email_address' => $email_address, 'status' => $status));
        }

    }

	public function Add_member() {
		
	}
	
	public function Update_member(){
		
	}
	
	public function Remove_member(){
		
	}

    public function GetAllMembers() {

        $apiKey = $this->api_key;
        $dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
        $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $this->list_id . '/members';

        $ListMembers = $this->api_Request($url, null, 'GET');

        return $ListMembers;
    }

    private function api_Request($service_url, $data = null, $type = 'POST'){ //$type can be 'POST', 'PATCH'

        $ch = curl_init($service_url);

        curl_setopt($ch, CURLOPT_USERPWD, $this->username . ':' . $this->api_key);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $curl_response = curl_exec($ch);
        if ($curl_response === false) {
            $info = curl_getinfo($ch);
            curl_close($ch);
            die('error occured during curl exec. Additioanl info: ' . var_export($info));
        }
        curl_close($ch);

        $decoded = json_decode($curl_response);
        if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
            die('error occured: ' . $decoded->response->errormessage);
        }


        return $decoded;

    }

    /**
     * @return array
     */
    public function getMembers()
    {
        return $this->members;
    }

}
?>