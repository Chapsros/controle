<?php
require_once '../function/db.php';

if (!empty($_POST) && !empty($_POST['email'])) {
    $email = $_POST['email'];

    $pdo = getPdo();

    $query = 'INSERT INTO newsletter (email) VALUES (:email)';
    $stmt = $pdo->prepare($query);
    $insert = $stmt->execute([
        'email' => $email
    ]);
    ?>
        <div class="alert alert-success mt-3" role="alert">
          Votre email a bien été enregistrée dans notre newsletter !
        </div>
<?php } ?>


<form method="POST" class="mt-5 mb-5">
<div class="text-center">Inscription a la Newsletter</div>
    <div class="form-group mt-3">
        <input type="text" class="form-control" id="email" name="email" placeholder="Email..." />
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </div>
</form>

</body>
</html>