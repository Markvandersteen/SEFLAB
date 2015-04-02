<?php namespace Seflab\Repository\Queue;

use Seflab\Repository\BaseRepository;

/**
 * Class QueueRepository
 * @package Seflab\Repository\Queue
 */
abstract class QueueRepository implements BaseRepository
{

    const STATUS_ERROR      = 0;
    const STATUS_PENDING    = 1;
    const STATUS_RETRIEVED  = 2;
    const STATUS_DOWNLOADED = 3;
    const STATUS_RUNNING    = 4;
    const STATUS_COMPLETED  = 5;

    /**
     * @return mixed
     */
    abstract public function findFirstItem();

    /**
     * @param $userId
     * @return mixed
     */
    abstract public function findByUserId($userId);

    /**
     * @param $loadScriptId
     * @return mixed
     */
    abstract public function add($loadScriptId);

}