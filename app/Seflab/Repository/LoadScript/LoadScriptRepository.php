<?php namespace Seflab\Repository\LoadScript;

use Seflab\Repository\BaseRepository;

/**
 * Interface LoadScriptRepository
 * @package Seflab\Repository\LoadScript
 */
interface LoadScriptRepository extends BaseRepository
{

    /**
     * @param $virtualMachineId
     * @param $fileName
     * @param $filePath
     * @param $fileSize
     * @return mixed
     */
    public function add($virtualMachineId, $fileName, $filePath, $fileSize);

    /**
     * @param $virtualMachineId
     * @return mixed
     */
    public function findByVirtualMachineId($virtualMachineId);

    /**
     * @param $loadScriptId
     * @return mixed
     */
    public function remove($loadScriptId);

}