@ECHO OFF
c:\xampp\mysql\bin\mysql.exe -u root -p < C:\xampp\htdocs\ndc\db\"ndc klien v5.sql"
start /WAIT c:\xampp\apache\bin\httpd.exe -k install
start /WAIT c:\xampp\mysql\bin\mysqld.exe --install
PAUSE