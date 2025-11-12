<?php

namespace App\Http\Controllers;

use App\Services\WorkService;
use App\Http\Requests\StoreWorkRequest;
use Illuminate\Support\Facades\Auth;

class WorkController extends Controller
{
    protected $wokrService;

    public function __construct(WorkService $wokrService)
    {
        $this->wokrService = $wokrService;
    }

    public function index()
    {
        $works = $this->wokrService->listApprovedWorks();
        return view('works.index', compact('works'));
    }

    public function create()
    {
        return view('works.create');
    }

    public function store(StoreWorkRequest $request)
    {
        $this->wokrService->createWork($request, Auth::id());

        return dd($request);
    }

    public function show($id)
    {
        $work = $this->wokrService->getWorkById($id);
        return view('works.show', compact('work'));
    }

    public function byUpcycler($userId)
    {
        $works = $this->wokrService->getWorksByUpcycler($userId);
        return view('works.by-upcycler', compact('works'));
    }
}
