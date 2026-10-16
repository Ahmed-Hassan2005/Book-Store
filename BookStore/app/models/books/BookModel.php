<?php

require_once __DIR__ . '/../Model.php';

class BookModel extends Model {
    public static function getDataBooks(array $wheres = [], int $page = 1, int $limit = 10, string $orderBy = 'id DESC'): array{
        $query1 = 
            "SELECT 
                books.*, 
                authors.name AS author_name,
                authors.id AS author_id
            FROM books
            LEFT JOIN authors
            ON authors.id = books.author_id";

        $query2 = 
            "SELECT COUNT(*) AS count 
            FROM books
            LEFT JOIN authors
            ON authors.id = books.author_id";

        $DB = Database::connect();
        $offset = ($page - 1) * $limit;

        if (empty($wheres)) {
            $query1 .= " ORDER BY {$orderBy} LIMIT {$limit} OFFSET {$offset};";

            $stmt1 = $DB->prepare($query1);
            $stmt1->execute([]);
            $data = $stmt1->fetchAll();

            $stmt2 = $DB->prepare($query2);
            $stmt2->execute([]);
            $count = (int) $stmt2->fetchColumn();

            return [
                'total' => $count,
                'data' => $data,
                'currentPage' => $page
            ];
        }

        $where = self::prepareWhereQuery($wheres);
        // Response::json([$where]);

        $query1 .= 
            "{$where['query']} 
            ORDER BY {$orderBy}
            LIMIT {$limit} OFFSET {$offset};";

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
            'currentPage' => $page
        ];
    }//getDataTable()

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