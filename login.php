<?php
  session_start();
  require_once 'pdo.php';
  if(isset($_POST['cancel'])) header('Location: index.php');

  if (isset($_POST['login'])) {
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];
    if(empty($uname) || empty($pass)){
      $_SESSION['error'] = 'Username and Password is required';
    }else {
      $_SESSION['error'] = '';
      if(strlen($uname) <=4){
        $_SESSION['error'] .= 'Username must be atleast 4 character long<br>';
      }
      if(strlen($pass) <=3){
        $_SESSION['error'] .= 'Password must be 3 character long<br>';
      }
      // }else if(!preg_match('/[\w]+][]/i', $pass)){
      //   $_SESSION['error'] .= 'Custom password validation with regex<br>';
      // }

      if(empty($_SESSION['error'])){
        unset($_SESSION['error']);

        $uname_md5 = hash('md5', $uname);

        $sql = 'SELECT * FROM users WHERE username=:un';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
          ':un' => $uname_md5
        ]);
        $db_data = $stmt->fetch(PDO::FETCH_ASSOC);
        $db_pass = $db_data['password'];
        $db_user_name = $db_data['fullname'];
        
        if(password_verify($pass, $db_pass)){
          $_SESSION['success'] = 'Login Success: Welcome '.$db_user_name;
          $_SESSION['user'] = true;
          header('Location: index.php');
          return;
        }
        
      }
      
    }
    header('Location: signup.php');
    return;
  }
?>

<?php include 'templates/header.php'; ?>
<?php include 'templates/navbar.php'; ?>

<div class="row justify-content-center">
  <div class="rounded border border-info p-4 mt-3 col-12 col-sm-6 col-md-4">
    <h3 class="mt-3">Login</h3>
    <hr>
    <!-- SUCCESS MESSAGE -->
    <?php if(isset($_SESSION['success'])) : ?>
      <div class="alert alert-success">
        <small><?= htmlentities($_SESSION['success']); ?></small>
        <?php unset($_SESSION['success']) ?>
      </div>
    <?php endif; ?>
    <!-- ERROR MESSAGE -->
    <?php if(isset($_SESSION['error'])): ?>
      <div class="alert alert-danger">
        <small><?= htmlentities($_SESSION['error']); ?></small>
        <?php unset($_SESSION['error']) ?>
      </div>
    <?php endif; ?>
    <form method="POST" novalidate>
      <div class="form-group">
        <input class="form-control form-control-sm" type="text" name="uname" placeholder="Username" required>
      </div>
      <div class="form-group">
        <input class="form-control form-control-sm" type="password" name="pass" placeholder="Password" required>
      </div>
      <button class="btn btn-primary bt-sm" type="submit" name="login">Log In</button>
      <button class="btn btn-secondary bt-sm" type="submit" name="cancel">Cancel</button>
    </form>
    <hr>
    <small>Don't have an account? <a href="signup.php">Sign Up</a></small>
  </div>


</div>
<?php include 'templates/footer.php' ?>