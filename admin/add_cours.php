<?php
// Connexion à la base
$db = new PDO("mysql:host=localhost;dbname=project;charset=utf8", "root", "");

// Vérifier les champs
if (isset($_POST['titre'], $_POST['description'], $_POST['niveau']) 
    && isset($_FILES['image']) && isset($_FILES['fichier_pdf'])) {

    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $niveau = $_POST['niveau'];

    // Upload de l'image
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_path = "uploads/images/" . basename($image_name);
    move_uploaded_file($image_tmp, $image_path);

    // Upload du PDF
    $pdf_name = $_FILES['fichier_pdf']['name'];
    $pdf_tmp = $_FILES['fichier_pdf']['tmp_name'];
    $pdf_path = "uploads/pdfs/" . basename($pdf_name);
    move_uploaded_file($pdf_tmp, $pdf_path);

    // Insertion en base
    $stmt = $db->prepare("INSERT INTO cours (titre, description, niveau, image, fichier_pdf) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$titre, $description, $niveau, $image_path, $pdf_path]);

    // Redirection
    header("Location: gestion_cours.php");
    exit();
} else {
    echo "Erreur : tous les champs sont requis.";
}
?>
