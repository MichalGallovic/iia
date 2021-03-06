<?php


class Meniny {

    private $xml;

    public function __construct($filename = 'meniny.xml') {
        if (!$this->xml = simplexml_load_file($filename)) {
            throw new Exception('Nepodarilo sa načítať XML z lokácie ' . $filename);
        }
    }

    public function all() {
        $result = [];
        foreach($this->xml as $item) {

            array_push($result,
                [
                    'day'       =>  (string)$item->den,
                    'sk_holiday'=>  (string)$item->SKsviatky,
                    'sk_day'    =>  (string)$item->SKdni,
                    'cz_holiday'=>  (string)$item->CZsviatky,
                    "sk"        =>  (string)$item->SK,
                    "sk_many"   =>  (string)$item->SKd,
                    "cz"        =>  (string)$item->CZ,
                    "hu"        =>  (string)$item->HU,
                    "pl"        =>  (string)$item->PL,
                    "at"        =>  (string)$item->AT
                ]
                );
        }
        return $result;
    }

    public function allHolidaysByState($state) {
        $result = [];
        foreach($this->xml as $item) {
            switch(strtolower($state)) {
                case 'sk':
                    $sviatok = $item->SKsviatky;
                    if(!empty($sviatok)) {
                        array_push($result,
                            [
                                'day'               =>  (string)$item->den,
                                'name'  =>  (string)$sviatok
                            ]
                        );
                    }
                    break;
                case 'cz':
                    $sviatok = $item->CZsviatky;
                    if(!empty($sviatok)) {
                        array_push($result,
                            [
                                'day'               =>  (string)$item->den,
                                'name'  =>  (string)$sviatok
                            ]
                        );
                    }
                    break;
            }

        }

        if(!empty($result)) {
            return $result;
        } else {
            throw new Exception('Pre danú krajinu sa záznamy o sviatkoch nenachádzajú.');
        }
    }

    public function allRedLetterDays($state) {
        $result = [];
        foreach($this->xml as $item) {
            switch(strtolower($state)) {
                case 'sk':
                    $pamatny_den = $item->SKdni;
                    if(!empty($pamatny_den)) {
                        array_push($result,
                            [
                                'day'               =>  (string)$item->den,
                                'name'  =>  (string)$pamatny_den
                            ]
                        );
                    }
                    break;
            }

        }

        if(!empty($result)) {
            return $result;
        } else {
            throw new Exception('Pre danú krajinu sa záznamy o pamätných dňoch nenachádzajú.');
        }
    }

    public function findByDate($day, $month) {
        $result = null;
        foreach($this->xml as $item) {
            $date = $item->den;
            $xmlDay = $this->_getDay($date);
            $xmlMonth = $this->_getMonth($date);

            if($day == $xmlDay && $month == $xmlMonth) {
                $result = [
                    "sk"        =>  (string)$item->SK,
                    "sk_many"   =>  (string)$item->SKd,
                    "cz"        =>  (string)$item->CZ,
                    "hu"        =>  (string)$item->HU,
                    "pl"        =>  (string)$item->PL,
                    "at"        =>  (string)$item->AT
                ];
            }
        }

        if(isset($result)) {
            return $result;
        } else {
            throw new Exception("Nesprávny dátum");
        }
    }

    public function findDate($name, $state) {
        $result = null;
        foreach($this->xml as $item) {
            switch(strtolower($state)) {
                case 'sk':
                    $result = $this->_getDayFromNames($item->SKd, $name, $item);
                    break;
                case 'cz':
                    $result = $this->_getDayFromNames($item->CZ, $name, $item);
                    break;
                case 'hu':
                    $result = $this->_getDayFromNames($item->HU, $name, $item);
                    break;
                case 'pl':
                    $result = $this->_getDayFromNames($item->PL, $name, $item);
                    break;
                case 'at':
                    $result = $this->_getDayFromNames($item->AT, $name, $item);
                    break;
            }

            if(isset($result)) break;
        }

        if(isset($result)) {
            return $result;
        } else {
            throw new Exception('Pre kombináciu meno - štát neexistuje záznam.');
        }
    }

    public function findByName($name) {
        $result = [];
        $indexes = ["SKd"=>'sk',"CZ"=>'cz',"HU"=>'hu',"PL"=>'pl',"AT"=>'at'];

        foreach($this->xml as $item) {
            foreach($indexes as $key => $value) {
                $names = str_replace(" ","",$item->{$key});
                $names = explode(",",$names);
                foreach($names as $nameItem) {
                    if(strtolower($nameItem) == strtolower($name)) {
                        array_push($result,
                            [
                                "day"   =>  (string)$item->den,
                                "state"  =>  $value
                            ]
                        );
                    }
                }
            }
        }
        if(!empty($result)) {
            return $result;
        } else {
            throw new Exception('Pre takéto meno, neexistuje záznam.');
        }
    }
    private function _getDayFromNames($subject, $searching, $item) {
        $result = null;
        $names = str_replace(" ","",$subject);
        $names = explode(",",$names);
        foreach($names as $nameItem) {
            if(strtolower($nameItem) == strtolower($searching)) {
                return $result = ['day'=>(string)$item->den];
            }
        }
    }
    private function _getDay($date) {
        return (int)substr($date,2,2);
    }

    private function _getMonth($date) {
        return (int)substr($date,0,2);
    }
} 