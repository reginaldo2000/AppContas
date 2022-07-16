<?php

namespace Source\Dao;

use PDO;
use PDOStatement;
use PDOException;

/**
 * Description of DatabaseUtil
 *
 * @author Reginaldo
 */
abstract class DatabaseUtil {

    private ?PDO $conn = null;
    private string $table = "";
    private string $queryParams = "";
    private array $arrayParams = [];
    private string $joinTable = "";
    private string $queryJoin = "";
    private string $orderBy = "";
    private string $query = "";

    public function __construct(string $table) {
        $this->table = $table;
    }

    private function conn(): ?PDO {
        try {
            $dbOptions = [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4",
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::ATTR_CASE => PDO::CASE_NATURAL
            ];
            if ($this->conn == null) {
                $this->conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, $dbOptions);
            }
            return $this->conn;
        } catch (PDOException $e) {
            redirect("/error/501");
        }
    }

    public function select(array $columns = []): DatabaseUtil {
        $this->query = "SELECT {$this->stringColumns($columns)} FROM "
                . "{$this->table} ";
        return $this;
    }

    /**
     * @param bool $isObject
     * @return mixed
     * @throws PDOException
     */
    public function fetch(bool $isObject = false) {
        try {
            $this->query .= "{$this->queryJoin} "
                    . "{$this->queryParams} "
                    . "{$this->orderBy}";
            $stmt = $this->conn()->prepare($this->query);
            $stmt->execute($this->arrayParams);
            $this->clean();
            if ($isObject) {
                return $stmt->fetch();
            }
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), 500);
        }
    }

    public function save(): void {
        try {
            if ($this->arrayParams["id"] != "") {
                unset($this->arrayParams["data_criacao"]);
                $sql = $this->update();
            } else {
                $sql = $this->insert();
            }
            $stmt = $this->conn()->prepare($sql);
            $stmt->execute($this->arrayParams);
            $this->clean();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), 500);
        }
    }

    public function delete(array $rules = []): void {
        try {
            $sql = "DELETE FROM {$this->table} WHERE {$this->table}.id = :id";
            $stmt = $this->conn()->prepare($sql);
            $stmt->execute($this->arrayParams);
            $this->clean();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), 500);
        }
    }

    public function where(string $param, $value, string $operator = "="): DatabaseUtil {
        $this->queryParams .= " WHERE {$this->table}.{$param} {$operator} :{$param}";
        $this->arrayParams[$param] = $value;
        return $this;
    }

    public function and(string $param, $value, string $operator = "="): DatabaseUtil {
        $this->queryParams .= " AND {$this->table}.{$param} {$operator} :{$param}";
        $this->arrayParams[$param] = $value;
        return $this;
    }

    public function or(string $param, $value, string $operator = "="): DatabaseUtil {
        $this->queryParams .= " OR {$this->table}.{$param} {$operator} :{$param}";
        $this->arrayParams[$param] = $value;
        return $this;
    }

    public function between(string $param, array $values, string $logic): DatabaseUtil {
        if ($this->queryParams != "") {
            $this->queryParams .= " {$logic} {$this->table}.{$param} BETWEEN '{$values[0]}' AND '{$values[1]}'";
        } else {
            $this->queryParams .= " WHERE {$this->table}.{$param} BETWEEN '{$values[0]}' AND '{$values[1]}'";
        }
        return $this;
    }

    public function orderBy(string $column, string $orientation = "ASC"): DatabaseUtil {
        if ($this->orderBy == "") {
            $this->orderBy .= " ORDER BY {$column} {$orientation}";
        } else {
            $this->orderBy .= ", {$column} {$orientation}";
        }
        return $this;
    }

    public function joinTable(string $joinTable, string $prevTable, array $compareTo, string $typeJoin = "INNER JOIN"): DatabaseUtil {
        $this->joinTable = $joinTable;
        if ($this->queryJoin == "") {
            $this->queryJoin .= "{$typeJoin} {$joinTable} ON {$joinTable}.{$compareTo[0]} = {$prevTable}.{$compareTo[1]} ";
        } else {
            $this->queryJoin .= "{$typeJoin} {$joinTable} ON {$joinTable}.{$compareTo[0]} = {$prevTable}.{$compareTo[1]} ";
        }
        return $this;
    }

    public function joinParam(string $param, $value, string $operator = "=", string $logic = "AND"): DatabaseUtil {
        if ($this->queryParams == "") {
            $this->queryParams .= " WHERE {$this->joinTable}.{$param} {$operator} :{$param}";
        } else {
            $this->queryParams .= " {$logic} {$this->joinTable}.{$param} {$operator} :{$param}";
        }
        $this->arrayParams[$param] = $value;
        return $this;
    }

    public function addParam(string $param, $value): void {
        $this->arrayParams[$param] = $value;
    }

    public function lastInsertId(): ?int {
        return $this->conn()->lastInsertId();
    }

    private function stringColumns(array $columns): string {
        return (count($columns) > 0 ? implode(",", $columns) : "*");
    }

    private function clean(): void {
        $this->queryParams = "";
        $this->arrayParams = [];
        $this->joinTable = "";
        $this->queryJoin = "";
        $this->orderBy = "";
        $this->query = "";
    }

    private function insert(): string {
        $columns = implode(",", array_keys($this->arrayParams));
        $binds = ":" . implode(",:", array_keys($this->arrayParams));
        $sql = "INSERT INTO {$this->table} ({$columns}) "
                . "VALUES ({$binds})";
        return $sql;
    }

    private function update(array $rules = []): string {
        $aux = [];
        $sql = "UPDATE {$this->table} SET ";
        foreach ($this->arrayParams as $key => $value) {
            if ($key != "id") {
                array_push($aux, "{$key} = :{$key}");
            }
        }
        $sql .= implode(",", $aux) . " WHERE {$this->table}.id = :id";
        return $sql;
    }

}
