<?php
/**
 * Created by PhpStorm.
 * User: ammar
 * Date: 11/1/2018
 * Time: 6:28 PM
 */
require_once '../config.php';
require_once '../src/lists.php';

class test_lists {

    public function test_create_list($data) {

        $list_object = new lists(API_KEY, USERNAME);
        $list_object->Set_list_name($data['name']);
        $list_object->Set_company($data['company_name']);
        $list_object->Set_address1($data['address1']);
        $list_object->Set_address2($data['address2']);
        $list_object->Set_city($data['city']);
        $list_object->Set_zip($data['zip']);
        $list_object->Set_state($data['state']);
        $list_object->Set_country($data['country']);
        $list_object->Set_phone($data['phone']);
        $list_object->Set_campaign_from_name($data['from_name']);
        $list_object->Set_campaign_from_email($data['from_email']);
        $list_object->Set_campaign_language($data['language']);
        $list_object->Set_campaign_subject($data['subject']);

        $list_object->Create_list();
    }

    public function test_update_list($data, $list_id){

        $list_object = new lists(API_KEY, USERNAME, $list_id);

        $list_object->Set_list_name($data['name']);
        $list_object->Set_address1($data['address1']);
        $list_object->Set_campaign_from_email($data['from_email']);

        $list_object->Update_list();
    }

    public function test_delete_list($list_id) {
        $list_object = new lists(API_KEY, USERNAME, $list_id);
        $list_object->Remove_list();
    }
} 