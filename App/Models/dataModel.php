<?php

namespace App\Models;

use PDO;

class DataModel
{
    private PDO $pdo;
    private array $allowedColumns = ['id', 'name', 'email', 'phone', 'city', 'age', 'created_at'];

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Returns the WHERE clause for search with unique placeholders.
     *
     * @return string
     */
    private function buildSearchWhere(): string
    {
        return "name LIKE :search_name OR email LIKE :search_email OR phone LIKE :search_phone OR city LIKE :search_city OR age LIKE :search_age";
    }

    /**
     * Returns the total number of records from the 'users' table.
     *
     * @return int
     */
    public function getTotalRecords(): int
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users");
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }

    /**
     * Returns the total number of filtered records based on the search value.
     *
     * @param string $searchValue
     * @return int
     */
    public function getTotalFiltered(string $searchValue): int
    {
        if (empty($searchValue)) {
            return $this->getTotalRecords();
        }

        $sql = "SELECT COUNT(*) FROM users WHERE " . $this->buildSearchWhere();
        $stmt = $this->pdo->prepare($sql);
        $this->bindSearchParameters($stmt, $searchValue);
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }

    /**
     * Retrieves data with filtering, sorting, and pagination.
     *
     * @param int $start
     * @param int $length
     * @param string $searchValue
     * @param string $orderBy
     * @param string $orderDir
     * @return array
     */
    public function getData(int $start, int $length, string $searchValue, string $orderBy = 'id', string $orderDir = 'asc'): array
    {
        $where = empty($searchValue) ? '' : 'WHERE ' . $this->buildSearchWhere();
        $orderDir = strtoupper($orderDir) === 'DESC' ? 'DESC' : 'ASC';
        $orderBy = in_array($orderBy, $this->allowedColumns) ? $orderBy : 'id';

        $sql = "SELECT id, name, email, phone, city, age, created_at 
                FROM users 
                $where 
                ORDER BY $orderBy $orderDir 
                LIMIT :start, :length";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':start', $start, PDO::PARAM_INT);
        $stmt->bindValue(':length', $length, PDO::PARAM_INT);

        if (!empty($searchValue)) {
            $this->bindSearchParameters($stmt, $searchValue);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Helper method for binding search parameters.
     *
     * @param \PDOStatement $stmt
     * @param string $searchValue
     * @return void
     */
    private function bindSearchParameters(\PDOStatement $stmt, string $searchValue): void
    {
        $pattern = "%{$searchValue}%";
        $stmt->bindValue(':search_name', $pattern, PDO::PARAM_STR);
        $stmt->bindValue(':search_email', $pattern, PDO::PARAM_STR);
        $stmt->bindValue(':search_phone', $pattern, PDO::PARAM_STR);
        $stmt->bindValue(':search_city', $pattern, PDO::PARAM_STR);
        $stmt->bindValue(':search_age', $pattern, PDO::PARAM_STR);
    }
}
