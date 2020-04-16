<?php

class WorkingHours extends Model {
    protected static $tableName = 'working_hours';
    protected static $columns = [
        'id',
        'user_id',
        'work_date',    
        'time1',
        'time2',
        'time3',
        'time4',
        'worked_time',
        ];
        
        
    public static function loadFromUserAndDate($userId, $workDate) {
        $registry = self::getOne(['user_id' => $userId, 'work_date' => $workDate]);

        if(!$registry) {
           $registry = new WorkingHours([
            'user_id' => $userId, 
            'work_date' => $workDate,
            'time1' => null,
            'time2' => null,
            'time3' => null,
            'time4' => null,
            'worked_time' => 0
           ]);
        }

        return $registry;
    }

    public function getNextTime() {
        if(!$this->time1) return 'time1';
        if(!$this->time2) return 'time2';
        if(!$this->time3) return 'time3';
        if(!$this->time4) return 'time4';
        return null;
    }

    public function innout($time) {
        $timeColumn = $this->getNextTime();
        if(!$timeColumn) {
            throw new AppException("Você já fez os 4 batimentos do dia!");  
        }

        $this->$timeColumn = $time;
        if($this->id) {
            $this->update();
        }else {
            $this->insert();
        }
    }
    //282: Quando o usuário já trabalhou|(intervalos):
    function getWorkedInterval(){
        [$t1, $t2, $t3, $t4] = $this->getTimes();

        // Período da manhã (entrada 1 e 2):
        $part1 = new DateInterval('PT0S');
        // Período da tarde (entrada 3 e 4):
        $part2 = new DateInterval('PT0S');

        if($t1) $part1 = $t1->diff(new DateTime());
        if($t2) $part1 = $t1->diff($t2); //Diferença entre o segundo batimento e o primeiro

        if($t3) $part2 = $t3->diff(new DateTime());
        if($t4) $part2 = $t3->diff($t4);


        return sumIntervals($part1, $part2); //O trabalho o dia inteiro. Retorná um date Interval, que é o tipo de objeto que esse metódo retornará.
    }
    // 283. Diferença do almoço
    function getLunchInterval() {
        [, $t2, $t3,] = $this->getTimes();
        $breakInterval = new DateInterval('PT0S');
        
        if($t2) $breakInterval = $t2->diff(new DateTime()); 
        if($t3) $breakInterval = $t3->diff($t2);

        return $breakInterval;
    }


    //282: pegar os times do getNextTime() acima que são strings e transformá-los em DateTime
    private function getTimes() {
        $times = [];

        $this->time1 ? array_push($times, getDateFromString($this->time1)) : array_push($times, null);
        $this->time2 ? array_push($times, getDateFromString($this->time2)) : array_push($times, null); 
        $this->time3 ? array_push($times, getDateFromString($this->time3)) : array_push($times, null); 
        $this->time4 ? array_push($times, getDateFromString($this->time4)) : array_push($times, null); 
 

        return $times;
    }
}