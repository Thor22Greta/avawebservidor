<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->middleware('auth'); // Asegura que los usuarios estén autenticados antes de acceder a estas acciones
    }
}