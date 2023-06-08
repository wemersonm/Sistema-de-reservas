<?php

namespace app\Database\Models;

use app\Database\Connection;
use app\Database\Filters;
use Exception;
use PDO;

abstract class Model
{
    private string $fields = "*";
    private string $filters = "";
    private array $values = [];
    private array $objJoin = [];

    abstract protected function getTable();

    public function setFields(string $field)
    {
        $this->fields = $field;
    }
    public function setFilters(Filters $filters)
    {
        $this->filters = $filters->formatQuery();
        $this->values = $filters->returnParamValues();
    }

    public function fetchAll()
    {
        try {
            $conn =  Connection::connect();
            $stmt = $conn->prepare("SELECT {$this->fields} FROM {$this->getTable()} {$this->filters}");

            $stmt->execute($this->values);
            return $stmt->rowCount() > 0 ? $stmt->fetchAll() : [];
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function findBy()
    {
        try {
            $conn =  Connection::connect();
            $stmt = $conn->prepare("SELECT {$this->fields} FROM {$this->getTable()} {$this->filters}");
            $stmt->execute($this->values);

            return $stmt->rowCount() > 0 ? $stmt->fetch() : [];
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function delete(string $field = '', string $value = '')
    {
        try {
            $conn =  Connection::connect();
            $stmt = $conn->prepare("DELETE FROM {$this->getTable()} {$this->filters} ");
            $stmt->execute($this->values);
            return $stmt->rowCount() > 0 ? true : false;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function count()
    {
        try {
            $conn =  Connection::connect();
            $stmt = $conn->prepare("SELECT {$this->fields} FROM {$this->getTable()}");
            $stmt->execute();
            return $stmt->rowCount();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function multipleJoin(string $tableJoin, string $field1, string $operator, string $field2, string $typeJoin = 'INNER JOIN')
    {
        try {
            $this->objJoin[] = "{$typeJoin} {$tableJoin} ON {$field1} {$operator} {$field2} ";
            return $this;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function dumpJoin()
    {

        try {
            if (!empty($this->objJoin)) {
                $format = '';
                foreach ($this->objJoin as $join) {
                    $format .= $join;
                }
            }
            $conn =  Connection::connect();
            $stmt = $conn->prepare("SELECT {$this->fields} FROM {$this->getTable()}  
            {$format}
            {$this->filters}
            ");


            $stmt->execute($this->values);

            return $stmt->rowCount() > 0 ? $stmt->fetchAll() : [];
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function join(string $tableJoin, string $field1, string $operator, string $field2, string $typeJoin = 'INNER JOIN')
    {
        try {
            $conn =  Connection::connect();

            $stmt = $conn->prepare("SELECT {$this->fields} FROM {$this->getTable()}  
            {$typeJoin} {$tableJoin} 
            ON {$field1} {$operator} {$field2} 
            {$this->filters}
            ");

            $stmt->execute($this->values);

            return $stmt->rowCount() > 0 ? $stmt->fetchAll() : [];
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function create(array $data)
    {
        try {
            $format = "INSERT INTO {$this->getTable()} (" . implode(", ", array_keys($data)) . ")";
            $format .= " VALUES (:" . implode(", :", array_keys($data)) . ")";

            $conn =  Connection::connect();
            $stmt = $conn->prepare($format);
            $stmt->execute($data);
            return $stmt->rowCount() > 0 ? true : false;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function update(string $field, string $value, array $data)
    {
        try {
            $data['updated_at'] = date("Y-m-d H:i:s");
            $format = "UPDATE {$this->getTable()} SET ";
            foreach ($data as $index => $fieldData) {
                $format .= "{$index} = :{$index}, ";
            }
            $pos = strripos($format, ",");
            $format = $pos != false ? substr_replace($format, "", $pos) : $format;
            $format .= " WHERE {$field} = :{$field}";

            $data += [$field => $value];
            $conn =  Connection::connect();
            $stmt = $conn->prepare($format);
            $stmt->execute($data);
            return $stmt->rowCount() > 0 ? true : false;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function existsReserve(array $data)
    {
        try {
            unset($data['pickupHour']);
            unset($data['returnHour']);
            $conn =  Connection::connect();
            $stmt = $conn->prepare(
                "SELECT {$this->fields}
            FROM {$this->getTable()}
            WHERE idCar = :idCar
            AND  paymentStatus = 'approved'
            AND reservationStatus = '1'
            AND paymentId IS NOT NULL
            AND ( 
                (:pickupDate BETWEEN pickupDate AND returnDate)
                OR
                (:returnDate BETWEEN pickupDate AND returnDate)
            ) LIMIT 1
            "
            );

            $stmt->execute($data);

            return $stmt->rowCount() > 0 ? $stmt->fetch() : [];
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
