<?php require APP_ROOT.'/views/inc/header.php';?>
   <div class="row mb-3 mt-4">
        
        <div class="col-md-4 mx-auto">
        <h2 class='mb-3 text-center'><marquee behavior=scroll direction="left" scrollamount="15" ><?php echo ucwords($_SESSION['user_name']); ?>'s Posts</marquee></h2>
            <a class='btn btn-primary btn-block' href="<?php echo URL_ROOT; ?>posts/add">
                <i class="fa fa-plus-circle"></i> Add Post
            </a>
        </div>
   </div>
   <div class="row">
       <div class="col-md-12 text-center"><?php echo flash('msg'); ?></div>
   </div>
   <?php foreach($data['posts'] as $post): ?>
        <div class="row">
            <div class="post-holder card card-body p-3 m-3">
                <h4><?php echo $post->post_title; ?></h4>
                <hr>
                <p class="bg-light"><?php echo $post->post_body; ?></p>
                <?php $timestamp = strtotime($post->post_created_at);?>
                <p> <?php echo '<b>Created At : </b>'."<span style='color:red;'>".date('h:i A'.", ".'d/M/y',$timestamp)."<span>"; ?></p>
                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col"><a href="<?php echo URL_ROOT; ?>posts/update/<?php echo $post->post_id; ?>" class="btn btn-block btn-warning"><i class='fa fa-pencil'></i> Edit Post</a></div>
                            <div class="col"><a href="<?php echo URL_ROOT; ?>posts/delete/<?php echo $post->post_id; ?>" class="btn btn-block btn-danger"><i class='fa fa-trash'></i> Delete Post</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   <?php endforeach ?>
<?php require APP_ROOT.'/views/inc/footer.php'; ?>
    
    