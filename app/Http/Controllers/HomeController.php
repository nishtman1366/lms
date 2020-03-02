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
        return view('home');
    }

    public function searchResults(Request $request)
    {
        $query = $request->get('query', null);
        $results = Document::with('professor')
            ->with('lesson')
            ->where('title', 'LIKE', '%' . $query . '%')
            ->paginate(30);

        return view('home', compact('results', 'query'));
    }

    public function viewDocument(Request $request)
    {
        $documentId = $request->route('id');
        $document = Document::with('files')->with('professor')->with('lesson')->where('id', $documentId)->get()->first();
        return view('view_document', compact('document'));
    }
}
