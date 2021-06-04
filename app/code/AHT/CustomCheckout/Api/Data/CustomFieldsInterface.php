<?php

namespace AHT\CustomCheckout\Api\Data;

/**
 * Interface CustomFieldsInterface
 *
 * @category Api/Data/Interface
 * @package  AHT\CustomCheckout\Api\Data
 */
interface CustomFieldsInterface
{
    const DELIVERY_DATE = "delivery_data";
    const DELIVERY_COMMENT = "delivery_comment";

    /**
     * Undocumented function
     *
     * @return string|null
     */
    public function getDeliveryData();

    /**
     * 
     * @param string $string
     * 
     * @return $this
     */ 
    public function setDeliveryData($string);

    /**
     * 
     * @return string|null
     */
    public function getDeliveryComment();

    /**
     * 
     * @param string $string
     * 
     * @return $this
     */
    public function setDeliveryComment($string);
}
