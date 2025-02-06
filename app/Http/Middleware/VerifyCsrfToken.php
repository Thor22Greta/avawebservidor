<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * Las rutas que deberían ser ignoradas por la protección CSRF.
     *
     * @var array
     */
    protected $except = [
        '/admin/toggle-status/*',  // Aquí puedes agregar la ruta de tu toggle-status
    ];
}
