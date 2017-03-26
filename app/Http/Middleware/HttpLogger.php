<?php

namespace App\Http\Middleware;

use Closure;

class HttpLogger
{
    protected $start;
    protected $end;

    public function handle($request, Closure $next)
    {
        $this->start = microtime(true);
        return $next($request);
    }

    public function terminate($request, $response)
    {
        $this->end = microtime(true);
        $this->requestLog($request);
        $this->responseLog($response);
    }

    protected function requestLog($request)
    {
        $duration = $this->end - $this->start;
        $url = $request->fullUrl();
        $method = $request->getMethod();
        $ip = $request->getClientIp();
        $log = "{$ip}: {$method}@{$url} - {$duration}ms";
        \Log::info($log);
    }

    private function responseLog($request)
    {
        \Log::info($request);
    }
}
