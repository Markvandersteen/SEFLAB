<?php namespace Seflab\Repository\Queue;

/**
 * Class EloquentQueueRepository
 * @package Seflab\Repository\Queue
 */
class EloquentQueueRepository extends QueueRepository
{

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $queueModel;

    /**
     * @param \Illuminate\Database\Eloquent\Model $queueModel
     */
    public function __construct($queueModel)
    {
        $this->queueModel = $queueModel;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->queueModel->find($id);
    }

    /**
     * @return mixed
     */
    public function findFirstItem()
    {
        return $this->queueModel->join('loadscript', 'loadscript.id', '=', 'testsession.loadscript_id')
            ->join('virtualmachine', 'virtualmachine.id', '=', 'loadscript.virtualMachine_id')
            ->orderBy('testsession.created_at', 'ASC')
            ->where('status', '<>', static::STATUS_COMPLETED)
            ->first([
                'testsession.id',
                'testsession.updated_at as date',
                'testsession.status',
                'loadscript.file_path as loadscript_path',
                'virtualmachine.file_path as virtualmachine_path'
            ]);
    }

    /**
     * @param $id
     * @param $statusCode
     * @return null
     */
    public function updateStatus($id, $statusCode)
    {
        // No malicious status codes protection
        switch ($statusCode) {
            case static::STATUS_ERROR:
                $updatedStatus = $statusCode;
                break;
            case static::STATUS_PENDING:
                $updatedStatus = $statusCode;
                break;
            case static::STATUS_RETRIEVED:
                $updatedStatus = $statusCode;
                break;
            case static::STATUS_DOWNLOADED:
                $updatedStatus = $statusCode;
                break;
            case static::STATUS_RUNNING:
                $updatedStatus = $statusCode;
                break;
            case static::STATUS_COMPLETED:
                $updatedStatus = $statusCode;
                break;
        }

        if (isset($updatedStatus)) {
            $item = $this->queueModel->find($id);
            if (!is_null($item)) {
                $item->status = $updatedStatus;
                $item->save();

                return $item;
            }
        }

        return null;
    }

    /**
     * @param $userId
     * @return mixed
     */
    public function findByUserId($userId)
    {
        // Double join because the user id is only set in the virtualmachine table
        return $this->queueModel->join('loadscript', 'loadscript.id', '=', 'testsession.loadscript_id')
            ->join('virtualmachine', 'virtualmachine.id', '=', 'loadscript.virtualMachine_id')
            ->where('virtualmachine.user_id', $userId)
            ->orderBy('testsession.updated_at', 'DESC')
            ->get([
                'testsession.id',
                'testsession.updated_at as date',
                'loadscript.file_name as loadscript_name',
                'virtualmachine.file_name as virtualmachine_name',
                'testsession.status'
            ]);
    }

    /**
     * @param $loadScriptId
     */
    public function add($loadScriptId)
    {
        $this->queueModel->loadscript_id = $loadScriptId;
        $this->queueModel->save();
    }

}