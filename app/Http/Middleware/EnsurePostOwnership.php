<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePostOwnership
{
    public function handle(Request $request, Closure $next): Response
    {
        $post = $request->route('post');

        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('error', 'You must be logged in to perform this action.');
        }

        if ($post && $post->user_id !== auth()->id()) {
            abort(403, 'You can only edit your own posts.');
        }

        return $next($request);
    }
}
