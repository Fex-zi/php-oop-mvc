<?php 
declare(strict_types=1);

namespace models\find;

class Product {
    private $freeShipping = false;
    
    public function __construct(private float|int $price,
    private float|int $weight){

    }

    function getWeight(){
        return $this->weight;
    }
    
    function setFreeShipping() {
        $this->freeShipping = true;
    }
    
    function getFreeShipping() {
        return $this->freeShipping;
    }


}


$now = new Product(1,2.3);
$prod = (new Product(1,2.3))->getWeight();

var_dump($now);
var_dump('<br> product only ' .$prod);

class Shipping {
    private $totalShipping;
    private $products;
    


    public function __construct( private $pricePerKilogram, private $shippingProvider = '') {

    }
    
    public function addProducts(Product $product) {
        $this->products[] = $product;
    }
    public function calculateTotalShipping() {
        /*
         * ShippingProvider
         * 
         */
        foreach ($this->products as $product) {
            if(!$product->getFreeShipping()){
                $this->totalShipping += $product->getWeight() * $this->pricePerKilogram;
            }

        }
    }
    
    
    
    public function getTotalShippingPrice() {
        return $this->totalShipping;
    }
    
}



// CONTROLLER


$product = new Product(5, 1);
//$product->setFreeShipping();

$pricePerKilogram = 5;

$shipping = new Shipping($pricePerKilogram, 'UPS');

$shipping->addProducts($product);
$shipping->calculateTotalShipping();
$totalShippingPrice = $shipping->getTotalShippingPrice();

var_dump($totalShippingPrice);



