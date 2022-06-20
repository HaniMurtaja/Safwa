<?php

namespace App\Components\Contracts;

interface Gate
{
    public function check($resources, $arguments = []);
    public function authorize($resource, $arguments = []);
}