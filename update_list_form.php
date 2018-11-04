<?php
/**
 * Created by PhpStorm.
 * User: ammar
 * Date: 11/1/2018
 * Time: 7:25 PM
 */
require_once 'database/database.php' ;
require_once 'src/lists.php' ;
if(isset($_GET['action']) && $_GET['action'] == 'DELETE' && isset($_GET['list_id'])) {

    $list_object = new lists(API_KEY, USERNAME, $_GET['list_id']);
    $list_object->Remove_list();

    header('Location: index.php?successful=true');

}
if(isset($_POST['submit']) && isset($_POST['list_id'])) {

    $list_object = new lists(API_KEY, USERNAME, $_POST['list_id']);
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

    $list_object->Update_list();

    header('Location: index.php?successful=true');
}

if(isset($_GET['action']) && $_GET['action'] == 'UPDATE' && isset($_GET['list_id'])) {

    $list_view = new lists(API_KEY, USERNAME, $_GET['list_id']);
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
    <h1> Welcome to Mail Chimp API Application -> Update List</h1>
    <br>
    <br>
    <a href="index.php" class="btn btn-primary">Back</a>
    <br><br>
    <form method="post" action="update_list_form.php">
        <input type="hidden" name="list_id" value="<?php echo $list_view->Get_list_id(); ?>">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="list_name" value="<?php echo $list_view->Get_list_name(); ?>">
        </div>

        <div class="form-group">
            <label for="company_name">Company Name</label>
            <input type="text" class="form-control" id="company_name" name="company_name" value="<?php echo $list_view->Get_company(); ?>">
        </div>

        <div class="form-group">
            <label for="address1">Address 1</label>
            <input type="text" class="form-control" id="address1" name="address1" value="<?php echo $list_view->Get_address1(); ?>">
        </div>

        <div class="form-group">
            <label for="address2">Address 2</label>
            <input type="text" class="form-control" id="address2" name="address2" value="<?php echo $list_view->Get_address2(); ?>">
        </div>

        <div class="form-row">

            <div class="form-group col-md-6">
                <label for="city">City</label>
                <input type="text" class="form-control" id="city" name="city" value="<?php echo $list_view->Get_city(); ?>">
            </div>

            <div class="form-group col-md-4">
                <label for="zip">Zip Code</label>
                <input type="text" class="form-control" id="zip" name="zip" value="<?php echo $list_view->Get_zip(); ?>">
            </div>

            <div class="form-group col-md-2">
                <label for="state">State</label>
                <input type="text" class="form-control" id="state" name="state" value="<?php echo $list_view->Get_state(); ?>">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="country">Country</label>
                <input type="text" class="form-control" id="country" name="country" value="<?php echo $list_view->Get_country(); ?>">
            </div>

            <div class="form-group col-md-6">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $list_view->Get_phone(); ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="from_name">Campaign Name</label>
            <input type="text" class="form-control" id="from_name" name="from_name" value="<?php echo $list_view->Get_campaign_from_name(); ?>">
        </div>

        <div class="form-row">

            <div class="form-group col-md-6">
                <label for="from_email">E-mail</label>
                <input type="email" class="form-control" id="from_email" name="from_email" value="<?php echo $list_view->Get_campaign_from_email(); ?>">
            </div>

            <div class="form-group  col-md-4">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" value="<?php echo $list_view->Get_campaign_subject(); ?>">
            </div>

            <div class="form-group  col-md-2">
                <label for="from_language">Language</label>
                <select class="form-control" id="from_language" name="from_language">
                    <option value="EN" <?php if($list_view->Get_campaign_subject()== 'EN') { echo 'selected="selected"'; } ?> >English</option>
                    <option value="FR" <?php if($list_view->Get_campaign_subject()== 'FR') { echo 'selected="selected"'; } ?>>French</option>
                    <option value="GR" <?php if($list_view->Get_campaign_subject()== 'GR') { echo 'selected="selected"'; } ?>>German</option>
                </select>
            </div>

        </div>

        <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
    </form>
</div>
</body>
</html>
