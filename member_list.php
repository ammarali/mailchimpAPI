<?php
/**
 * Created by PhpStorm.
 * User: ammar
 * Date: 11/1/2018
 * Time: 6:36 PM
 */
    require_once 'database/database.php' ;
    require_once 'src/members.php' ;

    if(isset($_GET['list_id'])) {
        $member_view = new members(API_KEY, USERNAME, $_GET['list_id']);

        $members = $member_view->getMembers();
    }
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
        <a href="index.php" class="btn btn-primary">Back</a>
        <a href="insert_member_form.php" class="btn btn-primary">Create New Member</a>

        <br><br>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th colspan="4"> Mail Chimp Member List </th>
                </tr>
            </thead>
            <thead>
            <tr>
                <th scope="col">ID.</th>
                <th scope="col">Email</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
            </thead>


            <tbody>
            <?php foreach($members as $member) { ?>
            <tr>
                <th scope="row"><?php echo $member['id']; ?></th>
                <td><?php echo $member['email_address']; ?></td>
                <td><?php echo $member['status']; ?></td>
                <td>
                    <a href="update_list_form.php?action=UPDATE&list_id=<?php echo $member['id']; ?>" class="btn btn-success">Update</a>
                    <a href="update_list_form.php?action=DELETE&list_id=<?php echo $member['id']; ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            <?php }  ?>
            </tbody>
        </table>
    </div>
</body>
</html>