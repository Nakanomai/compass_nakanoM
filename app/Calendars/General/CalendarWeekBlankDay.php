<?php
namespace App\Calendars\General;

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

   function selectPart($ymd){
     return '';
   }

   function getDate(){
     return '';
   }

   function cancelBtn(){
     return '';
   }

   function everyDay(){
     return '';
   }

}
