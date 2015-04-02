<?php

use Seflab\Repository\Queue\QueueRepository;

/**
 * Class ApiQueueController
 */
class ApiQueueController extends BaseController
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function get()
    {
        $item = $this->queueRepo->findFirstItem();

        if (!is_null($item))
            return $item;

        return Response::json(['message' => 'No item was found'], 404);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function update()
    {
        $id = Input::get('id');
        $statusCode = Input::get('statusCode');

        if ($this->queueRepo->updateStatus($id, $statusCode))
            return Response::json(
                ['message' => 'Successfully updated ID ' .
                    $id . ' to status ' . $statusCode],
                200);

        return Response::json(['message' => 'Could not update ID ' . $id], 404);
    }


}