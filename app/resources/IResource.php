<?php

namespace App\Resources;

/**
 * Interface IResource
 *
 * Define the default structure of a resource
 *
 */
interface IResource
{
    public function addAction();
    public function listAction();
    public function getAction($_identifier);
    public function updateAction($_identifier);
    public function deleteAction($_identifier);
}
