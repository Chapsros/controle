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

$users = getUsers();
?>


<table class="table table-striped mt-4">
  <thead>
    <tr>
      <th></th>
      <th scope="col">ID</th>
      <th scope="col">Login</th>
      <th scope="col">Email</th>
      <th scope="col">Admin</th>
      <th scope="col">Active</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $user) { ?>
      <tr>
        <td><a href="/Controle%20final/public/admin/modif_utilisateur.php?id=<?php echo $user['id']; ?>" class="btn btn-warning">Editer</a></td>
        <td><?php echo $user['id']; ?></td>
        <td><?php echo $user['login']; ?></td>
        <td><?php echo $user['email']; ?></td>
        <td><?php echo $user['roles']; ?></td>
        <td><?php echo $user['active']; ?></td>
      </tr>
    <?php } ?>
  </tbody>
</table>