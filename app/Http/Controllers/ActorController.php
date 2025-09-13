<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ActorService;

class ActorController extends Controller
{
    protected $actorService;

    public function __construct(ActorService $actorService)
    {
        $this->actorService = $actorService;
    }

    public function index()
    {
        return view('actors.index');
    }

    public function show()
    {
        $actors = $this->actorService->getAllActors();
        
        return view('actors.show', compact('actors'));
    }

    public function store(Request $request)
    {
        $result = $this->actorService->processActorSubmission($request->all());

        if (!$result['success']) {
            return redirect()->back()
                ->withErrors($result['errors'])
                ->withInput();
        }

        return redirect()->route('actors.show')
            ->with('success', 'Actor information submitted successfully!');
    }

    public function promptValidation()
    {
        return response()->json([
            'message' => 'text_prompt'
        ]);
    }
}
