<?php

//Controller temporário!

loadModel('WorkingHours');

$wh = WorkingHours::loadFromUserAndDate(1, date('Y-m-d'));
echo '<br><br>';

$workedIntervalString = $wh->getWorkedinterval()->format('%H:%I:%S');
print_r($workedIntervalString);
echo '<br><br>';

$lunchIntervalString = $wh->getLunchInterval()->format('%H:%I:%S');
print_r($lunchIntervalString);
echo '<br><br>';


// Aula 282:
// [$t1, $t2, $t3, $t4] = $wh->getTimes();
// print_r($t2);
// echo '<br><br>';
// print_r($t3);
// echo '<br><br>';
// print_r($t1);
// echo '<br><br>';
// print_r($t4);

// Aula 281: A partir do date string, vai ser criado um date interval
// $il = DateInterval::createFromDateString('9 hours');
// $i2 = DateInterval::createFromDateString('6 hours');


// $r1 = sumIntervals($il, $i2);
// $r2 = subtractIntervals($il, $i2);

// print_r($r1);
// echo '<br><br>';
// print_r($r2);
// echo '<br><br>';
// print_r(getDateFromInterval($r1));
// echo '<br><br>';
// print_r(getDateFromInterval($r2));



