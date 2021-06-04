<?php

namespace AHT\CustomCheckout\Api;

use Magento\Sales\Model\Order;
use AHT\CustomCheckout\Api\Data\CustomFieldsInterface;

/**
 * Interface CustomFieldsRepositoryInterface
 *
 * @category Api/Interface
 * @package  AHT\CustomCheckout\Api
 */
interface CustomFieldsRepositoryInterface
{
    /**
     * Save checkout custom fields
     *
     * @param int                                                      $cartId       Cart id
     * @param \AHT\CustomCheckout\Api\Data\CustomFieldsInterface $customFields Custom fields
     *
     * @return \AHT\CustomCheckout\Api\Data\CustomFieldsInterface
     */
    public function saveCustomFields(int $cartId, CustomFieldsInterface $customFields): CustomFieldsInterface;

    /**
     * Get checkoug custom fields
     *
     * @param Order $order Order
     *
     * @return CustomFieldsInterface
     */
    public function getCustomFields(Order $order) : CustomFieldsInterface;
}
