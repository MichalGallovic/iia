<?php
require_once 'API.class.php';
require_once 'Meniny.php';

class MyAPI extends API
{

    public function __construct($request, $origin) {
        parent::__construct($request);

    }

    protected function meniny() {
        $meniny = new Meniny();
        $date = null;
        $name = null;
        $state = null;
        if($this->method == 'GET') {
            $date = $this->args;


            if(!empty($date)) {
                return $meniny->findByDate($date[0], $date[1]);
            } else if(empty($date) && count($this->request) == 1) {
                return $meniny->all();
            } else {
                if(isset($this->request['name'])) {
                    $name = $this->request['name'];
                }
                if(isset($this->request['state'])) {
                    $state = $this->request['state'];
                }


                if(isset($name) && isset($state)) {
                    return $meniny->findDate($name,$state);
                } else if(isset($name) && !isset($state)) {
                    return $meniny->findByName($name);
                }
            }


        }

    }

    protected function sviatky() {
        $meniny = new Meniny();
        $state = null;
        if($this->method == 'GET') {
            $state = $this->request["state"];
            if(isset($state)) {
                return $meniny->allHolidaysByState($state);
            }
        }
    }

    protected function pamatne_dni() {
        $meniny = new Meniny();
        $state = null;
        if($this->method == 'GET') {
            $state = $this->request["state"];
            if(isset($state)) {
                return $meniny->allRedLetterDays($state);
            }
        }
    }
}