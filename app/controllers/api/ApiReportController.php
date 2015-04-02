<?php

use Seflab\Repository\Report\ReportRepository;

/**
 * Class ApiReportController
 */
class ApiReportController extends BaseController
{

    /**
     * @var Seflab\Repository\Report\ReportRepository
     */
    protected $reportRepo;

    /**
     * @param ReportRepository $reportRepo
     */
    public function __construct(ReportRepository $reportRepo)
    {
        $this->reportRepo = $reportRepo;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        $testSessionId = Input::get('id');
        $reportPath = Input::get('report_path');

        if ($this->reportRepo->add($testSessionId, $reportPath))
            return Response::json(['message' => 'Added report successfully'], 200);

        return Response::json(['message' => 'Failed miserably while creating report'], 404);
    }
}