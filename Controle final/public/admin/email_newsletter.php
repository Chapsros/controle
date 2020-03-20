<?php
require_once '../../function/utils.php';
session_start();
if(isset($_SESSION['state']) && $_SESSION["state"] == "admin") {
  echo "Vous êtes connecté";
} else {
  redirect('/Controle%20final/public/login.php');
}

require_once '../../function/function.php';
require_once '../../views/layout/header.php';

$Newsletters = getNewsletter();
?>


<table class="table table-striped mt-4">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Email</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($Newsletters as $Newsletter) { ?>
      <tr>
        <td><?php echo $Newsletter['id']; ?></td>
        <td><?php echo $Newsletter['email']; ?></td>
      </tr>
    <?php } ?>
  </tbody>
</table>