<?php namespace Seflab\Csv;

/**
 * Class CsvReader
 * @package Seflab\Csv
 */
class CsvReader
{

    /**
     * @var \Keboola\Csv\CsvFile
     */
    protected $reader;

    /**
     * Takes a filepath and sets up the CSV file reader
     * @param $file
     */
    public function __construct($file)
    {
        $this->reader = new \Keboola\Csv\CsvFile($file);
    }

    /**
     * Gets all the rows of the CSV file.
     * @return array
     */
    public function getRows()
    {
        $rows = array();

        foreach ($this->reader as $row)
            $rows[] = $row;

        return $rows;
    }

}