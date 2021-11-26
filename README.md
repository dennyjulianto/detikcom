# Detikcom
Detikcom Technical Test

## Sofware
1. Install [XAMPP](https://www.apachefriends.org/download.html)
2. Install [Postman](https://www.postman.com/downloads/)

## Rest API
1. Download the repository
2. Open XAMPP application
3. Enable Apache feature
4. Enable MySQL feature 
5. Put into folder C:/xampp/htdocs
6. Open Postman to see the result of Rest API

## PHP CLI
1. Open terminal or command prompt
2. Change the folder into C:/xampp/htdocs/detikcom
3. Run the script below to change into Interactive Shell
```bash
php -a
```
4. Run the script below to update payment transaction history
```bash
php transaction-cli.php <references_id> <status>

# example to update transaction status
php transaction-cli.php 78 Paid
```
5. Run the script below to make migration table
```bash
php migrate.php <filename>

# example to migrate file 'detik.sql'
php migrate.php db_detik.sql
```
