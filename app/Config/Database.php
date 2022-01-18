<?php 

namespace Todolist\PHP\Native\Config;

class Database 
{
  private static ?\PDO $pdo = null;

  public static function getConnection(): \PDO
  {
      self::$pdo = new \PDO("mysql:host=localhost:3306;dbname=todolist", "root", "katasandi1");
      return self::$pdo;
  }

  public static function beginTransaction()
  {
      self::$pdo->beginTransaction();
  }

  public static function commitTransaction()
  {
      self::$pdo->commit();
  }

  public static function rollBackTransaction()
  {
      self::$pdo->rollBack();
  }

}
