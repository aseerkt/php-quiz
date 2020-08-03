<?php include 'templates/header.php'; ?>
<?php include 'templates/navbar.php'; ?>

<div class="container">
  <h1>Add Quiz</h1>
  <hr>
  <form method="POST">
    <div class="form-group">
      <label class="form-label form-label-sm" for="title">Quiz Title</label>
      <input class="form-control form-control-sm"  type="text" name="title" id="title" />
    </div>
    <div class="form-group">
      <label class="form-label form-label-sm" for="topic">Quiz Topic</label>
      <input class="form-control form-control-sm" type="text" name="topic" id="topic" />
    </div>
    <button class="btn btn-primary" type="submit" name="confirm">Confirm</button>
    <button class="btn btn-warning" type="submit" name="addq">Add Question +</button>
  </form>
</div>

<?php include 'templates/footer.php'; ?>