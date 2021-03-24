<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __construct(
    ) {
        parent::__construct();
    }

    public function index(): View
    {
    }
}
