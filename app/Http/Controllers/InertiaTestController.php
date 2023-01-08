<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\InertiaTest;

class InertiaTestController extends Controller
{
    public function Index() {
        return Inertia::render('Inertia/Index');
    }

    public function Show($id) {
        // dd($id);
        return Inertia::render('Inertia/Show', [
            'id' => $id
        ]);
    }

    public function Store(Request $request)
    {
        $inertiaTest = new InertiaTest;
        $inertiaTest->title = $request->title;
        $inertiaTest->content = $request->content;
        $inertiaTest->save();

        return to_route('inertia.index');
    }
}
