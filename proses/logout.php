<?php
session_start(); // Memulai session

// Hapus semua session data
session_unset();

// Hapus session ID
session_destroy();

// Redirect ke halaman index
header("Location: ../index.php");
exit;