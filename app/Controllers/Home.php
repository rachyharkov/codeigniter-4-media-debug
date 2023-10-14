<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\UsersDocument;

class Home extends BaseController
{
    public function index(): string
    {
        $document_model = new UsersDocument();

        $data = [
            'documents' => $document_model->findAll()
        ];

        return view('index', $data);
    }
}
