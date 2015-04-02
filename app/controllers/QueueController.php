<?php

use Seflab\Repository\Queue\QueueRepository;

/**
 * Class QueueController
 */
class QueueController extends BaseController
{

    /**
     * @var Seflab\Repository\Queue\QueueRepository
     */
    protected $queueRepo;

    /**
     * @param QueueRepository $queueRepo
     */
    public function __construct(QueueRepository $queueRepo)
    {
        $this->queueRepo = $queueRepo;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add($id)
    {
        $this->queueRepo->add($id);

        return Redirect::route('queue');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function getOverview()
    {
        $user = Auth::getUser();

        $testsessions = $this->queueRepo->findByUserId($user->id);

        return View::make('admin.overview_queue',
            ['testsessions' => $testsessions]);
    }

}