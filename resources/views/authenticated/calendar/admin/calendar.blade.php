@extends('layouts.sidebar')

@section('content')
<div class="w-75 m-auto pt-5">
  <div class="w-85 pt-3 border" style="border-radius:5px; background:#FFF;">
    <div class="p-3 m-auto" style="border-radius:5px;">
    <p>{{ $calendar->getTitle() }}</p>
    <p>{!! $calendar->render() !!}</p>
    </div>
  </div>
</div>
@endsection
