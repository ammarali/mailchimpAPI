<?php
class lists{
	private $username= ''; //String
	private $api_key = ''; //String
	private $list_id = ''; //String
	private $list_web_id = 0; //integer
	private $list_name; //String
	private $contact = array(); //Object
	private $company = ""; //String
	private $address1 = ""; //String
	private $address2 = ""; //String
	private $city = ""; // String
	private $state = ""; //String
	private $zip = ""; //String
	private $country = ""; // String
	private $phone = "";
	private $permission_reminder = "Need to Update";  //String
	private $use_archive_bar = false; //boolean
	private $campaign_defaults = array(); //object
	private $campaign_from_name = ""; //String
	private $campaign_from_email = ""; //String email
	private $campaign_subject = ""; // String
	private $campaign_language = ""; //String
	private $notify_on_subscribe = ""; // String
	private $notify_on_unsubscribe = ""; //String
	private $email_type_option = false; //boolean
	private $visibility = "pub"; // possible values 'pub' or 'prv'
	private $double_optin = false; // bolean
	private $marketing_permissions = false; //boolean
	
	
	public function lists($api_key, $username, $list_id =  null){
		
		$this->api_key = $api_key;
		$this->username = $username;
		$this->list_id = $list_id;
		
		if(isset($list_id)) {
			$this->intialize_list();
		}
	}
	
	private function intialize_list() {
		
		$result = $this->GetListByID();
		
		$this->list_id = $result->{'id'};
		$this->list_web_id = $result->{'web_id'};
		$this->list_name = $result->{'name'};
		$this->company = $result->{'contact'}->{'company'};
		$this->address1 = $result->{'contact'}->{'address1'};
		$this->address2 = $result->{'contact'}->{'address2'};
		$this->city = $result->{'contact'}->{'city'};
		$this->state = $result->{'contact'}->{'state'};
		$this->zip = $result->{'contact'}->{'zip'};
		$this->country = $result->{'contact'}->{'country'};
		$this->phone = $result->{'contact'}->{'phone'};
		$this->permission_reminder = $result->{'permission_reminder'};
		$this->use_archive_bar = $result->{'use_archive_bar'};
		$this->campaign_from_name = $result->{'campaign_defaults'}->{'from_name'};
		$this->campaign_from_email = $result->{'campaign_defaults'}->{'from_email'};
		$this->campaign_subject = $result->{'campaign_defaults'}->{'subject'};
		$this->campaign_language = $result->{'campaign_defaults'}->{'language'};
		$this->notify_on_subscribe = $result->{'notify_on_subscribe'};
		$this->notify_on_unsubscribe = $result->{'notify_on_unsubscribe'};
		$this->email_type_option = $result->{'email_type_option'};
		$this->visibility = $result->{'visibility'};
		$this->double_optin = $result->{'double_optin'};
		$this->marketing_permissions = $result->{'marketing_permissions'};

	}
	
	public function Create_list(){
		
		$data = array (
				'name' 				  	=> $this->list_name,
				'contact' 			  	=> $this->Get_contact(),
				'permission_reminder' 	=> $this->permission_reminder,
				'use_archive_bar' 	  	=> $this->use_archive_bar,
				'campaign_defaults'   	=> $this->Get_campaign_defaults(),
				'notify_on_subscribe' 	=> $this->notify_on_subscribe,
				'notify_on_unsubscribe' => $this->notify_on_unsubscribe,
				'email_type_option'		=> $this->email_type_option,
				'visibility'			=> $this->visibility,
				'double_optin'			=> $this->double_optin,
				'marketing_permissions' => $this->marketing_permissions
		);
		
		$apiKey = $this->api_key;
		$dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
		$url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists';
	
		$this->api_Request($url, json_encode($data), 'POST');
		
	}
	
	public function Update_list() {
	
		$data = array (
				'name' 				  	=> $this->list_name,
				'contact' 			  	=> $this->Get_contact(),
				'permission_reminder' 	=> $this->permission_reminder,
				'use_archive_bar' 	  	=> $this->use_archive_bar,
				'campaign_defaults'   	=> $this->Get_campaign_defaults(),
				'notify_on_subscribe' 	=> $this->notify_on_subscribe,
				'notify_on_unsubscribe' => $this->notify_on_unsubscribe,
				'email_type_option'		=> $this->email_type_option,
				'visibility'			=> $this->visibility,
				'double_optin'			=> $this->double_optin,
				'marketing_permissions' => $this->marketing_permissions
		);
		
		$apiKey = $this->api_key;
		$dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
		$url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/'. $this->list_id;
		
		$this->api_Request($url, json_encode($data), 'PATCH');
		
	}
	
	public function Remove_list(){
		
		$apiKey = $this->api_key;
		$dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
		$url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/'. $this->list_id;
		
		$this->api_Request($url, null , 'DELETE');
		
	}
	
	public function GetListByID() {
		
		$apiKey = $this->api_key;
		$dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
		$url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $this->list_id;
		
		$ListData = $this->api_Request($url, null, 'GET');
		
		return $ListData;
		
	}
	
