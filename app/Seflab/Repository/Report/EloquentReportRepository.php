<?php namespace Seflab\Repository\Report;

/**
 * Class EloquentReportRepository
 * @package Seflab\Repository\Report
 */
class EloquentReportRepository implements ReportRepository
{

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $reportModel;

    /**
     * @param \Illuminate\Database\Eloquent\Model $reportModel
     */
    public function __construct($reportModel)
    {
        $this->reportModel = $reportModel;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->reportModel->find($id);
    }

    /**
     * @param $id
     * @param $userId
     * @return mixed
     */
    public function findByUserId($id, $userId)
    {
        return $this->reportModel->join('testsession', 'testsession.id', '=', 'report.testsession_id')
            ->join('loadscript', 'loadscript.id', '=', 'testsession.loadscript_id')
            ->join('virtualmachine', 'virtualmachine.id', '=', 'loadscript.virtualMachine_id')
            ->where('virtualmachine.user_id', $userId)
            ->where('report.id', $id)
            ->first([
                'report.id AS id',
                'report.file_path AS report_path',
                'loadscript.file_name AS loadscript_name',
                'virtualmachine.file_name AS virtualmachine_name'
            ]);
    }

    /**
     * @param $userId
     * @return mixed
     */
    public function findAllByUserId($userId)
    {

        $results = $this->reportModel->join('testsession', 'testsession.id', '=', 'report.testsession_id')
            ->join('loadscript', 'loadscript.id', '=', 'testsession.loadscript_id')
            ->join('virtualmachine', 'virtualmachine.id', '=', 'loadscript.virtualMachine_id')
            ->where('virtualmachine.user_id', $userId)
            ->get([
                'report.id AS id',
                'loadscript.file_name AS loadscript_name',
                'virtualmachine.file_name AS virtualmachine_name'
            ]);

        return $results;
    }


    /**
     * @param $userId
     * @return mixed
     */
    public function findTopThreeByUserId($userId)
    {
        $results = $this->reportModel->join('testsession', 'testsession.id', '=', 'report.testsession_id')
            ->join('loadscript', 'loadscript.id', '=', 'testsession.loadscript_id')
            ->join('virtualmachine', 'virtualmachine.id', '=', 'loadscript.virtualMachine_id')
            ->where('virtualmachine.user_id', $userId)
            ->orderBy('report.created_at', 'desc')
            ->take(3)
            ->get([
                'report.id AS id',
                'loadscript.file_name AS loadscript_name',
                'virtualmachine.file_name AS virtualmachine_name'
            ]);

        return $results;

    }

    /**
     * @param $testSessionId
     * @param $reportPath
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function add($testSessionId, $reportPath)
    {
        if ($this->reportModel->where('testsession_id', $testSessionId)->first())
            return null;

        try {
            $report = $this->reportModel->create([
                'testsession_id' => $testSessionId,
                'file_path' => $reportPath
            ]);

            if ($report)
                return $report;
        } catch (\Exception $e) {
            return null;
        }

        return null;
    }

}