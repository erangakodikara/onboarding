<?php


namespace onboard\src\util;


class ReadCSV
{

    private $_data = [];

    public function __construct(array $data)
    {
        $this->_data = $data;
    }

    public function getRowCount()
    {
        return count($this->_data);
    }

    public function getValueAt($row, $column)
    {
        if ($row >= $this->getRowCount()) {
            throw new OutOfRangeException();
        }

        return isset($this->_data[$row][$column])
            ? $this->_data[$row][$column]
            : null;
    }
}