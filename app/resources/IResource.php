<?php

namespace App\Resources;

interface IResource
{
    public function addAction();
    public function listAction();
    public function getAction($_identifier);
    public function updateAction($_identifier);
    public function deleteAction($_identifier);
}
