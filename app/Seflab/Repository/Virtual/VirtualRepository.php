<?php namespace Seflab\Repository\Virtual;

/**
 * Interface VirtualRepository
 * @package Seflab\Repository\Virtual
 */
interface VirtualRepository
{

    /**
     * @param $id
     * @return mixed
     */
    public function getLatestVirtualMachine($id);
}