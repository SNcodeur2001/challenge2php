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
        ob_start();
         require_once '../template/'. $view;
        $contentForLayout = ob_get_clean();
       
        require_once '../template/layout/base.layout.php';
    }
}
