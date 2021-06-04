<?php
namespace AHT\CustomCheckout\Model;

use Magento\Framework\Api\AbstractExtensibleObject;
use AHT\CustomCheckout\Api\Data\CustomFieldsInterface;

class CustomFields extends AbstractExtensibleObject implements CustomFieldsInterface
{
    public function getDeliveryData()
    {
        return $this->_get(self::DELIVERY_DATE);
    }

    public function setDeliveryData($string)
    {
        $this->setData(self::DELIVERY_DATE, $string);
        return $this;
    }

    public function getDeliveryComment()
    {
        return $this->_get(self::DELIVERY_COMMENT);
    }

    public function setDeliveryComment($string)
    {
        $this->setData(self::DELIVERY_COMMENT, $string);
        return $this;
    }
}
