<?php
session_start(); // Memulai session

// Hapus semua data session
session_unset();

// Hapus session ID
session_destroy();

// Redirect ke halaman login atau index
header("Location: ../index.php");
exit;
