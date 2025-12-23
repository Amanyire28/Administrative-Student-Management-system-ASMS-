<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleSPARequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Check if this is an SPA request (AJAX)
        if ($request->ajax() || $request->header('X-SPA-Request')) {

            // If response is a redirect, convert to JSON for SPA
            if ($response->isRedirect()) {
                return response()->json([
                    'redirect' => $response->getTargetUrl(),
                    'message' => session('success') ?? session('error') ?? null,
                    'type' => session('success') ? 'success' : 'error'
                ]);
            }

            // If response is HTML, add custom headers
            if ($response->headers->get('Content-Type') === 'text/html; charset=UTF-8') {

                // Add page title header
                $title = $this->extractTitle($response->getContent());
                if ($title) {
                    $response->headers->set('X-Page-Title', $title);
                }

                // Add success message header if exists
                if (session('success')) {
                    $response->headers->set('X-Success-Message', session('success'));
                }

                // For SPA requests, we want to return just the content section
                // This is handled by the JavaScript router, but we can help by
                // ensuring the response is a full page with #page-content
            }
        }

        return $response;
    }

    /**
     * Extract page title from HTML content
     */
    private function extractTitle(string $content): ?string
    {
        if (preg_match('/<title>(.*?)<\/title>/i', $content, $matches)) {
            return $matches[1];
        }
        return null;
    }
}
