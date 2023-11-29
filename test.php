<label for="login-password" class="form-label">Password</label>
<div class="input-group">
    <input type="password" name="password" class="form-control" id="login-password">
    <div class="input-group-append">
        <span class="input-group-text" id="show-password">
            <i class="fa fa-eye-slash" id="eye-icon"></i>
        </span>
    </div>
</div>
<p>
    <a href="<?= $mainlink ?>core/sessions.php?f_role=<?= $_SESSION['role']; ?>">Forgot
        Password?</a>
</p>