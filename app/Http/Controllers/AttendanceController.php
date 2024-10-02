<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Services\AttendanceService;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    protected $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }


    public function top()
    {
        return Inertia::render('Attendance/Top');
    }

    /**
     * 出勤時間を打刻
     */
    public function clockIn()
    {
        $userId = auth()->user()->id;

        // 既に出勤済か確認する
        $existingTimeRecord = $this->attendanceService->checkWorking($userId);

        if($existingTimeRecord) {
            return response()->json(['message' => '出勤打刻済みです。'], 200);
        } else {
            try {
                DB::beginTransaction();

                $this->attendanceService->createStartWorkTime($userId);

                DB::commit();

                return response()->json(['message' => '出勤時間が記録されました。'], 200);
            } catch (\Exception $e) {
                DB::rollBack();
            }
        }
    }

    /**
     * 退勤時間を打刻
     */
    public function clockOut()
    {
        $userId = auth()->user()->id;

        // 既に出勤済か確認する
        $existingTimeRecord = $this->attendanceService->checkWorking($userId);

        if (!$existingTimeRecord) {
            return response()->json(['message' => '出勤記録がありません。'], 400);
        } else {
            try {
                DB::beginTransaction();
                // 退勤時間を保存する
                $timeRecord = $this->attendanceService->insertEndWorkTime($userId, $existingTimeRecord);
                // 労働時間と深夜労働時間を計算する
                $this->attendanceService->calculationWorkTime($timeRecord);

                DB::commit();

                return response()->json(['message' => '退勤時間が記録されました。'], 200);
            } catch (\Exception $e) {
                DB::rollBack();
            }
            
        }
    }
}
