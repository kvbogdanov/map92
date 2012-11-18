<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<head>
    <title>�����.</title>
    <meta http-equiv="Content-Type" content="text/html; charset=Windows-1251"/>

    <script src="http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU"
            type="text/javascript"></script>
    <script src="http://yandex.st/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript">
	// �������������
        ymaps.ready(init);

        function init () {
            var myMap = new ymaps.Map('map', {
                    center: [56.01, 92.78],
                    zoom: 7
                }),
                
		myCollection = new ymaps.GeoObjectCollection();

            	$('#search_form').submit(function () {
                var search_query = $('input:first').val();

                ymaps.geocode(search_query, {results: 100}).then(function (res) {
                    myCollection.removeAll();
                    myCollection = res.geoObjects;
                    myMap.geoObjects.add(myCollection);

	// �������� ����������� ������
	myMap.setBounds(myCollection.getBounds());

                });
                return false;

            });

            // �������� ���������� � �� ���������
            myMap.controls
                // ������ ��������� ��������
                .add('zoomControl')
                // ������ ����� �����
                .add('typeSelector')
                // ������ ��������� �������� - ���������� �������
                // ���������� � ������
                .add('smallZoomControl', { right: 5, top: 75 })
                // ����������� ����� ������
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
<h2>�����:</h2>
<form id="search_form">
    <input type="text" value="����������" style="width: 720px;"/>
    <input type="submit" value="�����"/>
</form>
<div id="map" style="width:800px; height:600px"></div>