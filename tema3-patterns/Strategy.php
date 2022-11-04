<?php 
namespace App;

class carCuopon
{
    private $carCouponGenerator;

    /**
     * Usually, the Context accepts a strategy through the constructor, but also
     * provides a setter to change it at runtime.
     */
    public function __construct(carCouponGenerator $carCouponGenerator)
    {
        $this->carCouponGenerator = $carCouponGenerator;
    }

    public function setStrategy(carCouponGenerator $carCouponGenerator)
    {
        $this->carCouponGenerator = $carCouponGenerator;
    }

    public function calculateCoupon()
    {
        $this->carCouponGenerator->addSeasonDiscount();
        $this->carCouponGenerator->addStockDiscount();
        $discount = $this->carCouponGenerator->getDiscount();
        return "Get {$discount}% off the price of your new car.";

    }
}

interface carCouponGenerator
{
    public function addSeasonDiscount();
    public function addStockDiscount();
    public function getDiscount();
}

class bmwCuoponGenerator implements carCouponGenerator 
{
    private $discount = 0;
    private $isHighSeason = false;
    private $bigStock = true;

    public function addSeasonDiscount()
    {
        if (!$this->isHighSeason) { $this->discount += 5; }
    }
    public function addStockDiscount()
    {
        if ($this->bigStock) { $this->discount += 7; }
    }

    public function getDiscount()
    {
        return $this->discount;
    }
}

class mercedesCuoponGenerator implements carCouponGenerator 
{
    private $discount = 0;
    private $isHighSeason = false;
    private $bigStock = true;

    public function addSeasonDiscount()
    {
        if (!$this->isHighSeason) { $this->discount += 4; }
    }
    public function addStockDiscount()
    {
        if ($this->bigStock) { $this->discount += 10; }
    }
    public function getDiscount()
    {
        return $this->discount;
    }
}

$carCuopon = new carCuopon(new bmwCuoponGenerator());
echo $carCuopon->calculateCoupon();
echo "<br>";
$carCuopon->setStrategy(new mercedesCuoponGenerator());
echo $carCuopon->calculateCoupon();
