<?php 
namespace App\Services;

use App\Repositories\WorkRepository;
use App\Models\WorkImage;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreWorkRequest;



class WorkService
{
    protected $repo;

    public function __construct(WorkRepository $repo)
    {
        $this->repo = $repo;
    }

    public function listApprovedWorks()
    {
        return $this->repo->getApprovedWorks();
    }

    public function createWork(StoreWorkRequest $request, $userId)
    {
        $work = $this->repo->createWork([
            'user_id' => $userId,
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'pending',
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('works_images', 'public');
                WorkImage::create([
                    'work_id' => $work->id,
                    'image' => $path,
                ]);
            }
        }

        return $work;
    }


    public function getWorkById($id)
    {
        return $this->repo->findById($id);
    }

    public function getWorksByUpcycler($userId)
    {
        return $this->repo->getByUpcycler($userId);
    }
}
