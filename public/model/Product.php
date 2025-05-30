<?php 
declare(strict_types=1);

namespace model;

class Product {

    
    public function __construct(private float|int $price,
    private float|int $weight){

    }
    public function getWeight(){
        return $this->weight;
    }


}


$now = new Product(1,2.3);
$prod = (new Product(1,2.3))->getWeight();

var_dump($now);
var_dump('<br> product only ' .$prod);