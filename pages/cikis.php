<?php
require_once __DIR__ . '/../auth.php'; 
logoutUser(); 
// Yönlendirme: Çıkış yapıldıktan sonra kullanıcıyı hemen açılış (welcome) sayfasına yönlendiriyorum.
header('Location: index.php?sayfa=welcome');
exit;
?>