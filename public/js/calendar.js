$(function(){
  $('.js-modal-open').on('click',function(){
		$('.js-modal').fadeIn();
		var setting_reserve = $(this).val(); //$(this) js-modal-openのこと
		var reserve_part = $(this).attr('reserve_part');
		$('.modal-inner-date input').val(setting_reserve);
		$('.modal-inner-time input').val(reserve_part);
		return false;
	});
	$('.js-modal-close').on('click',function(){
		$('.js-modal').fadeOut();
		return false;
	});
});

//テキストは表示されているけど、表示されているのは「2」だけ「リモ2部」
//reservePart_text？
