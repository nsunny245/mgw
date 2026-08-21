<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnforceSeoNormalsMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $path = $request->server('REQUEST_URI') ?: $request->getRequestUri();

        // 1. Skip Filament admin routes to preserve dashboard operations
        if (str_starts_with($request->path(), 'admin') || str_starts_with($request->path(), 'filament')) {
            return $next($request);
        }

        // 2. Check for active database redirects
        $requestPath = '/' . ltrim($request->getPathInfo(), '/');
        $redirect = \App\Models\SeoRedirect::where('source_path', $requestPath)
            ->where('is_active', true)
            ->first();

        if ($redirect) {
            $redirect->increment('hit_count');
            $redirect->update(['last_hit_at' => now()]);
            return redirect()->to($redirect->destination_url, $redirect->status_code);
        }

        // 3. Redirect legacy /index.php paths to clean paths
        if (str_contains($path, '/index.php')) {
            $cleanPath = str_replace('/index.php', '', $path) ?: '/';
            return redirect()->to($this->getCanonicalTargetUrl($request, $cleanPath), 301);
        }

        // 4. Redirect trailing slash variants (unless it is the homepage root)
        $pathOnly = parse_url($path, PHP_URL_PATH);
        if ($pathOnly !== '/' && str_ends_with($pathOnly, '/')) {
            $cleanPath = rtrim($pathOnly, '/');
            $query = parse_url($path, PHP_URL_QUERY);
            if ($query) {
                $cleanPath .= '?' . $query;
            }
            return redirect()->to($this->getCanonicalTargetUrl($request, $cleanPath), 301);
        }

        // 5. Force preferred host (www.makkahgateway.co.uk) and HTTPS on production
        $host = $request->getHost();
        $isSecure = $request->secure();
        $isLocal = in_array($host, ['localhost', '127.0.0.1']);

        if (!$isLocal) {
            $preferredHost = 'www.makkahgateway.co.uk';
            if ($host !== $preferredHost || !$isSecure) {
                return redirect()->to('https://' . $preferredHost . $path, 301);
            }
        }

        // Set canonical URL dynamically for the request
        $canonicalService = app(\App\Services\Seo\CanonicalUrlService::class);
        \Artesaos\SEOTools\Facades\SEOTools::setCanonical($canonicalService->forCurrentRequest());

        \Artesaos\SEOTools\Facades\SEOTools::metatags()->addMeta('robots', 'index,follow');

        return $next($request);
    }

    /**
     * Build the target redirect URL using the request configuration.
     */
    protected function getCanonicalTargetUrl(Request $request, string $path): string
    {
        $host = $request->getHost();
        $scheme = $request->secure() ? 'https://' : 'http://';
        
        if (!in_array($host, ['localhost', '127.0.0.1'])) {
            $host = 'www.makkahgateway.co.uk';
            $scheme = 'https://';
        }

        return $scheme . $host . $path;
    }
}
