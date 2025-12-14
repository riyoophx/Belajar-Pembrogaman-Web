<?php
$password_plain = "admin123"; // Password yang ingin Anda gunakan
$password_hash = password_hash($password_plain, PASSWORD_DEFAULT);
echo $password_hash;
?>