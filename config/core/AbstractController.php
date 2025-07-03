<?php

namespace App\Config\Core;

abstract class AbstractController
{
    abstract public function index();

    abstract public function store();

    abstract public function create();


    abstract public function destroy();

    abstract public function show();

    abstract public function edit();

    protected function renderHtml(String $view)
    {
        require_once '../template/layout/partial/header.html.php';
        require_once '../template/' . $view;
    }
}
