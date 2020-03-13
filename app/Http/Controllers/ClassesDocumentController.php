<?php

namespace App\Http\Controllers;

use App\ClassesDocument;
use App\File;
use App\UsersClass;
use Illuminate\Http\Request;

class ClassesDocumentController extends Controller
{
    public function form(Request $request)
    {
        $classId = $request->route('id');
        $class = UsersClass::where('id', $classId)->get()->first();
        $document = null;
        $documentId = $request->route('documentId', null);
        if (!is_null($documentId))
            $document = ClassesDocument::find($documentId);
        return view('dashboard.documents.form', compact('class', 'document'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:60',
            'description' => 'nullable|string|max:1000',
        ]);
        $classId = $request->get('class_id');
        $document = ClassesDocument::create($request->all());
        $files = $request->file('files', []);
        FileController::uploadFiles($files, $document);

        return redirect()->route('dashboard.classes.view', ['id' => $classId])->withInput(['message' => 'با موفقیت انجام شد.']);
    }

    public function viewFiles(Request $request)
    {
        $classId = $request->route('id');
        $documentId = $request->route('documentId');
        $files = File::where('document_id', $documentId)->get();
        if ($request->wantsJson())
            return response()->json(['files' => $files]);

        return 'hello baby';
    }

    public function delete(Request $request)
    {
        $classId = $request->route('id');
        $documentId = $request->route('documentId');

        if (!is_null($documentId)) {
            $document = ClassesDocument::find($documentId);
            if (is_null($document))
                return response()->json(['message' => 'جزوه مورد نظر یافت نشد'],404);
            $filesList = $document->files->pluck('id')->toArray();
            $document->delete();
            FileController::delete($filesList);
            return response()->json(['message' => 'با موفقیت انجام شد.']);
        }
        return response()->json(['message' => 'خطا در پردازش اطلاعات'],403);
    }
}
