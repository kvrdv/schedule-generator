<?php

fwrite(STDOUT, "Введите год:" . PHP_EOL);
$year = trim(fgets(STDIN));

fwrite(STDOUT, "Введите месяц (с 1 по 12):" . PHP_EOL);
$month = trim(fgets(STDIN));

function getSchedule($year, $month) {
  echo('Рабочее расписание на месяц:' . PHP_EOL);
  $date = new DateTime();
  $daysInMonth  = cal_days_in_month(CAL_GREGORIAN, date($month), date($year));    
  
  $shedule = [];
  $dayOfMonth = 1;
  $date->setDate($year, $month, $dayOfMonth);

  do {
    $date->setDate($year, $month, $dayOfMonth);
    $shedule[$dayOfMonth]['day'] = $date->format('d');
    $shedule[$dayOfMonth]['month'] = $date->format('F');
    $shedule[$dayOfMonth]['year'] = $date->format('Y');
    $shedule[$dayOfMonth]['weekday'] = $date->format('l');

    if (($date->format('l') == 'Saturday') || ($date->format('l') == 'Sunday')) {    
        $shedule[$dayOfMonth]['workday'] = '-';
      } else if (($dayOfMonth > 1) && ($shedule[$dayOfMonth - 1]['workday'] === '+')) {    
        $shedule[$dayOfMonth]['workday'] = '-';
      } else if (($dayOfMonth > 2) && ($shedule[$dayOfMonth - 2]['workday'] === '+')) {
        $shedule[$dayOfMonth]['workday'] = '-';
      } else {
        $shedule[$dayOfMonth]['workday'] = '+';
      }

    echo $shedule[$dayOfMonth]['workday'] . ' ' . $shedule[$dayOfMonth]['weekday'] . ', ' . $shedule[$dayOfMonth]['day'] . ' '  . $shedule[$dayOfMonth]['month'] . ' ' . $shedule[$dayOfMonth]['year'] . PHP_EOL; 
    $dayOfMonth++;    
  } while ($dayOfMonth <= $daysInMonth);

  // print_r($shedule);
  return $shedule;
}

getSchedule($year, $month);