@echo off
schtasks /Create /TN XAMPP /TR "E:/Development/xampp8/php/php8.exe E:/Development/xampp8/htdocs/medians/live_branch/notifier.php" /SC MINUTE /MO 1
pause