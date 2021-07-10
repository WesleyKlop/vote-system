<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AppConfigUpdateRequest;
use App\Models\AppConfig;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AppConfigController extends Controller
{
    public function index(): View
    {
        $settings = AppConfig::all();

        return view('views.admin.config.index', [
            'settings' => $settings,
        ]);
    }

    public function update(AppConfigUpdateRequest $request): RedirectResponse
    {
        foreach ($request->validated() as $setting => $value) {
            AppConfig::where('name', $setting)->update([
                'value' => $value,
            ]);
        }

        return redirect()->back();
    }
}
