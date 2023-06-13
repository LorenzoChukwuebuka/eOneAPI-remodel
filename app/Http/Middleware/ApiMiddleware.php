<?php

namespace App\Http\Middleware;

use App\Models\ApiKey;
use App\Traits\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiMiddleware
{

    use ApiResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!request('api_id') && !request('api_key')) {
            return $this->fail("No API key found");
        }

        $api = ApiKey::where(['api_id' => request('api_id'), 'status' => 'active'])->first();

        if ($api == null) {
            return $this->fail('No API ID was detected', 404);
        }

        if (!password_verify(request('api_key'), $api->api_key)) {
            return $this->fail('Wrong API key was provided');
        }
        return $next($request);
    }
}
