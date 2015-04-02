<?php
namespace Seflab\Repository\Virtual;

use Seflab\Repository\BaseRepository;

/**
 * Class EloquentVirtualRepository
 * @package Seflab\Repository\Virtual
 */
class EloquentVirtualRepository implements VirtualRepository
{

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $virtualModel;

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    public function __construct($model)
    {
        $this->virtualModel = $model;
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getLatestVirtualMachine($id)
    {
        return $this->virtualModel->where('user_id', $id)->orderBy('created_at', 'desc')->first();
    }

}