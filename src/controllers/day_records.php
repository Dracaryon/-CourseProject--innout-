<html>
<meta charset="utf-8">

</html>
<?php

session_start();
requireValidSession();

loadModel('WorkingHours');

$date = (new DateTime())->getTimestamp();
$today = strftime('%d de %B de %Y');

$user = $_SESSION['user'];
$records = WorkingHours::loadFromUserAndDate($user->id, date('Y-m-d'));



loadTemplateView('day_records', [
    'today' => $today,
    'records' => $records,
    ]);

// Pra testar:
// print_r($records) ;