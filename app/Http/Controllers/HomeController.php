<?php

namespace App\Http\Controllers;

use App\Document;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $newest = Document::with('professor')
            ->with('lesson')
            ->orderBy('id', 'DESC')
            ->limit(10)
            ->get();
        return view('home', compact('newest'));
    }

    public function searchResults(Request $request)
    {
        $query = $request->get('query', null);
        if (!is_null($query)) {
//            $results = Document::with('professor')
//                ->with('lesson')
//                ->where('title', 'LIKE', '%' . $query . '%')
//                ->paginate(30);

        $results = Document::with('professor')
            ->with('lesson')
            ->where('title', 'LIKE', '%' . $query . '%')
            ->orWhereHas('professor', function ($q) use ($query) {
                $q->where('name', 'LIKE', '%' . $query . '%');
            })
            ->orWhereHas('lesson', function ($q) use ($query) {
                $q->where('name', 'LIKE', '%' . $query . '%');
            })
            ->paginate(30);

        }
        $newest = Document::with('professor')
            ->with('lesson')
            ->orderBy('id', 'DESC')
            ->limit(10)
            ->get();
        return view('home', compact('results', 'query', 'newest'));
    }

    public function viewDocument(Request $request)
    {
        $documentId = $request->route('id');
        $document = Document::with('files')->with('professor')->with('lesson')->where('id', $documentId)->get()->first();
        return view('view_document', compact('document'));
    }
}
