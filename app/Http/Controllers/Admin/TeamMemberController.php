<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamMemberController extends Controller
{
    public function index()
    {
        $teamMembers = TeamMember::ordered()->get();
        return view('admin.team.index', compact('teamMembers'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,png,gif,webp|max:10240',
            'instagram' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'discord' => 'nullable|string|max:255',
            'bluesky' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('team', 'public');
        }

        TeamMember::create($data);
        return redirect()->route('admin.team.index')->with('success', 'Team member added!');
    }

    public function edit(TeamMember $teamMember)
    {
        return view('admin.team.edit', compact('teamMember'));
    }

    public function update(Request $request, TeamMember $teamMember)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,png,gif,webp|max:10240',
            'instagram' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'discord' => 'nullable|string|max:255',
            'bluesky' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            if ($teamMember->image_path) {
                Storage::disk('public')->delete($teamMember->image_path);
            }
            $data['image_path'] = $request->file('image')->store('team', 'public');
        }

        $teamMember->update($data);
        return redirect()->route('admin.team.index')->with('success', 'Team member updated!');
    }

    public function destroy(TeamMember $teamMember)
    {
        if ($teamMember->image_path) {
            Storage::disk('public')->delete($teamMember->image_path);
        }
        $teamMember->delete();
        return redirect()->route('admin.team.index')->with('success', 'Team member removed.');
    }
}
