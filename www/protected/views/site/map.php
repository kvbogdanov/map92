<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<head>
    <title>�����.</title>
    <meta http-equiv="Content-Type" content="text/html; charset=Windows-1251"/>

    <script src="http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU"
            type="text/javascript"></script>
    <script type="text/javascript">
	// �������������
        ymaps.ready(init);

        function init () {
            var myMap = new ymaps.Map('map', {
                    center: [56.01, 92.78],
                    zoom: 9
                });

            // �������� ���������� � ��� ���������.
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

<div id="map" style="width:800px; height:600px"></div>