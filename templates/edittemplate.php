<?=$this->layout('layout')?>

<h1>Edit user - <?php echo $user['username'];?></h1>

<form action="/edit/user" method="post" class="form-control">
    <label for="username" class="col-form-label">User name</label>
    <input type="text" name="username" class="form-control" value="<?php echo $user['username'];?>" id="username">
    <label for="email" class="col-form-label">Email</label>
    <input type="text" name="email" class="form-control" value="<?php echo $user['email'];?>" id="email">
    <input type="hidden" name="id" value="<?php echo $user['id'];?>">
    <hr>
    <button type="submit" class="btn btn-warning">Edit</button>
</form>