<?php
namespace AHT\CustomCheckout\Observer;

use AHT\CustomCheckout\Api\Data\CustomFieldsInterface;

class Observer implements \Magento\Framework\Event\ObserverInterface
{

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $quote = $observer->getEvent()->getQuote();

        $order->setData(
            CustomFieldsInterface::DELIVERY_DATE,
            $quote->getData(CustomFieldsInterface::DELIVERY_DATE)
        );

        $order->setData(
            CustomFieldsInterface::DELIVERY_COMMENT,
            $quote->getData(CustomFieldsInterface::DELIVERY_COMMENT)
        );
     
    }
}