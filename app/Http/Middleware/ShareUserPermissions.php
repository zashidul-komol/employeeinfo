<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;
use App\Models\RolePermission;
use App\Models\SiteSetting;

class ShareUserPermissions
{
    public function handle($request, Closure $next)
    {
        if ($request->user()) {
            $rolePermissions = RolePermission::select('permission_id')
                ->with(['permission:id,name,parent_id'])
                ->where('role_id', $request->user()->role_id)
                ->get()
                ->toArray();

            $controllerArr = [];
            $allIndexes = [];

            foreach ($rolePermissions as $value) {
                if ($value['permission']['parent_id'] == null) {
                    $controllerArr[$value['permission']['id']] = $value['permission']['name'];
                } else {
                    $allIndexes[] = $controllerArr[$value['permission']['parent_id']] . '@' . $value['permission']['name'];
                }
            }

            View::share('controller_list', $controllerArr);
            View::share('menu_list', $allIndexes);
        }

        $site_settings = SiteSetting::first();
        View::share('site_settings', $site_settings);

        return $next($request);
    }
}
