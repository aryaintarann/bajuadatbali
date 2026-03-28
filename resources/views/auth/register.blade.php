<?php
// Fitur pendaftaran dinonaktifkan. Redirect ke halaman login.
header('Location: ' . url('/login'));
exit;
?>