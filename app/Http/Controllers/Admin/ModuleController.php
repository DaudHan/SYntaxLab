<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Models\Course;
    use App\Models\Module;
    use Illuminate\Http\Request;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Contracts\View\View;

    class ModuleController extends Controller
    {
        /**
         * Menyimpan modul baru ke dalam database.
         */
        public function store(Request $request, Course $course): RedirectResponse
        {
            $request->validate(['title' => 'required|string|max:255']);

            // Tentukan urutan untuk modul baru
            $order = $course->modules()->max('order_index') + 1;

            $course->modules()->create([
                'title' => $request->title,
                'order_index' => $order,
            ]);

            return back()->with('success', 'Modul baru berhasil ditambahkan!');
        }

    public function edit(Module $module): View
    {
        // Laravel akan secara otomatis menemukan data modul berdasarkan {module}
        // yang ada di URL. Kita tinggal mengirimkannya ke view.
        return view('admin.modules.edit', ['module' => $module]);
    }

    public function update(Request $request, Module $module): RedirectResponse
    {
        // 1. Validasi data yang masuk dari form
        $request->validate([
            'title' => 'required|string|max:255',
        ]);
        
        // 2. Perbarui judul modul dengan data yang sudah divalidasi
        $module->update([
            'title' => $request->title,
        ]);
        
        // 3. Arahkan admin kembali ke halaman edit kursus induknya,
        //    sambil membawa pesan sukses.
        return redirect()->route('admin.courses.edit', $module->course_id)
                         ->with('success', 'Modul berhasil diperbarui!');
    }

    public function destroy(Module $module): RedirectResponse
    {
        // Hapus modul. Karena ada cascadeOnDelete di migrasi lessons,
        // semua pelajaran di dalam modul ini akan ikut terhapus secara otomatis.
        $module->delete();

        // Arahkan kembali ke halaman sebelumnya dengan pesan sukses.
        return back()->with('success', 'Modul berhasil dihapus!');
    }   
    }
    