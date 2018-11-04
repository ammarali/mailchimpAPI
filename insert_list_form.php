<?php
/**
 * Created by PhpStorm.
 * User: ammar
 * Date: 11/1/2018
 * Time: 7:25 PM
 */
require_once 'database/database.php' ;
require_once 'src/lists.php' ;
if(isset($_POST['submit'])) {

    $list_object = new lists(API_KEY, USERNAME);
    $list_object->Set_list_name($_POST['list_name']);
    $list_object->Set_company($_POST['company_name']);
    $list_object->Set_address1($_POST['address1']);
    $list_object->Set_address2($_POST['address2']);
    $list_object->Set_city($_POST['city']);
    $list_object->Set_zip($_POST['zip']);
    $list_object->Set_state($_POST['state']);
    $list_object->Set_country($_POST['country']);
    $list_object->Set_phone($_POST['phone']);
    $list_object->Set_campaign_from_name($_POST['from_name']);
    $list_object->Set_campaign_from_email($_POST['from_email']);
    $list_object->Set_campaign_language($_POST['from_language']);
    $list_object->Set_campaign_subject($_POST['subject']);

    $list_object->Create_list();

    header('Location: index.php?successful=true');
}
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Mail Chimp Lists Form</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
    <script type="text/css" src="bootstrap/js/bootstrap.js"></script>
</head>
<body>
<div class="container">
    <h1> Welcome to Mail Chimp API Application -> Create New List</h1>
    <br>
    <br>
    <a href="index.php" class="btn btn-primary">Back</a>
    <br><br>
    <form method="post" action="insert_list_form.php">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="list_name" placeholder="Enter List Name">
        </div>

        <div class="form-group">
            <label for="company_name">Company Name</label>
            <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Enter Company Name">
        </div>

        <div class="form-group">
            <label for="address1">Address 1</label>
            <input type="text" class="form-control" id="address1" name="address1" placeholder="Enter Address 1">
        </div>

        <div class="form-group">
            <label for="address2">Address 2</label>
            <input type="text" class="form-control" id="address2" name="address2" placeholder="Enter Address 2">
        </div>

        <div class="form-row">

            <div class="form-group col-md-6">
                <label for="city">City</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Enter City">
            </div>

            <div class="form-group col-md-4">
                <label for="zip">Zip Code</label>
                <input type="text" class="form-control" id="zip" name="zip" placeholder="Enter Zip Code">
            </div>

            <div class="form-group col-md-2">
                <label for="state">State</label>
                <input type="text" class="form-control" id="state" name="state" placeholder="Enter State">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="country">Country</label>
                <input type="text" class="form-control" id="country" name="country" placeholder="Enter Country">
            </div>

            <div class="form-group col-md-6">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number">
            </div>
        </div>

        <div class="form-group">
            <label for="from_name">Campaign Name</label>
            <input type="text" class="form-control" id="from_name" name="from_name" placeholder="Enter Campaign From Name">
        </div>

        <div class="form-row">

            <div class="form-group col-md-6">
                <label for="from_email">E-mail</label>
                <input type="email" class="form-control" id="from_email" name="from_email" placeholder="Enter Campaign From E-mail">
            </div>

            <div class="form-group  col-md-4">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter Campaign Subject">
            </div>

            <div class="form-group  col-md-2">
                <label for="from_language">Language</label>
                <select class="form-control" id="from_language" name="from_language">
                    <option value="EN">English</option>
                    <option value="FR">French</option>
                    <option value="GR">German</option>
                </select>
            </div>

        </div>

        <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
    </form>
</div>
</body>
</html>
