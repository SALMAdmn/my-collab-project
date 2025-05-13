<?php
$db = new PDO("mysql:host=localhost;dbname=project;charset=utf8", "root", "");
$sql = "SELECT * FROM cours";
$stmt = $db->query($sql);
$cours = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Gestion des cours</title>
  <style>
    body { font-family: Arial; background: #f5f5f5; padding: 20px; }
    h1 { color: #007bff; }
    form { background: #fff; padding: 20px; margin-bottom: 20px; border-radius: 5px; }
    input, select { margin: 5px; padding: 8px; }
    table { width: 100%; border-collapse: collapse; background: #fff; }
    th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
    th { background: #007bff; color: white; }
    img { width: 100px; }
    button { padding: 8px 12px; background: #007bff; color: white; border: none; }
    a { color: red; }
  </style>
</head>
<body>

<h1>Gestion des cours</h1>

<!-- Formulaire d'ajout -->
<form action="add_cours.php" method="POST" enctype="multipart/form-data">
  <input type="text" name="titre" placeholder="Titre" required>
  <input type="text" name="description" placeholder="Description" required>
  <select name="niveau" required>
    <option value="">-- Niveau --</option>
    <option value="INITIATION">INITIATION</option>
    <option value="INTERMÉDIAIRE">INTERMÉDIAIRE</option>
    <option value="AVANCÉ">AVANCÉ</option>
  </select><br>
  <label>Image : </label><input type="file" name="image" accept="image/*" required>
  <label>PDF : </label><input type="file" name="fichier_pdf" accept="application/pdf" required>
  <button type="submit">Ajouter</button>
</form>

<!-- Liste des cours -->
<table>
  <tr>
    <th>ID</th>
    <th>Titre</th>
    <th>Description</th>
    <th>Niveau</th>
    <th>Image</th>
    <th>PDF</th>
    <th>Actions</th>
  </tr>
  <?php foreach ($cours as $c): ?>
  <tr>
    <td><?= htmlspecialchars($c['id']) ?></td>
    <td><?= htmlspecialchars($c['titre']) ?></td>
    <td><?= htmlspecialchars($c['description']) ?></td>
    <td><?= htmlspecialchars($c['niveau']) ?></td>
    <td><img src="<?= htmlspecialchars($c['image']) ?>" alt="image"></td>
    <td><a href="<?= htmlspecialchars($c['fichier_pdf']) ?>" download>Télécharger</a></td>
    <td>
      <a href="del_cours.php?id=<?= $c['id'] ?>">Supprimer</a> 
      <a href="modifier.php?id=<?= $c['id'] ?>">Modifier</a>
    </td>
  </tr>
  <?php endforeach; ?>
</table>

</body>
</html>
