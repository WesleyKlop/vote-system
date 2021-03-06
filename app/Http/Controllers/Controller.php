<?php

namespace App\Http\Controllers;

use App\Models\AppConfig;
use App\VoteSystem\Pages\AbstractPage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Collection;
use Illuminate\View\View;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected Collection $config;

    public function __construct()
    {
        $this->config = AppConfig::dictionary();
        \Illuminate\Support\Facades\View::share([
            'logoUrl' => $this->config->get('logo_url'),
            'primaryColor' => $this->config->get('primary_color'),
            'accentColor' => $this->config->get('accent_color'),
        ]);
    }

    protected function page(AbstractPage $page): View
    {
        return view($page->view(), $page->attributes());
    }
}
