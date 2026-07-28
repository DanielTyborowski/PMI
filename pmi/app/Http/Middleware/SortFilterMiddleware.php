<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class SortFilterMiddleware
{
    private array $sortedBy = ['id', 'created_at', 'updated_at'];
    private array $orders = ['asc', 'desc'];
    private array $filters = ['todo', 'done'];


    public function handle(Request $request, Closure $next): Response
    {
        // Whitelist prüfen und Standardwerte setzen
        if (!in_array($request->get('sort'), $this->sortedBy)) {
            $request->merge(['sort' => 'id']);
        }

        if (!in_array($request->get('order'), $this->orders)) {
            $request->merge(['order' => 'desc']);
        }

        if (!in_array($request->get('filter'), $this->filters)) {
            $request->merge(['filter' => null]);
        } else {
            $request->request->remove('filter'); // komplett entfernen
        }

        return $next($request);
    }
}
