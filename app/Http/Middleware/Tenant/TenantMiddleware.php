<?php

namespace App\Http\Middleware\Tenant;

use App\Models\Company;
use App\Tenant\ManagerTenant;
use Closure;
use Illuminate\Http\Request;

class TenantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {



        $manager = app(ManagerTenant::class);


        if ($manager->domainIsMain()) {
            return $next($request);
        }

        $company = $this->getCompany($request->getHost());

        if (!$company) {
            abort(401, 'Acesso não permitido!');
        } else if ($request->url()) {
            $manager->setConnection($company);
        }

        return $next($request);
    }

    public function getCompany($host)
    {
        return Company::where('domain', $host)->first();
    }
}
