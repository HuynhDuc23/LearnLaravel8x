<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        return 'Khoi Dong';
        // luon chay dau tien vi co goi den doi tuong DashboardController
        // su dung session delogin
    }
    public function index()
    {
        return '<h2>Dashboard</h2>';
    }
}
