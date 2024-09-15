<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Services\AttendanceService;

class AttendanceController extends Controller
{
    protected $AttendanceService;

    public function __construct(AttendanceService $userService)
    {
        $this->AttendanceService = $userService;
    }


    public function top()
    {
        return Inertia::render('Attendance/Top');
    }
}
