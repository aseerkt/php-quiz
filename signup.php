<?php
  session_start();
  require_once 'pdo.php';

  if(isset($_POST['cancel'])) header('Location: index.php');

  if (isset($_POST['signup'])) {
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];
    if(empty($fname) || empty($uname) || empty($pass) || empty($email)){
      $_SESSION['error'] = 'Fields should not be empty';
    }else {
      $_SESSION['error'] = '';
      if(strlen($fname) <=3 ){
        $_SESSION['error'] .= 'Fullname must be atleast 3 character long<br>';
      }
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $_SESSION['error'] = 'Bad Email Address<br>';
      }
      if(strlen($uname) <=4){
        $_SESSION['error'] .= 'Username must be atleast 4 character long<br>';
      }
      if(strlen($pass) <=3){
        $_SESSION['error'] .= 'Password must be atleast 3 character long<br>';
      }
      // }else if(!preg_match('/[\w]+][]/i', $pass)){
      //   $_SESSION['error'] .= 'Custom password validation with regex<br>';
      // }

      if(empty($_SESSION['error'])){
        unset($_SESSION['error']);

        $uname_md5 = hash('md5', $uname);
        $pass_crypt = password_hash($pass,PASSWORD_BCRYPT);

        $sql = 'INSERT INTO users (fullname, email, username, password) VALUES (:fn, :em, :un, :pw)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
          ':fn' => $fname,
          ':em' => $email,
          ':un' => $uname_md5,
          ':pw' => $pass_crypt
        ]);
        $_SESSION['success'] = 'User successfully registered, Please <a href="#">Log in</a> to continue';
        header('Location: login.php');
        return;
      }
      
    }
    header('Location: signup.php');
    return;
  }
?>

<?php include 'templates/header.php'; ?>
<?php include 'templates/navbar.php'; ?>

<div class="row justify-content-center">
  <div class="rounded border border-info mt-3 p-4 col-12 col-sm-6 col-md-4">
    <h3 class="mt-3">Sign Up</h3>
    <hr>
    <?php if(isset($_SESSION['error'])): ?>
      <div class="alert alert-danger">
        <small><?= htmlentities($_SESSION['error']); ?></small>
        <?php unset($_SESSION['error']) ?>
      </div>
    <?php endif; ?>
    <form method="POST" novalidate>
      <div class="form-group">
        <input class="form-control form-control-sm" type="text" name="fname" placeholder="Full Name" required>
      </div>
      <div class="form-group">
        <input class="form-control form-control-sm" type="email" name="email" placeholder="Email" required>
      </div>
      <div class="form-group">
        <input class="form-control form-control-sm" type="text" name="uname" placeholder="Username" required>
      </div>
      <div class="form-group">
        <input class="form-control form-control-sm" type="password" name="pass" placeholder="Password" required>
      </div>
      <button class="btn btn-primary bt-sm" type="submit" name="signup">Sign Up</button>
      <button class="btn btn-secondary bt-sm" type="submit" name="cancel">Cancel</button>
    </form>
    <hr>
    <small>Already have an account? <a href="login.php">Log In</a></small>
  </div>

</div>


<?php include 'templates/footer.php' ?>