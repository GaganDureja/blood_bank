<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\All_blood;


class SendBloodRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role === 'receiver') {
            $id = $request->route('blood_id');
            $bloodGroup = All_blood::find($id);
            if (Auth::user()->blood_group === $bloodGroup->blood_group) {
                return $next($request);
            }
        }
        abort(403, 'Unauthorized action.');
    }
}
