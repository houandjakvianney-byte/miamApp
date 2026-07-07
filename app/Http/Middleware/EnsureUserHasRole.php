<?php

namespace App\Http\Middleware;

use App\Enums\RoleUtilisateur;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Utilisation dans routes/web.php :
     * ->middleware('role:admin')
     * ->middleware('role:admin,livreur')
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $utilisateur = $request->user();

        if (! $utilisateur) {
            return redirect()->route('login');
        }

        $rolesAutorises = array_map(fn (string $role) => RoleUtilisateur::from($role), $roles);

        if (! in_array($utilisateur->role, $rolesAutorises, true)) {
            abort(403, "Vous n'avez pas accès à cette page.");
        }

        return $next($request);
    }
}
