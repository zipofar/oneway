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
	var dataBirthday = getInfoBirthday(date);

	$("#birthday_str").html(date_str + ", " + dataBirthday.years + " лет");

	var kind_day = getKindOfDay (dataBirthday.days);
	var kind_month = getKindOfMonth (dataBirthday.months);

	if(dataBirthday.days == 0) {
        $("#birthday_reminder").html("СЕГОДНЯ ДР");
	}
	else if(dataBirthday.months == 0) {
        $("#birthday_reminder").html(dataBirthday.days + " " + kind_day + " до ДР");
	}
	else {
        $("#birthday_reminder").html(dataBirthday.months + " " + kind_month + " и " + dataBirthday.days + " " + kind_day + " до ДР");
	}
}

function getKindOfDay (day) {

    var kind_day = "";

	if(day == 1 || day == 21 || day == 31) { kind_day = "день"; }
    else if(day >= 2 && day <= 4) { kind_day = "дня"; }
    else if(day >= 22 && day <= 24) { kind_day = "дня"; }
    else { kind_day = "дней"; }

    return kind_day;
}

function getKindOfMonth (month) {

    var kind_month = "";

    if(month == 1) { kind_month = "месяц"}
    else if(month > 1 && month < 5) { kind_month = "месяца" }
    else if(month > 4) { kind_month = "месяцев"  }

    return kind_month;
}

function getInfoBirthday(date) {

	// date = new Date(1986, 7, 14);

	var brth_year = date.getFullYear();
	var curent_year = new Date().getFullYear();
	var curent_month = new Date().getMonth();
	var curent_date = new Date().getDate();


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

    if( dateCurrentBirth.getDate() == curent_date && dateCurrentBirth.getMonth() == curent_month ) {
        months = 0;
        days = 0;
    }
    else if( dateCurrentBirth > new Date() ) {

        tmp = new Date(dateCurrentBirth - new Date());
        months = tmp.getMonth();
        days = tmp.getDate();
	}
	else if( dateCurrentBirth < new Date() ) {

    	dateCurrentBirth.setFullYear(curent_year + 1); //Если день рождения уже прошел, то к дате дня рождения в текущем году прибавим год
        tmp = new Date(dateCurrentBirth - new Date());
        months = tmp.getMonth();
        days = tmp.getDate();
	}

	return {years: years, months: months, days: days};
}

function setLike(id_photo, id_element) {

	$.ajax({
        type: "POST",
        url: "/test-work/index.php",
        data: "id_photo="+id_photo,
        async: true,
        success: function(msg){
        	console.log(msg);
        	msg = JSON.parse(msg);
        	if(msg.error) { alert(msg.error); return; }
        	console.log(msg);
            var is_like = 0;
            is_like = msg.is_like;
			var count_likes = $("#like-"+id_element+"").next().children("span").text() * 1;
            count_likes = (is_like == 0)? count_likes - 1 : count_likes + 1;
            $("#like-"+id_element+"").next().children("span").text(count_likes);
        },
		error: function () {
			alert("Error: no server connection");
        }
    });

}
