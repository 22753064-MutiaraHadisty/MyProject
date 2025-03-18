<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Tambahkan ini
use App\Models\Dashboard;

class DashboardController extends Controller
{
    public function index()
    {
        // Jika database tidak ada, gunakan data statis
        $dashboards = [
            ['title' => 'Visitors', 'value' => 1294, 'icon' => 'fas fa-users', 'color' => 'primary'],
            ['title' => 'Subscribers', 'value' => 1303, 'icon' => 'fas fa-user-check', 'color' => 'info'],
            ['title' => 'Sales', 'value' => 1345, 'icon' => 'fas fa-chart-pie', 'color' => 'success'],
            ['title' => 'Orders', 'value' => 576, 'icon' => 'far fa-check-circle', 'color' => 'secondary'],
        ];

        return view('backend.dashboard.index', compact('dashboards'));
    }
}
