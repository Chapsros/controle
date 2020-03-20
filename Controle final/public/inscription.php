<?php
require_once '../function/db.php';

if (!empty($_POST) && !empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['confirm_password']) && !empty($_POST['email'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_POST['email'];

    if($password === $confirm_password) {
        $pdo = getPdo();

        $query = 'INSERT INTO users (login, email, password) VALUES (:login, :email, :pass)';
        $stmt = $pdo->prepare($query);
    
        $insert = $stmt->execute([
            'login' => $login,
            'email' => $email,
            'pass' => password_hash("$password", PASSWORD_BCRYPT, ['cost' => 12])
        ]);
    } else { ?>
        <div class="alert alert-danger" role="alert">
          Une erreur est survenue
        </div>
      <?php }
}
require_once '../views/layout/header.php'; ?>


<form method="POST" class="mt-5 mb-5">
  <div class="form-group">
    <label for="login">login</label>
    <input type="text" class="form-control" id="login" name="login" placeholder="Login..." />
  </div>
  <div class="form-group">
    <label for="password">password</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Password..." />
  </div>
  <div class="form-group">
    <label for="confirm_password">confirm password</label>
    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm password..." />
  </div>
  <div class="form-group">
    <label for="email">email</label>
    <input type="text" class="form-control" id="email" name="email" placeholder="Email..." />
  </div>
  <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>

<?php require_once '../views/layout/footer.php'; ?>