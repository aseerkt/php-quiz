<?php
  session_start();
  session_destroy();
  session_start();
  $_SESSION['success'] = 'Logged out';
  header('Location: index.php');
