<?php


class Repository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO("mysql:host=localhost;dbname=test", 'root', '');
    }

    /**
     * @param array $condition
     * @return bool
     */

    public function exist(array $condition)
    {
        $stmt = $this->pdo->prepare("SELECT id FROM visits {$this->where($condition)}");
        $stmt->execute();
        $res = $stmt->fetch();
        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param array $condition
     * @return bool
     */
    public function updateCount(array $condition)
    {
        $stmt = $this->pdo->prepare("UPDATE visits SET views_count = views_count + 1 {$this->where($condition)}");
        $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * @param array $data
     * @return bool
     */
    public function create(array $data)
    {
        $keys = [];
        $values = [];

        foreach ($data as $key => $value) {
            array_push($keys, $key);
            array_push($values, "'" . $value . "'");
        }

        $stmt = $this->pdo->prepare("INSERT INTO visits (" . implode(',', $keys) . ") VALUES (" . implode(',', $values) . ")");
        $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * @param array $dataWhere
     * @return string
     */
    private function where(array $dataWhere)
    {
        $i = 1;
        $where = '';

        foreach ($dataWhere as $key => $value) {
            if ($i == 1) {
                $where = "WHERE $key='$value' ";
                $i++;
            } else {
                $where .= "AND $key='$value' ";
            }
        }

        return $where;
    }
}
