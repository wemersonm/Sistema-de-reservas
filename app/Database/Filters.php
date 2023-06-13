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
        $this->bindValues[$bindParam] = $formater;
    }

    public function limit(string $limit)
    {
        $this->filters['limit'] = " LIMIT " . $limit;
    }
    public function orderBy(string $field, string $order = 'asc')
    {
        $this->filters['order'] = " ORDER BY {$field} " . $order;
    }
    public function between(string $field, string $value1, string $value2, string $logic = '')
    {
        if ($logic == "OR" || $logic == "AND") {
            $this->filters['between'][] = "( {$field} BETWEEN {$value1} AND {$value2}) {$logic}";
        } else {
            $this->filters['between'][] = " {$field} BETWEEN {$value1} AND {$value2} ";
        }
    }

    public function dumpAnd(Filters $filter)
    {
        if (!empty($this->filters['where'])) {
            if (count($filter->filters['where']) > 1) {
                for ($i = 0; $i < (count($filter->filters['where']) - 1); $i++) {
                    $filter->filters['where'][$i] = $filter->filters['where'][$i] . " AND ";
                }
            }
        }
    }


    public function formatQuery()
    {

        $filter =  !empty($this->filters['where']) ? ' WHERE ' . implode(" ", $this->filters['where']) : '';
        $filter .= !empty($this->filters['between']) ? implode(" ", $this->filters['between']) : '';
        $filter .= $this->filters['order'] ?? '';
        $filter .= $this->filters['limit'] ?? '';
        return $filter;
    }
    public function returnParamValues()
    {
        return $this->bindValues;
    }
}
