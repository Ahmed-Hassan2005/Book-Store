<?php

require_once __DIR__ . '/../../Controller.php';
require_once __DIR__ . '/../../../../core/Request.php';
require_once __DIR__ . '/../../../../core/Response.php';
require_once __DIR__ . '/../../../models/author/AuthorModel.php';

class AuthorController{
    public static function addAuthor(){
        // header('Content-Type: application/json');
        
        $errors = Request::validate([
            'authorName' => ['required'],
            'authorBio' => ['required'],
        ]);

        if(!empty($errors)){
            Response::json($errors, 'Unprocessable Entity', 422);
        }
        $request = Request::all();
        Response::json(AuthorModel::insertAuthor($request['authorName'], $request['authorBio']));
        
    }
}