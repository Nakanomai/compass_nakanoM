<?php
namespace App\Calendars\General;

use Carbon\Carbon;
use Auth;

class CalendarView{

  private $carbon;
  function __construct($date){
    $this->carbon = new Carbon($date);
  }

  public function getTitle(){
    return $this->carbon->format('Y年n月');
  }

  function render(){
    $html = [];
    $html[] = '<div class="calendar text-center">';
    $html[] = '<table class="table">';
    $html[] = '<thead>';
    $html[] = '<tr>';
    $html[] = '<th>月</th>';
    $html[] = '<th>火</th>';
    $html[] = '<th>水</th>';
    $html[] = '<th>木</th>';
    $html[] = '<th>金</th>';
    $html[] = '<th>土</th>';
    $html[] = '<th>日</th>';
    $html[] = '</tr>';
    $html[] = '</thead>';
    $html[] = '<tbody>';
    $weeks = $this->getWeeks();
    foreach($weeks as $week){
      $html[] = '<tr class="'.$week->getClassName().'">';

      $days = $week->getDays();
      foreach($days as $day){
        $startDay = $this->carbon->copy()->format("Y-m-01");
        $toDay = $this->carbon->copy()->format("Y-m-d");

        if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
          $html[] = '<td class="past-day calendar-td">';
        }else{
          $html[] = '<td class="calendar-td '.$day->getClassName().'">';
        }
        $html[] = $day->render();

        //予約していたら
        if(in_array($day->everyDay(), $day->authReserveDay())){
          $reservePart = $day->authReserveDate($day->everyDay())->first()->setting_part;
          //もし予約していたら123
          if($reservePart == 1){
            $reservePart = "リモ1部";
            $reservePart_past ="1部参加";
          }else if($reservePart == 2){
            $reservePart = "リモ2部";
            $reservePart_past ="2部参加";
          }else if($reservePart == 3){
            $reservePart = "リモ3部";
            $reservePart_past ="3部参加";
          }
          //さらにボタンの表示有無の分岐
          if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
            // 予約してたら参加状態を表示、過去情報
            $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px">'. $reservePart_past .'</p>';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
          }else{
            // 予約していたら赤いボタンが出る(未来情報)
            $html[] = '<button type="submit" class="btn btn-danger p-0 w-75" name="delete_date" style="font-size:12px" value="'. $day->authReserveDate($day->everyDay())->first()->setting_reserve .'">'. $reservePart .'</button>';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
            $html[] = '<div class="modal js-modal">';
            $html[] = '<div class="modal__bg js-modal-close"></div>';
            $html[] = '<div class="modal__content">';
            $html[] = '<form action="{{ }}" method="post">';
            $html[] = '<div class="w-100">';
            $html[] = '<div class="modal-inner-body w-50 m-auto pt-3 pb-3">';
            $html[] = '<textarea placeholder="投稿内容" name="post_body" class="w-100"></textarea>';
            $html[] = '</div>';
            $html[] = '<div class="w-50 m-auto edit-modal-btn d-flex">';
            $html[] = '<a class="js-modal-close btn btn-danger d-inline-block" href="">閉じる</a>';
            $html[] = '<input type="hidden" class="edit-modal-hidden" name="post_id" value="">';
            $html[] = '<input type="submit" class="btn btn-primary d-block" value="編集">';
            $html[] = '</div>';
            $html[] = '</div>';
            $html[] = '{{ csrf_field() }}';
            $html[] = '</form>';
            $html[] = '</div>';
            $html[] = '</div>';
          }
        }else{
          //予約をしていなかった場合
          //未来か過去か↓
          if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
            //予約していない、過去の情報
            $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px">受付終了</p>';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
          }else{
            //予約していない、未来の情報
          $html[] = $day->selectPart($day->everyDay());
        }
        }
        $html[] = $day->getDate();
        $html[] = '</td>';
      }
      $html[] = '</tr>';
    }
    $html[] = '</tbody>';
    $html[] = '</table>';
    $html[] = '</div>';
    $html[] = '<form action="/reserve/calendar" method="post" id="reserveParts">'.csrf_field().'</form>';
    $html[] = '<form action="/delete/calendar" method="post" id="deleteParts">'.csrf_field().'</form>';

    return implode('', $html);
  }

  protected function getWeeks(){
    $weeks = [];
    //初月
    $firstDay = $this->carbon->copy()->firstOfMonth();
    //月末まで
    $lastDay = $this->carbon->copy()->lastOfMonth();
    //一周目
    $week = new CalendarWeek($firstDay->copy());
    $weeks[] = $week;
    //作業用の日
    $tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();
    //月末までループさせる
    while($tmpDay->lte($lastDay)){
      //週カレンダーViewを作成する
      $week = new CalendarWeek($tmpDay, count($weeks));
      $weeks[] = $week;
      //次の週=+7日する
      $tmpDay->addDay(7);
    }
    return $weeks;
  }
}
