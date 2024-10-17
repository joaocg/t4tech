<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class VerifyAuthorization
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return JsonResponse|mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (!$request->hasHeader('X-Authorization')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Pega o token no cabeçalho
        $token = $request->header('X-Authorization');
        $configValue = Config::get('app.X_AUTHORIZATION_KEY');

        // Validação do token (aqui você pode implementar a lógica de verificação)
        if ($token !== $configValue) {
            return response()->json(['error' => 'Invalid Token'], 401);
        }

        return $next($request);
    }
}
