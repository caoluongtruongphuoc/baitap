<?php

namespace AHT\CustomCheckout\Api;

use Magento\Sales\Model\Order;
use AHT\CustomCheckout\Api\Data\CustomFieldsInterface;

/**
 * Interface CustomFieldsGuestRepositoryInterface
 *
 * @category Api/Interface
 * @package  AHT\CustomCheckout\Api
 */
interface CustomFieldsGuestRepositoryInterface
{
    /**
     * Save checkout custom fields
     *
     * @param string                                                   $cartId       Guest Cart id
     * @param \AHT\CustomCheckout\Api\Data\CustomFieldsInterface $customFields Custom fields
     *
     * @return \AHT\CustomCheckout\Api\Data\CustomFieldsInterface
     */
    public function saveCustomFields(string $cartId, CustomFieldsInterface $customFields): CustomFieldsInterface;
}
