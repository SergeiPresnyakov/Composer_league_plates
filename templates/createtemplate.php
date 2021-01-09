<?=$this->layout('layout')?>
<h1>Create new user</h1>

<form action="/create/newuser" method="post" class="form-control">
    <label for="username" class="col-form-label">User name</label>
    <input type="text" name="username" class="form-control" placeholder="User name" id="username">
    <label for="email" class="col-form-label">Email</label>
    <input type="text" name="email" class="form-control" placeholder="Email" id="email">
    <hr>
    <button type="submit" class="btn btn-success">Create</button>
</form>