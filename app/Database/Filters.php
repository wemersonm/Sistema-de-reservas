<?php

namespace app\Database;

class Filters
{
    private array $filters = [];
    private array $bindValues = [];

    public function where(string $fields, string $operator, mixed $value, string $logic = '')
    {
        $formater = '';

        if (is_array($value)) {
            $a = implode(",", $value);
            $formater = "('" . implode("','", $value) . "')";
        } elseif (is_string($value)) {
            $formater = "{$value}";
        } elseif (is_bool($value)) {
            $formater = $value ? 1 : 0;
        } else {
            $formater = $value;
        }

        $bindParam = substr_count($fields, ".") ? str_replace(".", "", $fields) : $fields;

        $this->filters['where'][] = "{$fields} {$operator} :{$bindParam} {$logic}";
        $this->bindValues  = [$bindParam => $formater];
    }

    public function limit(string $limit)
    {
        $this->filters['limit'] = " LIMIT ".$limit;
       
    }
    public function orderBy(string $field, string $order = 'asc')
    {
        $this->filters['order'] = " ODER BY :{$field}" . $order;
    }

    public function formatQuery()
    {

        $filter =  !empty($this->filters['where']) ? ' WHERE ' . implode(" ", $this->filters['where']) : '';
        $filter .= $this->filters['order'] ?? '';
        $filter .= $this->filters['limit'] ?? '';
        return $filter;
    }
    public function returnParamValues()
    {
        return $this->bindValues;
    }
}
