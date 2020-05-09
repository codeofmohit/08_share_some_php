<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
  <div class="container">
      <a class="navbar-brand" href="<?php echo URL_ROOT; ?>"><?php echo SITE_NAME; ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URL_ROOT; ?>">Post Feed <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URL_ROOT.'pages/about'; ?>">About</a>
          </li>
          <?php if(isset($_SESSION['user_id'])): //if logged in then only showing logout?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URL_ROOT.'posts'; ?>">Posts</a>
          </li>
          <?php endif ?>
        </ul>
        <ul class="navbar-nav ml-auto">
          <?php if(isset($_SESSION['user_id'])): //if logged in then only showing logout?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URL_ROOT.'users/logout'; ?>">Logout (<?php echo ucwords($_SESSION['user_name']); ?>)</a>
          </li>
          <?php else: ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URL_ROOT.'users/login'; ?>">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URL_ROOT.'users/register'; ?>">Register</a>
          </li>
          <?php endif ?>
        </ul> 
      </div>
  </div>      
</nav>