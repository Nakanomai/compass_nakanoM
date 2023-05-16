@extends('layouts.sidebar')
@section('content')
<div class="pt-5 border" style="background:#ECF1F6;">
  <div class="border w-75 m-auto pt-3" style="border-radius:5px; background:#FFF;">
    <div class="p-3 m-auto" style="border-radius:5px;">
    {!! $calendar->render() !!}
    <div class="adjust-table-btn m-auto text-right">
      <input type="submit" class="btn btn-primary" value="登録" form="reserveSetting" onclick="return confirm('登録してよろしいですか？')">
    </div>
    </div>
  </div>
</div>

<!-- <div class="w-75 m-auto d-flex pt-5" style="align-items:center; justify-content:center;">
  <div class="w-100 m-auto pt-3 border" style="border-radius:5px; background:#FFF;">
    <div class="p-3 m-auto" style="border-radius:5px;">
    {!! $calendar->render() !!}
    <div class="adjust-table-btn m-auto text-right">
      <input type="submit" class="btn btn-primary" value="登録" form="reserveSetting" onclick="return confirm('登録してよろしいですか？')">
    </div>
    </div>
  </div>
</div> -->
@endsection
