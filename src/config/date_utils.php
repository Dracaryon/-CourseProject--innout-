<?php
function getDateAsDateTime($date) {
    return is_string($date) ? new DateTime($date) : $date;
}


function isWeekend($date) {
    $inputDate = getDateAsDateTime($date);
    return $inputDate->format('N') >= 6;
}

function isBefore($date1, $date2) {
    $inputDate1 = getDateAsDateTime($date1);
    $inputDate2 = getDateAsDateTime($date2);

    return $inputDate1 <= $inputDate2;
}

function getNextDay($date) {
    $inputDate = getDateAsDateTime($date);
    $inputDate->modify('+1 day');
    return $inputDate;
}
//criado na aula 281: somar os dois intervalos passados
function sumIntervals($interval1, $interval2) {
    $date = new DateTime('00:00:00');
    $date->add($interval1);
    $date->add($interval2);
    // O resultado da função diff() será um dateInterval. Faremos a diferença da data com as aulas zeradas com a data criada no início da função, com os dois intervalos.
    return(new DateTime('00:00:00'))->diff($date);
}

//criado na aula 281: subtrair os dois intervalos passados
function subtractIntervals($interval1, $interval2) {
    $date = new DateTime('00:00:00');
    $date->add($interval1);
    $date->sub($interval2); //subtrair o intervalo
    return(new DateTime('00:00:00'))->diff($date);
}

//converter o intervalo em uma data. Pode ser DateTime ou DateTimeImmutable (que n pode ser mudado)
function getDateFromInterval($interval) {
    return new DateTimeImmutable($interval->format('%H:%i:%s'));
}

function getDateFromString($str) {
    return DateTimeImmutable::createFromFormat('H:i:s', $str);
}

