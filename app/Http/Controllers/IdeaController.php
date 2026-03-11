<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateIdea;
use App\Http\Requests\StoreIdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;
use App\IdeaStatus;
use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $ideas = $user
            ->ideas()
            ->when(in_array($request->status, IdeaStatus::values()), fn ($query) => $query->where('status', $request->status))
            ->latest()
            ->get();

        return view('ideas.index', [
            'ideas' => $ideas,
            'statusCount' => Idea::statusCount($user),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): void
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * 
     * Ce code permet, pour chaque utilisateur connecté, de récupérer l’idée initialisée dans le formulaire 
     * ainsi que les steps correspondantes de manière sécurisée. Ensuite, chaque step est transformée en 
     * collection afin d’ajouter l’idée et ses différentes steps dans la base de données. Enfin, 
     * l’utilisateur est redirigé avec un message de succès lorsque tout s’est bien passé.
     * 
     */
    public function store(StoreIdeaRequest $request, CreateIdea $action)
    {
        
        $action->handle($request->safe()->all());

        return to_route('idea.index')
            ->with('success', 'Idea created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Idea $idea)
    {
        return view('ideas.show', [
            'idea' => $idea,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Idea $idea): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIdeaRequest $request, Idea $idea): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Idea $idea)
    {
        // Make sure you're authorized but it will be in another episode
        $idea->delete();

        return to_route('idea.index');
    }
}
