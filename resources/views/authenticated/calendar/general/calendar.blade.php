@extends('layouts.sidebar')

@section('content')
<div class="vh-100 pt-5 border" style="background:#ECF1F6;">
  <div class="border w-75 m-auto pt-3 " style="border-radius:5px; background:#FFF;">
    <div class="p-3 m-auto" style="border-radius:5px;">

      <p class="text-center">{{ $calendar->getTitle() }}</p>
      <div class="">
        {!! $calendar->render() !!}
      </div>
      <div class="text-right m-auto">
        <input type="submit" class="btn btn-primary" value="予約する" form="reserveParts">
      </div>
    </div>
    <div class="modal js-modal">
      <div class="modal__bg js-modal-close"></div>
      <div class="modal__content">
          <div class="w-100">
            <div class="modal-inner-date w-50 m-auto">
              <p style="display:inline">予定日：</p><input type="text" class="modal_date" value="" name="getDate" form="deleteParts" readonly>
            </div>
            <div class="modal-inner-time w-50 m-auto pt-3 pb-3">
              <p style="display:inline">時間：リモ</p><input type="text" class="modal_part" value="" name="getPart" form="deleteParts" readonly><p style="display:inline;">部</p>
            </div>
            <div class="w-100 cancel_message pt-3 pb-3">
              上記の予約をキャンセルしてもよろしいでしょうか？
            </div>
            <div class="w-50 m-auto edit-modal-btn d-flex">
              <a class="js-modal-close btn btn-primary d-inline-block" href="">閉じる</a>
              <input type="submit" class="btn btn-danger d-block" value="キャンセル" form="deleteParts">
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
