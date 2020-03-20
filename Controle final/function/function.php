<?php
require_once __DIR__ . '/db.php';

function getUsers(): array
{
  $pdo = getPdo();
  $query = "SELECT * FROM users";
  $stmt = $pdo->query($query);
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getNewsletter(): array
{
  $pdo = getPdo();
  $query = "SELECT * FROM newsletter";
  $stmt = $pdo->query($query);
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function updateUser(int $id, string $login, string $password, string $confirm_password, string $email, int $roles = 0): bool
{
  // Récupération d'une instance de PDO
  $pdo = getPdo();

  // Définition, préparation et exécution de la requête
  $query = "UPDATE users SET login = :login, password = :password, confirm_password = :confirm_password, email = :email, roles = :roles WHERE id = :id";
  $stmt = $pdo->prepare($query);
  return $stmt->execute(array(':login' => $login, ':password' => $password, ':confirm_password' => $confirm_password, ':email' => $email, ':roles' => $roles, ':id' => $id));
}

function getUser(int $id): ?array
{
  $pdo = getPdo();
  $query = "SELECT * FROM users WHERE id = :id";
  $stmt = $pdo->prepare($query);
  $stmt->execute([
    'id' => $id
  ]);

  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if (!$row) {
    return null;
  }

  return $row;
}