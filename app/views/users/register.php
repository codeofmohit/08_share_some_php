<?php require APP_ROOT.'/views/inc/header.php'; ?>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-3">
                <h2>Create an account</h2>
                <p>Fill in the credentials to register with us!</p>
                <form action="<?php echo URL_ROOT; ?>/users/register" method="POST">
                    <div class="form-group">
                        <label for="name">Name <sup>*</sup></label>
                        <input maxlength="20" type="text" name='name' placeholder="Enter your name" value="<?php echo $data['name']; ?>" class='form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>' autocomplete="off">
                        <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                    </div> 
                    <div class="form-group">
                        <label for="email">Email <sup>*</sup></label>
                        <input type="email" name='email' placeholder="Enter your email" value="<?php echo $data['email']; ?>" class='form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>' autocomplete="off">
                        <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                    </div> 
                    <div class="form-group">
                        <label for="password">Password <sup>*</sup></label>
                        <input autocomplete="off" type="password" name='password' placeholder="Enter your password" value="<?php echo $data['password']; ?>" class='form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>'>
                        <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                    </div> 
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password <sup>*</sup></label>
                        <input autocomplete="off" type="password" name='confirm_password' placeholder="Enter your password again" value="<?php echo $data['confirm_password']; ?>" class='form-control form-control-lg <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>'>
                        <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="submit" class="btn btn-success btn-block" type='submit' name='submit' value='Register'>
                        </div>
                        <div class="col">
                            <a href="<?php echo URL_ROOT; ?>/users/login" class="btn btn-block bg-light">Have an account? Login</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php require APP_ROOT.'/views/inc/footer.php'; ?>
    
    