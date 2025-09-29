<?php
namespace App\Http\Controllers;

use App\Models\Participation;
use App\Models\Challenge;
use Illuminate\Http\Request;

class ParticipationController extends Controller
{
    public function index()
    {
        $participations = Participation::with(['challenge','user'])->get();
        return view('participations.index', compact('participations'));
    }

    public function create()
    {
        $challenges = Challenge::all();
        return view('participations.create', compact('challenges'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'challenge_id' => 'required|exists:challenges,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        Participation::create($data);
        return redirect()->route('participations.index')->with('success', 'Participation added.');
    }

    public function edit(Participation $participation)
    {
        $challenges = Challenge::all();
        return view('participations.edit', compact('participation','challenges'));
    }

    public function update(Request $request, Participation $participation)
    {
        $data = $request->validate([
            'challenge_id' => 'required|exists:challenges,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $participation->update($data);
        return redirect()->route('participations.index')->with('success', 'Participation updated.');
    }

    public function destroy(Participation $participation)
    {
        $participation->delete();
        return redirect()->route('participations.index')->with('success', 'Participation deleted.');
    }
}
