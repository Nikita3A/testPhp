<?php
$pdo = new PDO('mysql:host=localhost;port=3307;dbname=birthdays', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);