<?php

namespace App\Http\Controllers;

use App\Helpers\ContentHelper;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index()
    {
        $content = ContentHelper::load();
        return view('admin.content', compact('content'));
    }

    public function update(Request $request)
    {
        $current  = ContentHelper::load();
        $fields   = $request->except(['_token']);
        $merged   = array_merge($current, $fields);

        // Verwijder FAQ entries die boven de nieuwe count vallen
        $newCount = (int) ($fields['about_faq_count'] ?? 0);
        $oldCount = (int) ($current['about_faq_count'] ?? 3);
        if ($newCount < $oldCount) {
            for ($i = $newCount + 1; $i <= $oldCount; $i++) {
                unset($merged['about_faq_' . $i . '_question']);
                unset($merged['about_faq_' . $i . '_answer']);
            }
        }

        ContentHelper::save($merged);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Teksten opgeslagen!']);
        }
        return redirect()->route('admin.content')->with('success', 'Teksten opgeslagen!');
    }
}
