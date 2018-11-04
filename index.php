<?php
/**
 * Created by PhpStorm.
 * User: ammar
 * Date: 11/1/2018
 * Time: 6:36 PM
 */
    require_once 'database/database.php' ;
    require_once 'src/lists.php' ;

    $list_object = new lists(API_KEY, USERNAME);

    $mailchimp_lists = $list_object->ShowAllLists();

?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Mail Chimp App</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
    <script type="text/css" src="bootstrap/js/bootstrap.js"></script>
</head>
<body>
<?php
    if(isset($_GET['successful']) && $_GET['successful'] == TRUE) {
       echo '<div class="alert alert-success">Operation is Performed successfully!</div>';
    }
?>
<div class="container">
        <h1> Welcome to Mail Chimp API Application</h1>
        <br>
        <br>

        <a href="insert_list_form.php" class="btn btn-primary">Create New List</a>

        <br><br>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th colspan="5"> Mail Chimp Lists </th>
                </tr>
            </thead>
            <thead>
            <tr>
                <th scope="col">ID.</th>
                <th scope="col">Web ID.</th>
                <th scope="col">Name</th>
                <th scope="col">Company Name</th>
                <th scope="col">Action</th>
            </tr>
            </thead>


            <tbody>
            <?php foreach($mailchimp_lists as $mailchimp_list) { ?>
            <tr>
                <th scope="row"><?php echo $mailchimp_list['list_id']; ?></th>
                <td><?php echo $mailchimp_list['list_web_id']; ?></td>
                <td><?php echo $mailchimp_list['name']; ?></td>
                <td><?php echo $mailchimp_list['company_name']; ?></td>
                <td><a href="member_list.php?list_id=<?php echo $mailchimp_list['list_id']; ?>" class="btn btn-info">Members</a>
                    <a href="update_list_form.php?action=UPDATE&list_id=<?php echo $mailchimp_list['list_id']; ?>" class="btn btn-success">Update</a>
                    <a href="update_list_form.php?action=DELETE&list_id=<?php echo $mailchimp_list['list_id']; ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            <?php }  ?>
            </tbody>
        </table>
    </div>
</body>
</html>