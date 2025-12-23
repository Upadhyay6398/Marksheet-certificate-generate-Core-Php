<?php
include("config.php");
include("lock.php");
include("include/GoogleAuthenticator.php");

$ga = new PHPGangsta_GoogleAuthenticator();
$secret = $ga->createSecret();

$username = "webmaster@gmail.com";

// PDO prepared statement version
$sql = "UPDATE login SET google_secret = :secret WHERE email = :email";
$stmt = $DB->DB->prepare($sql);

if (!$stmt) {
    die("Prepare failed.");
}

// Bind using PDO syntax
$stmt->bindParam(':secret', $secret, PDO::PARAM_STR);
$stmt->bindParam(':email', $username, PDO::PARAM_STR);

if (!$stmt->execute()) {
    die("Execute failed.");
}
echo "Secret Generated: <b>$secret</b><br>";
echo "Secret updated successfully.<br>";
echo "<img src='" . htmlspecialchars($ga->getQRCodeGoogleUrl("Sahyogcare4U Admin Panel", $secret)) . "' alt='QR Code'>";
?>



