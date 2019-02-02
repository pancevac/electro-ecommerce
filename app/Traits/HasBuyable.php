<?php
/**
 * Created by PhpStorm.
 * User: Sile
 * Date: 1/31/2019
 * Time: 11:46 PM
 */

namespace App\Traits;


trait HasBuyable
{
    /**
     * Get the identifier of the Buyable item.
     *
     * @return int|string
     */
    public function getBuyableIdentifier($options = null)
    {
        return $this->id;
    }

    /**
     * Get the description or title of the Buyable item.
     *
     * @return string
     */
    public function getBuyableDescription($options = null)
    {
        return $this->name;
    }

    /**
     * Get the price of the Buyable item.
     *
     * @return float
     */
    public function getBuyablePrice($options = null)
    {
        return $this->discountedPrice; // This will return discounted price or original price
    }
}