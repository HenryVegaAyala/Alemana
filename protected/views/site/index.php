
<center>
    <h1>Bienvenido a Panadería Pastelería Alemana</h1>
</center>
<br>

<?php
$this->widget(
        'booster.widgets.TbCarousel', array(
    'items' => array(
        array(
            'image' => ('images/ms-icon-310x310.png'),
            'label' => 'First Thumbnail label',
            'caption' => 'First Caption.'
        ),
        array(
            'image' => ('images/ms-icon-310x310.png'),
            'label' => 'Second Thumbnail label',
            'caption' => 'Cras justo odio, dapis ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.'
        ),
        array(
            'image' => ('images/ms-icon-310x310.png'),
            'label' => 'Third Thumbnail label',
            'caption' => 'Cras justo odio, dapis ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.'
        ),
    ),
        )
);

echo '<br>';
echo '<br>';