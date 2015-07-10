<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class FileUploadController extends Controller
{

    public function index()
    {
        $user = \App\User::with('files')->findOrFail(\Auth::user()->id);
        return view('welcome', compact('user'));
    }

    public function upload(Request $request)
    {
        /**
         * Request related
         */
        $file = \Request::file('files');
        $userId = \Request::get('userId');

        /**
         * Storage related
         */
        $storagePath = storage_path().'/files/'.$userId;
        $fileName = $file->getClientOriginalName();

        /**
         * Database related
         */
        $fileModel = new \App\File();
        $fileModel->name = $fileName;
        $user = \App\User::find($userId);
        $user->files()->save($fileModel);
        return $file->move($storagePath, $fileName);
    }

    public function destroy($userId, $fileId)
    {
        $file = \App\File::find($fileId);
        $storagePath = storage_path().'/files/'.$userId;
        $file->delete();
        unlink($storagePath.'/'.$file->name);
        return redirect()->back()->with('success', 'Arquivo removido com sucesso!');
    }

    public function download($userId, $fileId)
    {
        $file = \App\File::find($fileId);
        $storagePath = storage_path().'/files/'.$userId;
        return \Response::download($storagePath.'/'.$file->name);

    }
}
