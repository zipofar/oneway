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
	var amount_years = getAmountYears(date);
	console.log(amount_years);

	$("#birthday_str").html(date_str + ", " + amount_years + " лет");
	$("#birthday_reminder").html(timestamp_birthday);

}

function getRemainBirthday(date) {

	// date = new Date(1986, 1, 20);
    // date.setFullYear(new Date().getFullYear())


    // return months;
}

function getAmountYears(date) {
	date = new Date(1986, 1, 10);
	var brth_year = date.getFullYear();
	var brth_month = date.getMonth();
	var brth_day = date.getDate();

	var curent_year = new Date().getFullYear();
	var curent_month = new Date().getMonth();
	var curent_day = new Date().getDate();

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

    if( dateCurrentBirth > new Date() ) {

        months = brth_month - curent_month;
        days = brth_day - curent_day;

        if( new Date(new Date().setMonth(brth_month)) > dateCurrentBirth ) {
            months = brth_month - curent_month - 1;
            days = curent_day - brth_day;
        }

	} else if( dateCurrentBirth < new Date() ) {

    	months = 11 - curent_month + brth_month;
        days = brth_day - curent_day;
	}



	return months;
}
