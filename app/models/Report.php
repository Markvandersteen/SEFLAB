<?php

/**
 * Class Report
 */
class Report extends \Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'report';

    /**
     * @var array
     */
    protected $fillable = ['testsession_id', 'file_path'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function testsession()
    {
        return $this->belongsTo('Testsession');
    }
}

