<?php

/**
 * Class Testsession
 */
class Testsession extends \Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'testsession';

    /**
     * @return array
     */
    public function getDates()
    {
        return array('date');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function report()
    {
        return $this->hasOne('Report');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function loadScript()
    {
        return $this->belongsTo('LoadScript');
    }

    /**
     * @param $value
     * @return string
     */
    public function getStatusFormattedAttribute($value)
    {
        switch($this->status)
        {
            case 1:
                return 'pending';
            break;
            case 2:
                return 'retrieved';
            break;
            case 3:
                return 'download';
            break;
            case 4:
                return 'running';
            break;
            case 5:
                return 'completed';
            break;
            default:
                return 'error';
            break;
        }
    }

}

