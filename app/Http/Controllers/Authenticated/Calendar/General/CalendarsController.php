<?php

namespace App\Http\Controllers\Authenticated\Calendar\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Calendars\General\CalendarView;
use App\Models\Calendars\ReserveSettings;
use App\Models\Calendars\Calendar;
use App\Models\USers\User;
use Auth;
use DB;

class CalendarsController extends Controller
{
    public function show(){
        $calendar = new CalendarView(time());
        return view('authenticated.calendar.general.calendar', compact('calendar'));
    }

    public function reserve(Request $request){
        DB::beginTransaction();
        try{
            $getPart = $request->getPart;
            $getDate = $request->getData;
            $reserveDays = array_filter(array_combine($getDate, $getPart));
            foreach($reserveDays as $key => $value){ //特殊な連想配列のキーの取得
                $reserve_settings = ReserveSettings::where('setting_reserve', $key)->where('setting_part', $value)->first();
                $reserve_settings->decrement('limit_users');//限度の人数を減らす処理
                $reserve_settings->users()->attach(Auth::id());
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }
        return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
    }

    public function delete(Request $request){
      DB::beginTransaction();
      try{
        dd($request);
          $getPart = $request->getPart;
          $getDate = $request->getDate;
              $reserve_settings = ReserveSettings::where('setting_reserve', $key)->where('setting_part', $value)->first();
              $reserve_settings->increment('limit_users');//限度の人数を増やす処理
              $reserve_settings->users()->detach(Auth::id());
    DB::commit();
}catch(\Exception $e){
    DB::rollback();
}
return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
}
}
