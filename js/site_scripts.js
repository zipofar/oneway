$(document).ready(function(){

	var $fotoramaDiv = $("#slider").fotorama({
		nav: false,
		width: '100%',
		height: '408px',
		arrows: false,
		click: false,
		swipe: false
	});

	var fotorama = $fotoramaDiv.data('fotorama');
	$(".content__slider_pag span:first-child").click(function(){
		fotorama.show('<');
	});
	$(".content__slider_pag span:last-child").click(function(){
		fotorama.show('>');
	});

	renderPersonBirthdat("birthday_timestamp");
});

function renderPersonBirthdat(selector) {

	var timestamp_birthday = $("#"+selector).val();
	var date = new Date(timestamp_birthday*1000);
    var options = {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
    };
	var date_str = date.toLocaleString("ru", options).slice(-100, -3);
	var dataBirthday = getDataBirthday(date);
	console.log(dataBirthday.years);

	$("#birthday_str").html(date_str + ", " + dataBirthday.years + " лет");
	$("#birthday_reminder").html("2 месяца и 13 дней до ДР");

}

function getDataBirthday(date) {
	// date = new Date(1986, 1, 1);

	var brth_year = date.getFullYear();
	var curent_year = new Date().getFullYear();

	/*
	Определяем количество лет
	 */
	var dateCurrentBirth = new Date(date.setFullYear(curent_year)); //Дата дня рождения в текущем году
	var years = curent_year - brth_year;

	if( dateCurrentBirth > new Date() ) {
        years = curent_year - brth_year - 1;
	}


	/*
	Определяем количество месяцев
	 */
    var months = "";
    var days = "";
	var tmp = "";

    if( dateCurrentBirth > new Date() ) {

        tmp = new Date(dateCurrentBirth - new Date());
        months = tmp.getMonth();
        days = tmp.getDate();


	} else if( dateCurrentBirth < new Date() ) {

    	dateCurrentBirth.setFullYear(curent_year + 1); //Если день рождения уже прошел, то к дате дня рождения в текущем году прибавим год
        tmp = new Date(dateCurrentBirth - new Date());
        months = tmp.getMonth();
        days = tmp.getDate();

	}

	return {years: years, months: months, days: days};
}
