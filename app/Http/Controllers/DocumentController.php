<?php

namespace App\Http\Controllers;

use App\Document;
use App\File;
use App\Lesson;
use App\Professor;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $documents = Document::orderBy('id', 'DESC')->paginate();

        return view('dashboard.documents', compact('documents'));
    }

    public function form(Request $request)
    {
        $document = null;
        $documentId = $request->route('id', null);
        if (!is_null($documentId))
            $document = Document::find($documentId);
        $professors = Professor::orderBy('name', 'ASC')->get();
        $lessons = Lesson::orderBy('name', 'ASC')->get();
        return view('dashboard.documents_form', compact('document', 'professors', 'lessons'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'professor_id' => 'required',
            'lesson_id' => 'required',
        ]);
        $document = Document::create($request->all());
        $files = $request->file('files', []);
        FileController::uploadFiles($files, $document);

        return redirect()->route('dashboard.documents.list')->withInput(['message' => 'با موفقیت انجام شد.']);
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'professor_id' => 'required',
            'lesson_id' => 'required',
        ]);
        $documentId = $request->route('id', null);
        if (!is_null($documentId)) {
            $document = Document::find($documentId);
            if (is_null($document))
                return redirect()->back()->withErrors(['message' => 'جزوه مورد نظر یافت نشد']);
            $document->fill($request->all());
            $document->save();
            $files = $request->file('files', []);
            FileController::uploadFiles($files, $document);
            $deleteFiles = $request->get('deleteFiles', []);
            if (count($deleteFiles) > 0)
                FileController::delete($deleteFiles);
            return redirect()->route('dashboard.documents.list')->withInput(['message' => 'با موفقیت انجام شد.']);
        }
        return redirect()->route('dashboard.documents.list');
    }

    public function delete(Request $request)
    {
        $documentId = $request->route('id', null);
        if (!is_null($documentId)) {
            $document = Document::find($documentId);
            if (is_null($document))
                return redirect()->back()->withErrors(['message' => 'جزوه مورد نظر یافت نشد']);
            $filesList = $document->files->pluck('id')->toArray();
            $document->delete();
            FileController::delete($filesList);
            return redirect()->route('dashboard.documents.list')->withInput(['message' => 'با موفقیت انجام شد.']);
        }
        return redirect()->route('dashboard.documents.list');
    }
}
