<?php
  
?>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
   <a class="navbar-brand" href="#">Quiz-Maker</a>
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
   </button>
   
   <div class="collapse navbar-collapse" id="navbarsExample04">
     <ul class="navbar-nav ml-auto">
       <li class="nav-item active">
         <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
       </li>
       <li class="nav-item">
         <a class="nav-link" href="about.php">About</a>
       </li>
       <?php if(isset($_SESSION['user'])): ?>
        <li class="nav-item">
          <a class="nav-link" href="profile.php">Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
       <?php else: ?>
        <li class="nav-item">
          <a class="nav-link" href="signup.php">SignUp</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php">LogIn</a>
        </li>
       <?php endif; ?>

     </ul>
     <!-- <form class="form-inline my-2 my-md-0">
       <input class="form-control" type="text" placeholder="Search">
     </form> -->
   </div>
</nav>

    