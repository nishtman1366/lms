<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileController extends Controller
{
    public static function uploadFiles(array $files, $document)
    {
        foreach ($files as $file) {
            $fileName = str_replace(' ', '_', $file->getClientOriginalName());
            $file->storeAs('documents/'.$document->id, $fileName, 'public');
            File::create(
                [
                    'document_id' => $document->id,
                    'name' => $fileName,
                    'size' => $file->getSize()
                ]
            );
        }
    }

    public function download(Request $request)
    {
        $fileId = $request->route('id');
        $file = File::find($fileId);
        //TODO add download statictics to system
//        $file->increment('download_count');
        return redirect()->to($file->url);
    }

    public static function delete(array $filesList)
    {
        foreach ($filesList as $item) {
            $file = File::where('id', $item)->get()->first();
            if (is_null($file)) continue;
            $documentId = $file->document_id;
            Storage::disk('public')->delete('documents/' . $documentId . '/' . $file->name);
            $file->delete();
        }
    }
}
