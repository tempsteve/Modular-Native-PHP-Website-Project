@echo off
for /f "tokens=2 delims==" %%a in ('wmic OS Get localdatetime /value') do set "dt=%%a"
set "YY=%dt:~2,2%" & set "YYYY=%dt:~0,4%" & set "MM=%dt:~4,2%" & set "DD=%dt:~6,2%"
set "HH=%dt:~8,2%" & set "Min=%dt:~10,2%" & set "Sec=%dt:~12,2%"

set "fullstamp=%YYYY%%MM%%DD%%HH%%Min%%Sec%"

cd c:\xampp\htdocs\composition\manage\backup
set path=c:\xampp\mysql\bin
mysqldump -u root -pp@ssw0rd composition > %fullstamp%.sql