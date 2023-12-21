<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Delivery extends Controller
{
    private $weight, $cost, $volume=[];

        public function setWeight($weight)
        {
            $this->weight= $weight*50;
            return $this;
        }

        public function getWeight()
        {

            return $this->weight;
        }

    public function setCost($cost)
    {
        $this->cost=$cost;
        return $this;
    }

    public function getCost()
    {
        return $this->cost;
    }

    public function setVolume(...$volume)
    {
        $volume=(array_product($volume)/1000)*50;
        $this->volume=$volume;
        return $this;
    }
    public function getVolume()

    {
        return $this->volume;
    }
    public function calculation()
    {

        $this->setWeight(1)->setVolume(10,10,10)->setCost(50);

        //Дальше у нас проверка того
/*        if (($this->weight > $this->volume) && ($this->weight > $this->cost)) {
            return  round(($this->getWeight()),2);
        }
        elseif (($this->volume > $this->weight) && ($this->volume > $this->cost)){
            return   round(($this->getVolume()),2);

        } elseif (($this->cost > $this->weight) && ($this->cost > $this->volume)){
         return $this->getCost();
        }
        else{
            return $this->getCost();
        }*/
        echo "Стоимость доставки ";
        return max($this->getWeight(),$this->getVolume(),$this->getCost());


    }

}
