<?php

namespace App\Http\Controllers;

use App\VoteSystem\Pages\AbstractPage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function page(AbstractPage $page)
    {
        return view($page->view(), $page->attributes());
    }
}
