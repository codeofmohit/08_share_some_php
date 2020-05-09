<?php 
    if(!isset($_SESSION)){
        redirect('users/login');
    }
?>
<?php require APP_ROOT.'/views/inc/header.php'; ?>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <a href="<?php echo URL_ROOT; ?>posts" class="btn btn-light"><i class="fa fa-backward"> Go back</i></a>
            <div class="card card-body bg-light mt-5">
                <h2 class="mb-4">Update post</h2>
                <form action="<?php echo URL_ROOT ?>posts/update/<?php echo $data['post_id']; ?>" method="POST">
                     <div class="form-group">
                        <label for="title">Title <sup>*</sup></label>
                        <input maxlength="50" autocomplete="off" type="text" name='updated_title' placeholder="Update post title (max : 50 char)" value="<?php echo $data['title']; ?>" class='form-control <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>'>
                        <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
                    </div> 
                    <div class="form-group">
                        <label for="body">Body <sup>*</sup></label>
                        <textarea maxlength="250" style="resize: none;" rows="5" autocomplete="off" type="text" name='updated_body' placeholder="Update post here (max : 250 chars)..." class='form-control <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>'><?php echo $data['body']; ?></textarea>
                        <span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
                    </div> 
                    <button type='submit' name='post_update_submit' class="btn btn-warning">Update post</button>
                </form>
            </div>
        </div>
    </div>
<?php require APP_ROOT.'/views/inc/footer.php'; ?>
    
    