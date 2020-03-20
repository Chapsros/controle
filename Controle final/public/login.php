<?php
require_once '../function/db.php';
require_once '../function/utils.php';

$pdo = getPdo();
$login = "";
$error = false;

if (!empty($_POST['login']) && !empty($_POST['password'])) {
  session_start();
  $login = $_POST['login']; 
  $password = $_POST['password'];

  $query = "SELECT * FROM users WHERE login = :login";
  $stmt = $pdo->prepare($query);
  $stmt->execute([
    'login' => $login
  ]);

  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($row && password_verify($password, $row['password']) && $row['active'] == 1 && $row['roles'] == 0) {
    $_SESSION['state'] = 'user';
    $_SESSION['user_id'] = $row['id'];
    redirect('/Controle%20final/public');
  } 
  if ($row && password_verify($password, $row['password']) && $row['active'] == 1 && $row['roles'] == 1) {
    $_SESSION['state'] = 'admin';
    $_SESSION['user_id'] = $row['id'];
    redirect('/Controle%20final/public/admin');
  } 
  if ($row['active'] == 0) {
      echo "Votre compte est désactivé";
  } else {
    $error = true;
  }
}
require_once '../views/layout/header.php';
?>

<h1>Connexion</h1>
<h4>Identifiez-vous pour accéder à l'administration</h4>

<?php if ($error) { ?>
  <div class="alert alert-danger" role="alert">
    Les informations fournies n'ont pas permis de vous identifier
  </div>
<?php } ?>

<form method="POST">
  <div class="form-group">
    <label for="login">Login</label>
    <input type="text" class="form-control" id="login" name="login" placeholder="Login..." value="<?php echo $login; ?>" />
  </div>
  <div class="form-group">
    <label for="password">Mot de passe</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe..." />
  </div>
  <button type="submit" class="btn btn-primary">Connexion</button>
</form>

<?php require_once '../views/layout/footer.php'; ?>