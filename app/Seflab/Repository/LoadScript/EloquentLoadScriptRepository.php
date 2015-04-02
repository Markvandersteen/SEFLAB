<?php namespace Seflab\Repository\LoadScript;

/**
 * Class EloquentLoadScriptRepository
 * @package Seflab\Repository\LoadScript
 */
class EloquentLoadScriptRepository implements LoadScriptRepository
{

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $loadScriptModel;

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    public function __construct($model)
    {
        $this->loadScriptModel = $model;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->loadScriptModel->find($id);
    }

    /**
     * @param $virtualMachineId
     * @return mixed
     */
    public function findByVirtualMachineId($virtualMachineId)
    {
        return $this->loadScriptModel->where('virtualMachine_id', $virtualMachineId)->first();
    }

    /**
     * @param $virtualMachineId
     * @param $fileName
     * @param $filePath
     * @param $fileSize
     * @return mixed
     */
    public function add($virtualMachineId, $fileName, $filePath, $fileSize)
    {
        $this->loadScriptModel->virtualMachine_id = $virtualMachineId;
        $this->loadScriptModel->file_name = $fileName;
        $this->loadScriptModel->file_path = $filePath;
        $this->loadScriptModel->file_size = $fileSize;
        $this->loadScriptModel->save();

        return $this->loadScriptModel;
    }

    /**
     * @param $loadScriptId
     * @return null
     */
    public function remove($loadScriptId)
    {
        $model = $this->loadScriptModel->find($loadScriptId);
        return is_null($model) ? null : $model->delete();
    }
}