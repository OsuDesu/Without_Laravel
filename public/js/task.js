(function($) {
	$('#save').click(function(){
		var name = $('#name').val();
		var surname = $('#surname').val();
		var age = $('#age').val();

		if(!name.trim() || !surname.trim() || !age.trim()){
			alert('Не заполненно одно из полей!');
			return;
		}

		if($.isNumeric(name) || $.isNumeric(surname)){
			alert('Имя и фамилия должны состоять не из цифр!');
			return;
		}

		if(!$.isNumeric(age)){
			alert('Возраст должен быть указан в цифрах!');
			return;
		}

		if($.isNumeric(age) && age > 256){
			alert('Не реальный возраст! Кстати, самый долгоживущий человек прожил 256 лет');
			return;
		}

		ajax_post('save', [name, surname, age], function callback(data) {
			if(data['y'] != undefined) alert(data['y'])
			else alert(data['n']);
		});
	});

	$('#upload').click(function(){
		ajax_post('upload', null, function(data){
			alert(data);
		})
	});

	function ajax_post(key, data, callback)
	{
		var post_data = {}
		post_data[key] = data;

		$.ajax({
			type: 'POST',
			url: key,
			data: post_data,
			dataType: 'json',
			success: callback
		});
	}
})(jQuery);