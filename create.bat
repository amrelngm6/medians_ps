@echo off
schtasks /Create /TN XAMPP /TR "E:/Development/xampp8/php/php8.exe E:/Development/x/htdocs/live_branch/notifier.php" /SC MINUTE /MO 1
pause