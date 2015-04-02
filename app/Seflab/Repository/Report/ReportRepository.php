<?php namespace Seflab\Repository\Report;

use Seflab\Repository\BaseRepository;

/**
 * Interface ReportRepository
 * @package Seflab\Repository\Report
 */
interface ReportRepository extends BaseRepository
{

    /**
     * @param $testSessionId
     * @param $reportPath
     * @return mixed
     */
    public function add($testSessionId, $reportPath);

    /**
     * @param $userId
     * @return mixed
     */
    public function findAllByUserId($userId);

    /**
     * @param $id
     * @param $userId
     * @return mixed
     */
    public function findByUserId($id, $userId);

}