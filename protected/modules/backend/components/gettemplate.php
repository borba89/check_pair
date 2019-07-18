<?php
$temp = [
    ['title' => 'Some title 1', 'description' => 'Some desc 1', 'content' => 'СРОЧНО!<br /><br />Участок в Чиореску, общей площадью 7 соток. На участке есть дом, общей площадью 60 м2 для проживания. Дом незавершён, и находится на этапе строительства первого этажа. <br /><br />На участке есть все коммуникации.'],
    ['title' => 'Some title 2', 'description' => 'Some desc 2', 'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vehicula est id sem luctus, vitae malesuada arcu imperdiet. Phasellus tempor felis dui, eu gravida ex imperdiet ut. Donec in mi finibus, consectetur dolor ac, finibus felis. Donec ornare metus enim, sed tincidunt nisl sollicitudin nec.']
];
echo json_encode($temp);
?>