<?php require APP_ROOT.'/views/inc/header.php'; ?>
    <div class="jumbotron jumbotron-fluid">
        <div class="container text-center">
            <h1 class="display-3"><?php echo $data['title']; ?></h1>
            <p class="lead"><?php echo $data['desc']; ?></p>
        </div>
    </div>
   <!-- Follwing we will display all the posts -->
   <div class="row">
       <div class="col-md-12 text-center">
           <h2><marquee behavior=scroll direction="left" scrollamount="25" >Posts Feed</marquee></h2>
           <?php if(!isset($_SESSION['user_id'])): ?>
                <div class="alert alert-dark">
                    Follwing are the <b>Common Posts</b>, Kindly <b>Login!</b> to add/update/delete your individual posts ...
                </div>
           <?php endif ?>
        </div>
   </div>
   <?php foreach($data['posts'] as $post): ?>
        <div class="row">
            <div class="post-holder card card-body p-3 m-3">
                <h4><?php echo $post->title; ?></h4>
                <hr>
                <p class="bg-light"><?php echo $post->body; ?></p>
                <?php $timestamp = strtotime($post->created_at);?>
                <p> <?php echo '<b>Created By : '."<span style='color:red;'> ".ucwords($post->name)." <span>".' </b>'.' | '.'<b>Created At : '." <span style='color:red;'> ".date('h:i A'.", ".'d/M/y',$timestamp)." <span></b>"; ?></p>
            </div>
        </div>
   <?php endforeach ?>
<?php require APP_ROOT.'/views/inc/footer.php'; ?>