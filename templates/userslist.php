<?=$this->layout('layout')?>

<?php
session_start();
use \Components\QueryBuilder;
use \Tamtamchik\SimpleFlash\Flash;

$db = new QueryBuilder;
$users = $db->getAll('users');
?>
    <?php
    if (Flash::hasMessages('success')) {
        echo Flash::display('success');
    }

    if (Flash::hasMessages('error')) {
        echo Flash::display('error');
    }
    ?>
    <br>
    <a href="/create" class="btn btn-success">Add new user</a>
    <hr>
    <table class="table">
        <thead class="table-dark">
            <th>#</th>
            <th>User name</th>
            <th>Email</th>
            <th></th>
            <th></th>
        </thead>
        <tbody>
        <?php foreach ($users as $user):?>
            <tr>
                <td><?php echo $user['id'];?></td>
                <td><?php echo $user['username'];?></td>
                <td><?php echo $user['email'];?></td>
                <td><a href="/edit?id=<?php echo $user['id'];?>"class="btn btn-warning">Edit</a></td>
                <td><a href="/delete?id=<?php echo $user['id'];?>"class="btn btn-danger" onclick="return confirm('Delete this user?');">Delete</a></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>