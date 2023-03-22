<?php
namespace App\Calendars\Admin;

class CalendarWeekBlankDay extends CalendarWeekDay{

  function getClassName(){
    return "day-blank";
  }

  /**
   * @return 余白を出力するためのクラス
   */

  function render(){
    return '';
  }

  function everyDay(){
    return '';
  }

  function dayPartCounts($ymd = null){
    return '';
  }

  function dayNumberAdjustment(){
    return '';
  }
}
