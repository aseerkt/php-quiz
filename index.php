<!-- MODAL -->

<?php
   session_start();
   require_once 'pdo.php';
   if(isset($_SESSION['logged'])){
      $logged_in = $_SESSION['logged'];
   }

   //Fetch quizzes
   $sql = 'SELECT * FROM quiz';
   $stmt = $pdo->prepare($sql);
   $stmt->execute();
   $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


<?php include 'templates/header.php'; ?>
<?php include 'templates/navbar.php'; ?>
   
   <div class="container">
      <h3>Home</h3>
      <hr>
      <?php if(isset($_SESSION['success'])): ?>
         <div class="alert alert-success">
            <?= htmlentities($_SESSION['success']) ?>
            <?php unset($_SESSION['success']) ?>
         </div>
      <?php endif; ?>
      <?php if(!empty($rows)):?>
         <div class="d-flex row">
            <div class="card w-25">
               <?php foreach($rows as $row): ?>
                  <div class="card-body">
                  <h5 class="card-title"><?= $row['title'] ?? '' ?></h5>
                  <h6 class="card-subtitle"><?= $row['topic'] ?? '' ?></h6>
                  <p class="card-text">
                     user | date
                  </p>
                  </div>
               <?php endforeach; ?>
            </div>
         </div>
      <?php endif; ?>
      <div class="text-center bg-light mt-3 p-3 ">
         <a class="btn btn-sm btn-warning" href="add-quiz.php">Add Quiz</a><br />
         <small class="text-muted">You must be logged in to add quiz</small>
      </div>
   </div>

<?php include 'templates/footer.php'; ?>