	public function GetAllLists() {
		
		$apiKey = $this->api_key;
		$dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
		$url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists';
		
		$ListData = $this->api_Request($url, null, 'GET');
		
		return $ListData;
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
	
	///////////////////////Getters and Setters /////////////////////////////////////
	
	public function Get_list_id() {
		return $this->list_id;
	}
	
	public function Set_list_id($list_id) {
		$this->list_id = $list_id;
	}
	
	public function Get_list_name() {
		return $this->list_name;
	}
	
	public function Set_list_name($listname) {
		$this->list_name = $listname;
	}
	
	public function Get_company() {
		return $this->company;
	}
	
	public function Set_company($company) {
		$this->company = $company;
	}
	
	public function Get_address1() {
		return $this->address1;
	}
	
	public function Set_address1($address1) {
		$this->address1 = $address1;
	}
	
	public function Get_address2() {
		return $this->address2;
	}
	
	public function Set_address2($address2) {
		$this->address2 = $address2;
	}
	
	public function Get_city() {
		return $this->city;
	}
	
	public function Set_city($city) {
		$this->city = $city;
	}
	
	public function Get_zip() {
		return $this->zip;
	}
	
	public function Set_zip($zip) {
		$this->zip = $zip;
	}
	
	public function Get_state() {
		return $this->state;
	}
	
	public function Set_state($state) {
		$this->state = $state;
	}
	
	public function Get_country() {
		return $this->country;
	}
	
	public function Set_country($country) {
		$this->country = $country;
	}
	
	public function Get_phone() {
		return $this->phone;
	}
	
	public function Set_phone($phone) {
		$this->phone = $phone;
	}
	
	public function Get_permission_reminder() {
		return $this->permission_reminder;
	}
	
	public function Set_permission_reminder($permission_reminder) {
		$this->permission_reminder = $permission_reminder;
	}
	
	public function Get_use_archive_bar() {
		return $this->use_archive_bar;
	}
	
	public function Set_use_archive_bar($use_archive_bar = false) {
		$this->use_archive_bar = $use_archive_bar;
	}
	
	public function Get_campaign_from_name() {
		return $this->campaign_from_name;
	}
	
	public function Set_campaign_from_name($from_name) {
		$this->campaign_from_name = $from_name;
	}
	
	public function Get_campaign_from_email() {
		return $this->campaign_from_email;
	}
	
	public function Set_campaign_from_email($campaign_from_email) {
		$this->campaign_from_email = $campaign_from_email;
	}
	
	public function Get_campaign_subject() {
		return $this->campaign_subject;
	}
	
	public function Set_campaign_subject($campaign_subject) {
		$this->campaign_subject = $campaign_subject;
	}
	
	public function Get_campaign_language() {
		return $this->campaign_language;
	}
	
	public function Set_campaign_language($campaign_language) {
		$this->campaign_language = $campaign_language;
	}
	
	public function Get_notify_on_subscribe() {
		return $this->notify_on_subscribe;
	}
	
	public function Set_notify_on_subscribe($notify_on_subscribe) {
		$this->notify_on_subscribe = $notify_on_subscribe;
	}
	
	public function Get_notify_on_unsubscribe() {
		return $this->notify_on_unsubscribe;
	}
	
	public function Set_notify_on_unsubscribe($notify_on_unsubscribe) {
		$this->notify_on_unsubscribe = $notify_on_unsubscribe;
	}
	
	public function Get_email_type_option() {
		return $this->email_type_option;
	}
	
	public function Set_email_type_option($email_type_option = false) {
		$this->email_type_option = $email_type_option;
	}
	
	public function Get_visibility() {
		return $this->visibility;
	}
	
	public function Set_visibility($visibility = 'pub') {  // possible values 'pub' or -> 'prv'
		$this->visibility = $visibility;
	}
	
	public function Get_double_optin() {
		return $this->double_optin;
	}
	
	public function Set_double_optin($double_optin = false) { 
		$this->double_optin = $double_optin;
	}
	
	public function Get_marketing_permissions() {
		return $this->marketing_permissions;
	}
	
	public function Set_marketing_permissions($marketing_permissions = false) {
		$this->marketing_permissions = $marketing_permissions;
	}
	
	public function Get_contact(){
		
		$this->contact = array(
								'company'   => $this->company,
								'address1'  => $this->address1,
								'address2'	=> $this->address2,
								'city'		=> $this->city,
								'state'		=> $this->state,
								'zip'		=> $this->zip,
								'country'	=> $this->country,
								'phone'		=> $this->phone
							);
		return $this->contact;
	}
	
	
	public function Get_campaign_defaults(){
	
		$this->campaign_defaults = array(
				'from_name'   => $this->campaign_from_name,
				'from_email'  => $this->campaign_from_email,
				'subject'	=> $this->campaign_subject,
				'language'		=> $this->campaign_language
		);
		return $this->campaign_defaults;
	}
}
?>