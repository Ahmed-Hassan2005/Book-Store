<?php

require_once __DIR__ . '/../Model.php';

class UserModel extends Model {
    public function getUsers(): array {
        return $this->DB->query("SELECT * FROM customers")->fetchAll();
    }//getUsers()

    public static function createUser(){
        $DB = Database::connect();

        $data = Request::all();

        $password = password_hash($data['password'], PASSWORD_DEFAULT);

        $DB->exec(
            "INSERT INTO users
            (role, name, email, password, phone, gender)
            VALUES
            ('{$data['role']}', '{$data['name']}', '{$data['email']}', '{$password}', '{$data['phone']}', '{$data['gender']}')
            "
        );
    }//createUser()

    public static function getTotal(string $tableName, array $wheres = []): int{
        $query = "SELECT COUNT(*) AS total FROM {$tableName}";

        if (empty($wheres)) {
            return (int) Database::connect()
                ->query("$query;")
                ->fetchColumn();
        }

        $where = self::prepareWhereQuery($wheres);

        $query .= $where['query'];
        // dd([$query, $where['values']]);

        $stmt = Database::connect()->prepare($query);
        $stmt->execute($where['values']);

        return (int) $stmt->fetchColumn();
    }//getTotal()

    public static function getDataTable(string $tableName, array $wheres = [], int $page = 1, int $limit = 10): array{
        $query1 = "SELECT * FROM {$tableName}";
        $query2 = "SELECT COUNT(*) AS count FROM {$tableName}";
        $DB = Database::connect();
        $offset = ($page - 1) * $limit;

        if (empty($wheres)) {
            $query1 .= " LIMIT {$limit} OFFSET {$offset};";

            $stmt1 = $DB->prepare($query1);
            $stmt1->execute([]);
            $data = $stmt1->fetchAll();

            $stmt2 = $DB->prepare($query2);
            $stmt2->execute([]);
            $count = (int) $stmt2->fetchColumn();

            return [
                'total' => $count,
                'data' => $data,
            ];
        }

        $where = self::prepareWhereQuery($wheres);

        $query1 .= "{$where['query']} LIMIT {$limit} OFFSET {$offset};";
        $query2 .= "{$where['query']};";

        $stmt1 = $DB->prepare($query1);
        $stmt1->execute($where['values']);
        $data = $stmt1->fetchAll();
        // sleep(10);
        $stmt2 = $DB->prepare($query2);
        $stmt2->execute($where['values']);
        $count = (int) $stmt2->fetchColumn();

        return [
            'total' => $count,
            'data' => $data,
        ];
    }

    private static function prepareWhereQuery(array $wheres): array{
        $finalQuery = '';
        
        $values = [];

        $output = [];
        $operators = [];

        $count = count($wheres);

        for ($i = 0; $i < $count; $i++) {
            $where = $wheres[$i];

            $column = $where[0];
            $operator = $where[1];
            $value = $where[2];

            $output[] = "{$column} {$operator} ?";

            $values[] = $value;

            if ($i === $count - 1) break;

            $logicalOperator = strtoupper($where[3] ?? 'AND');

            $bindingPower = $where[4] ?? 1;

            while (!empty($operators)) {

                $top = end($operators);

                if ($top['power'] >= $bindingPower) {

                    array_pop($operators);

                    $right = array_pop($output);
                    $left = array_pop($output);

                    $output[] = "({$left} {$top['operator']} {$right})";

                } 
                else {
                    break;
                }
            }

            $operators[] = [
                'operator' => $logicalOperator,
                'power' => $bindingPower
            ];
        }

        while (!empty($operators)) {
            $top = array_pop($operators);

            $right = array_pop($output);
            $left = array_pop($output);

            $output[] = "({$left} {$top['operator']} {$right})";
        }

        $whereClause = $output[0];

        if (
            strlen($whereClause) >= 2 &&
            $whereClause[0] === '(' &&
            $whereClause[strlen($whereClause) - 1] === ')'
        ) {
            $whereClause = substr($whereClause, 1, -1);
        }
        
        $finalQuery = " WHERE {$whereClause}";
        // dd([$finalQuery, $values]);
        return [
            'query' => $finalQuery, 
            'values' => $values
        ]; 
    }//prepareWhereQuery()

}