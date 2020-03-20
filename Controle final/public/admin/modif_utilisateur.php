<?php
require_once '../../function/db.php';
require_once '../../function/function.php';

if (!isset($_GET['id'])) { ?>
    <div class="alert alert-danger" role="alert">
      Paramètre manquant : id
    </div>
    <?php
    exit;
  }

  $id = $_GET['id'];

if (!empty($_POST) && !empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['confirm_password']) && !empty($_POST['email'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_POST['email'];
    $roles = isset($_POST['roles']) ? 1 : 0;

    if($password === $confirm_password) {
        $update = updateUser(
            $id,
            $login,
            $password,
            $confirm_password,
            $email,
            $roles
            );
            ?>
    <div class="alert alert-success" role="alert">
        L'utilisateur a bien été modifiée ! <a href="/Controle%20final/public/admin/index.php">Retour à la page d'administration</a>
    </div>
    <?php };
};
require_once '../../views/layout/header.php'; 

$user = getUser($id);

if ($user == null) {?>
  <div class="alert alert-danger" role="alert">
    L'utilisateur demandée n'existe pas
  </div>
  <?php
  exit;
}
?>


<form method="POST" class="mt-5 mb-5">
  <div class="form-group">
    <label for="login">login</label>
    <input type="text" class="form-control" id="login" name="login" placeholder="Login..." value="<?php echo $user['nom']; ?>"/>
  </div>
  <div class="form-group">
    <label for="password">password</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Password..."/>
  </div>
  <div class="form-group">
    <label for="confirm_password">confirm password</label>
    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm password..."/>
  </div>
  <div class="form-group">
    <label for="email">email</label>
    <input type="text" class="form-control" id="email" name="email" placeholder="Email..." value="<?php echo $user['email']; ?>"/>
  </div>
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="roles" name="roles" placeholder="Roles..." <?php if ($user['roles'] == 1) { ?>checked<?php } ?>/>
    <label class="form-check-label" for="roles">Admin</label>
  </div>
  <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>