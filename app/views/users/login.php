<?php require APP_ROOT.'/views/inc/header.php'; ?>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-5">
                <?php flash('msg'); ?>
                <h2>Login</h2>
                <p>Fill in the credentials to Login!</p>
                <form action="<?php echo URL_ROOT; ?>users/login" method="POST">
                     <div class="form-group">
                        <label for="email">Email <sup>*</sup></label>
                        <input autocomplete="off" type="email" name='email' placeholder="Enter your email" value="<?php echo $data['email']; ?>" class='form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>'>
                        <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                    </div> 
                    <div class="form-group">
                        <label for="password">Password <sup>*</sup></label>
                        <input autocomplete="off" type="password" name='password' placeholder="Enter your password" value="<?php echo $data['password']; ?>" class='form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>'>
                        <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                    </div> 
                    
                    <div class="row">
                        <div class="col">
                            <input type="submit" class="btn btn-success btn-block" type='submit' name='submit' value='Login'>
                        </div>
                        <div class="col">
                            <a href="<?php echo URL_ROOT; ?>users/register" class="btn btn-block bg-light">Don't have an account? Register</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php require APP_ROOT.'/views/inc/footer.php'; ?>
    
    