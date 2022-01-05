<form method="post">
    <?php if(!empty($error)) {
        foreach($error as $e) {
            ?><div><?=$e?></div><?php
        }
    } ?>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?=$req->post("email", "")?>">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword2" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword2" name="password_repeat">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>