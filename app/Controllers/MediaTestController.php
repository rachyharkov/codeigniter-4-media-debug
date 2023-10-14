<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;
use App\Models\UsersDocument;

class MediaTestController extends BaseController
{
    public function create()
    {
        $data = $this->request->getVar();

        $model = new UsersDocument();

        if (!$model->insert($data)) {
            dd($model->errors());
        }

        if($this->request->getFile('media')->isValid()) {
            $model->addMediaFromRequest('media')->toMediaCollection('users_document_media');

            return redirect()->to(base_url())->with('upload_success', 'Document created successfully');
        }

        dd('you must upload a file');
    }

    public function show(string $id) // $id is only dummy for accessing the route
    {
        $model = new UsersDocument();

        $document_id = $this->request->getGet('document_id'); //this is the real id

        $data = [
            'documents' => $model->findAll(),
            'selected_document' => $model->find($document_id),
            'media' => $model->mediaOf('users_document_media', $document_id)->getFirstMedia()
        ];

        return view('index', $data);
    }

    public function delete(string $id)
    {
        $model = new UsersDocument();

        $document_id = $this->request->getPost('document_id'); //this is the real id
        // dd($document_id);
        $model->delete(['id' => $document_id]);
        $model->clearMediaCollection('users_document_media', $document_id);

        return redirect()->to(base_url())->with('delete_success', 'Document deleted successfully');
    }    
}
