<?php

namespace App\Http\Middleware;

use App\Models\ActivityLog;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogAdminActivity
{
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }

    public function terminate(Request $request, $response): void
    {
        if (!auth()->check()) return;

        $methods = ['POST', 'PUT', 'PATCH', 'DELETE'];
        if (!in_array($request->method(), $methods)) return;

        $action = $request->method() === 'DELETE' ? 'delete' : ($request->method() === 'POST' ? 'create' : 'update');

        $route = $request->route();
        $modelType = null;
        $modelId = null;

        if ($route) {
            $params = $route->parameters();
            foreach ($params as $key => $value) {
                if (is_object($value) && method_exists($value, 'getKey')) {
                    $modelType = get_class($value);
                    $modelId = $value->getKey();
                    break;
                }
            }
        }

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'model_type' => $modelType,
            'model_id' => $modelId,
            'description' => $request->method() . ' ' . $request->path(),
            'ip' => $request->ip(),
        ]);
    }
}
