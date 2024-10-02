<?php

namespace App\Services;
use App\Models\Work;
use Carbon\Carbon;
use Illuminate\Support\Str;

// use App\User;

class AttendanceService
{
  /**
   * workテーブルにレコードを作成し労働開始時間を保存する
   */
  public function createStartWorkTime($userId)
  {
    $work = Work::create([
      'id' => Str::Ulid(),
      'user_id' => $userId,
      'start_work_time' => Carbon::now('Asia/Tokyo')->format('Y-m-d H:i:s'),
      'created_account_id' => $userId,
      'created_at' => Carbon::now('Asia/Tokyo')->format('Y-m-d H:i:s'),
      'updated_account_id' => $userId,
      'updated_at' => Carbon::now('Asia/Tokyo')->format('Y-m-d H:i:s'),
    ]);
    dd($work);
  }

  /**
   * 出勤ボタンを既に押しているかチェック
   */
  public function checkWorking($userId)
  {
    $existingTimeRecord = Work::where('user_id', $userId)
      ->whereNull('end_work_time')
      ->first();
    
    return $existingTimeRecord;
  }

  /**
   * 既に出勤済のレコードに労働終了時間を保存する
   */
  public function insertEndWorkTime($userId, $existingTimeRecord)
  {
    if($userId === $existingTimeRecord->user_id) {
      $existingTimeRecord->update([
        'end_work_time' => Carbon::now('Asia/Tokyo')->format('Y-m-d H:i:s'),
        'completed_flg' => true,
      ]);
      return $existingTimeRecord;
    }
  }

  /**
   * 労働時間と深夜労働時間を計算する
   */
  public function calculationWorkTime($timeRecord)
  {
    $startTime = Carbon::parse($timeRecord->start_work_time);
    $endTime = Carbon::parse($timeRecord->end_work_time);
    // 時間単位に変換
    $workingHours = $endTime->diffInMinutes($startTime) / 60;
    // 小数点第一位で切り上げる

    // 深夜労働時間の計算
    $nightWorkingHours = 0;
    $nightStart = Carbon::parse($timeRecord->end_work_time->format('Y-m-d') . ' 22:00:00');
    // 労働終了時間が22時以降であれば深夜時間を保存
    if ($endTime->greaterThan($nightStart)) {
      $nightWorkingHours = $endTime->diffInMinutes($nightStart) / 60;
    }

    $timeRecord->working_hours = $workingHours;
    $timeRecord->night_working_hours = $nightWorkingHours;
    $timeRecord->save();
  }
}