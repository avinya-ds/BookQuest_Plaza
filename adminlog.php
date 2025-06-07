<?php
session_start();
if ($_SESSION['email'] !== 'ad@gmail.com') {
    header("location: login.php");
    exit();
}
echo ("<script language='javascript'>
window.alert('Admin Log In is successful')
window.location.href='admin.php'
</script>");
exit();
?>
