<?php
/**
 * File: Npass.php
 * @author: Cvar1984 <gedzsarjuncomuniti@gmail.com>
 * Date: 19.01.2020
 * Last Modified Date: 20.01.2020
 * Last Modified By: Cvar1984 <gedzsarjuncomuniti@gmail.com>
 */
namespace Cvar1984\Npass;

use League\Csv\Reader;
use League\Csv\Statement;
use Mihanentalpo\FastFuzzySearch\FastFuzzySearch;

class Npass implements NpassInterface
{
    private $csv;
    private $records;
    private $highResult;
    private $midResult;
    private $lowResult;

    public function setDataSheet($dataSheet, $mode = 'r')
    {
        $csv = Reader::createFromPath($dataSheet, $mode);
        $this->csv = $csv->setHeaderOffset(0);
        return $this;
    }

    public function getRecord()
    {
        $csv = $this->csv;
        $stmt = new Statement();
        $records = $stmt->process($csv);

        foreach ($records as $record) {
            $this->records[] = $record['word'];
        }
        return $this;
    }

    public function findWord($word, int $depth = 1)
    {
        $wordList = $this->records;
        $ffs = new FastFuzzySearch($wordList);
        $results = $ffs->find($word, $depth);
        foreach ($results as $key => $result) {
            if ($result['percent'] >= 1) {
                $this->highResult[] = $result['word'];
            } elseif ($result['percent'] >= 0.5) {
                $this->midResult[] = $result['word'];
            } elseif ($result['percent'] <= 0.5) {
                $this->lowResult[] = $result['word'];
            }
        }
        return $this;
    }
    public function getHigh()
    {
        $result = $this->highResult;
        return $result;
    }
    public function getMid()
    {
        $result = $this->midResult;
        return $result;
    }
    public function getLow()
    {
        $result = $this->lowResult;
        return $result;
    }
}
