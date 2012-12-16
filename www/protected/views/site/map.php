<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<head>
    <title>Карта.</title>
    <meta http-equiv="Content-Type" content="text/html; charset=Windows-1251"/>

    <script src="http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU"
            type="text/javascript"></script>
    <script src="http://yandex.st/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript">
	// Инициализация
        ymaps.ready(init);

        function init () {
            var myMap = new ymaps.Map('map', {
                    center: [56.01, 92.78],
                    zoom: 7
                }),
                
		myCollection = new ymaps.GeoObjectCollection();
		//Функция поиска по населенным пунктам
            	$('#search_form').submit(function () {
                var search_query = $('input:first').val();

                ymaps.geocode(search_query, {results: 100}).then(function (res) {
                    myCollection.removeAll();
                    myCollection = res.geoObjects;
                    myMap.geoObjects.add(myCollection);

	// Просмотр результатов поиска
	myMap.setBounds(myCollection.getBounds());

                });
                return false;
            });

	//Создание балуна по клику
	myMap.events.add('click', function (e) {
        if (!myMap.balloon.isOpen()) {
            var coords = e.get('coordPosition');
                myMap.balloon.open(coords, {
                    contentHeader: 'Ввод',
                    contentBody: '<p>Введите стоимость бензина:</p>' +
                    '<p>Координаты щелчка: ' + [
                        coords[0].toPrecision(4),
                        coords[1].toPrecision(4)
                    ].join(', ')+ 
	                '<div id="menu">\
                    <div id="menu_list">\
                    <label>Стоимость:</label> <input type="text" class="input-medium" name="icon_text" /><br />\
		            </div>\
                    <button type="submit" class="btn btn-success">Сохранить</button>\
                    </div>' + 
		            '</p>',
                    contentFooter: '<sup>Чтобы закрыть щелкните еще раз</sup>'
                });

	var myPlacemark = new ymaps.Placemark(coords);
	//Сохраняем данные из формы		
	$('#menu button[type="submit"]').click(function () {
        var iconText = $('input[name="icon_text"]').val();
    		//Добавляем метку на карту	
	       	myMap.geoObjects.add(myPlacemark);
		  //Изменяем свойства метки и балуна
            myPlacemark.properties.set({
                iconContent: iconText
            });
            //Закрываем балун
            myMap.balloon.close();
        });		 
            } else {
                myMap.balloon.close();
            }
        });
//---------
    // Передадим в переменную JS массив координат из PHP
    var coords = <?php 
    for($i=0; $i<count($pnt); $i++){
        // Избавимся от лишних скобок
        $arr[]=str_replace(array(")","("),array('',''),$pnt[$i]->coordinate);
    }
        echo json_encode($arr);
        ?>;
    // Передадим в переменную JS массив стоимостей из PHP
    var cost = <?php 
    for($i=0; $i<count($inf); $i++){
        $arr1[]= $inf[$i]->cost;
    }
        echo json_encode($arr1);
        ?>;
    // Отобразим точки и стоимости на карте
    for(var i=0; i<coords.length; i++) {
        // Так как json возвращает строку, необходимо разбить ее на координаты x и y
        var tmp = coords[i].split(",");
        var myBdPlacemark = new ymaps.Placemark(tmp);
        myMap.geoObjects.add(myBdPlacemark);
        myBdPlacemark.properties.set({
            iconContent: cost[i]
        });
    };      
    // Элементы управления и их параметры
    myMap.controls
    // Кнопка изменения масштаба
    .add('zoomControl')
    // Список типов карты
    .add('typeSelector')
    // Кнопка изменения масштаба - компактный вариант
    // Расположим её справа
    .add('smallZoomControl', { right: 5, top: 75 })
    // Стандартный набор кнопок
    .add('mapTools');

    myMap.controls
    .add(new ymaps.control.ScaleLine())
    .add(new ymaps.control.MiniMap({
        type: 'yandex#publicMap'
    }));
    }
    </script>
</head>

<body>
<h2>Карта:</h2>
<form id="search_form">
    <input type="text" value="Красноярск" style="width: 720px;"/>
    <input type="submit" value="Найти"/>
</form>
<div id="map" style="width:800px; height:600px"></div>