<?php

/**
 * Class VirtualMachine
 */
class VirtualMachine extends \Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'virtualmachine';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function loadScripts()
    {
        return $this->hasMany('LoadScript', 'virtualMachine_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('User');
    }
}

