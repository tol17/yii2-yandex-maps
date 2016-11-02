# Yii2 Yandex Maps Components #

* * *

This repo is the fork of the [yii2-yandex-maps](https://github.com/katzz0/yii2-yandex-maps "yii2-yandex-maps")
by [katzz0](https://github.com/katzz0 "katzz0")

* * *

Add autobounds for multiple objects.
CURLOPT_SSL_VERIFYPEER => false,

## Components ##

- [`katzz0\yandexmaps\Api`](https://github.com/katzz0/yii2-yandex-maps#katzz0yandexmapsapi)
- [`katzz0\yandexmaps\Map`](https://github.com/katzz0/yii2-yandex-maps#katzz0yandexmapsmap)
- [`katzz0\yandexmaps\Canvas`](https://github.com/katzz0/yii2-yandex-maps#katzz0yandexmapscanvas)
- `katzz0\yandexmaps\JavaScript`
- `katzz0\yandexmaps\Placemark`
- `katzz0\yandexmaps\Polyline`

### katzz0\yandexmaps\Api ###

Application components which register scripts.

__Usage__

Attach component to application (e.g. edit config/main.php):
```php
'components' => [
	'yandexMapsApi' => [
		'class' => 'mirocow\yandexmaps\Api',
	]
 ],
```

### katzz0\yandexmaps\Map ###

Map instance.

__Usage__

```php
use katzz0\yandexmaps\Map;

$map = new Map('yandex_map', [
        'center' => [55.7372, 37.6066],
        'zoom' => 10,
        // Enable zoom with mouse scroll
        'behaviors' => array('default', 'scrollZoom'),
        'type' => "yandex#map",
    ],
    [
        // Permit zoom only fro 9 to 11
        'minZoom' => 9,
        'maxZoom' => 11,
        'controls' => [
          "new ymaps.control.SmallZoomControl()",
          "new ymaps.control.TypeSelector(['yandex#map', 'yandex#satellite'])",
        ],
    ]
);
```

### katzz0\yandexmaps\Canvas ###

This is widget which render html tag for your map.

__Usage__

Simple add widget to view:
```php
use katzz0\yandexmaps\Canvas as YandexMaps;

<?= YandexMaps::widget([
    'htmlOptions' => [
        'style' => 'height: 600px;',
    ],
    'map' => new Map('yandex_map', [
        'center' => [55.7372, 37.6066],
        'zoom' => 17,
        'controls' => [Map::CONTROL_ZOOM],
        'behaviors' => [Map::BEHAVIOR_DRAG],
        'type' => "yandex#map",
    ],
    [
        'objects' => [new Placemark(new Point(55.7372, 37.6066), [], [
            'draggable' => true,
            'preset' => 'islands#dotIcon',
            'iconColor' => '#2E9BB9',
            'events' => [
                'dragend' => 'js:function (e) {
                    console.log(e.get(\'target\').geometry.getCoordinates());
                }'
            ]
        ])]
    ])
]) ?>

```

You can use also direct place label:
```php
<?= YandexMaps::widget([
    'htmlOptions' => [
        'style' => 'height: 600px;',
    ],
    'map' => new Map(null, [
        'center' => 'London',
        'zoom' => 17,
        'controls' => [Map::CONTROL_ZOOM],
        'behaviors' => [Map::BEHAVIOR_DRAG],
        'type' => "yandex#map",
    ],
    [
        'objects' => [new Placemark(null, [], [
            'draggable' => true,
            'preset' => 'islands#dotIcon',
            'iconColor' => '#2E9BB9',
            'events' => [
                'dragend' => 'js:function (e) {
                    console.log(e.get(\'target\').geometry.getCoordinates());
                    }'
            ]
        ])]
    ])
]) ?>

```