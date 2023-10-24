<?php

use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{
    public function testDatabaseConnection()
    {
        try {
            $bdd = new PDO('mysql:host=mysql-usermanagement.alwaysdata.net;dbname=usermanagement_bdd','325371','anouk2023');
            $this->assertInstanceOf(PDO::class, $bdd);
        } catch (PDOException $e) {
            $this->fail('Database connection failed: ' . $e->getMessage());
        }
    }
   
}
