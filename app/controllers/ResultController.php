<?php

use Seflab\Repository\Report\ReportRepository;

/**
 * Class ResultController
 */
class ResultController extends BaseController
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
     * @return \Illuminate\View\View
     */
    public function getOverview()
    {
        $user = Auth::getUser();

        $results = $this->reportRepo->findAllByUserId($user->id);

        return View::make('admin.overview_results',
            ['results' => $results]);
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function getChart($id)
    {
        $user = Auth::getUser();
        $result = $this->reportRepo->findByUserId($id, $user->id);

        $file = base_path() . $result->report_path;

        $csvReader = new \Seflab\Csv\CsvReader($file);

        if (is_null($result))
            App::abort(404);

        return View::make('admin.view_chart', ['result' => $result, 'values' => $csvReader->getRows()]);
    }

}