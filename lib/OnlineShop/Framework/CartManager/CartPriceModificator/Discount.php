<?php
/**
 * Pimcore
 *
 * This source file is subject to the GNU General Public License version 3 (GPLv3)
 * For the full copyright and license information, please view the LICENSE.md and gpl-3.0.txt
 * files that are distributed with this source code.
 *
 * @copyright  Copyright (c) 2009-2015 pimcore GmbH (http://www.pimcore.org)
 * @license    http://www.pimcore.org/license     GNU General Public License version 3 (GPLv3)
 */

namespace OnlineShop\Framework\CartManager\CartPriceModificator;

use OnlineShop\Framework\CartManager\ICart;

class Discount implements IDiscount
{
    /**
     * @var float
     */
    protected $amount = 0;

    /**
     * @var null|\OnlineShop\Framework\PricingManager\IRule
     */
    protected $rule = null;


    /**
     * @param \OnlineShop\Framework\PricingManager\IRule $rule
     */
    public function __construct(\OnlineShop\Framework\PricingManager\IRule $rule) {
        $this->rule = $rule;
    }


    /**
     * modificator name
     *
     * @return string
     */
    public function getName()
    {
        if($this->rule) {
            return $this->rule->getName();
        }
        return "discount";
    }

    /**
     * modify price
     *
     * @param \OnlineShop\Framework\PriceSystem\IPrice $currentSubTotal
     * @param ICart  $cart
     *
     * @return \OnlineShop\Framework\PriceSystem\IPrice
     */
    public function modify(\OnlineShop\Framework\PriceSystem\IPrice $currentSubTotal, ICart $cart)
    {
        if($this->getAmount() != 0) {
            return new \OnlineShop\Framework\PriceSystem\ModificatedPrice($this->getAmount(), $currentSubTotal->getCurrency(), false, $this->rule->getLabel());
        }
    }

    /**
     * @param float $amount
     *
     * @return \OnlineShop\Framework\CartManager\CartPriceModificator\IDiscount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }


}