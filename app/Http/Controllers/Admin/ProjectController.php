<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProjectController extends Controller
{
    /**
     * Menampilkan formulir untuk mengedit detail proyek.
     */
    public function edit(Project $project): View
    {
        return view('admin.projects.edit', ['project' => $project]);
    }

    /**
     * Memperbarui detail proyek di database.
     */
    public function update(Request $request, Project $project): RedirectResponse
    {
        $validated = $request->validate([
            'description' => 'required|string',
            'repository_url' => 'nullable|url',
        ]);

        $project->update($validated);

        // Arahkan kembali ke halaman edit pelajaran induknya
        return redirect()->route('admin.lessons.edit', $project->lesson_id)
                         ->with('success', 'Detail proyek berhasil diperbarui!');
    }
}
