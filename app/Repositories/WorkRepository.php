<?php 
namespace App\Repositories;

use App\Models\Work;

class WorkRepository
{
    protected $model;

    public function __construct(Work $work)
    {
        $this->model = $work;
    }

    public function getApprovedWorks()
    {
        return $this->model->with('images', 'user')
            ->where('status', 'approved')
            ->latest()
            ->get();
    }

    public function createWork(array $data)
    {
        return $this->model->create($data);
    }

    public function findById($id)
    {
        return $this->model->with('images', 'user')->findOrFail($id);
    }

    public function getByUpcycler($userId)
    {
        return $this->model->where('user_id', $userId)
            ->where('status', 'approved')
            ->with('images', 'user')
            ->latest()
            ->get();
    }
}
