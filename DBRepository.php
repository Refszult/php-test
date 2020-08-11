<?php


class DBRepository implements RepositoryInterface
{
    private PDO $pdo;

    public function __construct(array $dbSettings)
    {
        $this->pdo = new PDO("mysql:host={$dbSettings['HOST']};dbname={$dbSettings['DB_NAME']}", $dbSettings['USERNAME'], $dbSettings['PASSWORD']);
    }

    public function createOrUpdate(array $data)
    {
        $keys = [];
        $values = [];

        foreach ($data as $key => $value) {
            array_push($keys, $key);
            array_push($values, "'" . $value . "'");
        }

        $stmt = $this->pdo->prepare("INSERT INTO visits (" . implode(',', $keys) . ")
         VALUES (" . implode(',', $values) . ") ON DUPLICATE KEY UPDATE views_count=views_count+1");
        $stmt->execute();

        return $stmt->fetch();
    }
}
