<?php
namespace AHT\Salesagent\Api\Data;

interface SalesAgentInterface extends \Magento\Framework\Api\CustomAttributesDataInterface
{
    /**#@+
     * Constants defined for keys of  data array
     */
    const ENTITY_ID = 'entity_id';

    const ORDER_ID = 'order_id';

    const ORDER_ITEM_ID = 'order_item_id';

    const ORDER_ITEM_SKU = 'order_item_sku';

    const ORDER_ITEM_PRICE = 'order_item_price';

    const COMMISSION_TYPE = 'commission_type';

    const COMMISSION_VALUE = 'commission_value';

    const ATTRIBUTES = [
        self::ENTITY_ID,
        self::ORDER_ID,
        self::ORDER_ITEM_ID,
        self::ORDER_ITEM_SKU,
        self::ORDER_ITEM_PRICE,
        self::COMMISSION_TYPE,
        self::COMMISSION_VALUE
    ];
    /**#@-*/

    /**
     * entity id
     *
     * @return int|null
     */
    public function getEntityId();

    /**
     * entity id
     *
     * @param int $id
     * @return $this
     */
    public function setEntityId($id);

    /**
     * order id
     *
     * @return int|null
     */
    public function getOrderId();

    /**
     * order id
     *
     * @param int $id
     * @return $this
     */
    public function setOrderId($id);

    /**
     * order item id
     *
     * @return int|null
     */
    public function getOrderItemId();

    /**
     * order item id
     *
     * @param int $id
     * @return $this
     */
    public function setOrderItemId($id);

    /**
     * OrderItem sku
     *
     * @return string
     */
     public function getOrderItemSku();

     /**
      * OrderItem sku
      *
      * @param string $sku
      * @return $this
      */
     public function setOrderItemSku($sku);

     /**
     * OrderItem price
     *
     * @return float|null
     */
    public function getOrderItemPrice();

    /**
     * OrderItem price
     *
     * @param float $price
     * @return $this
     */
    public function setOrderItemPrice($price);

    /**
     * commission type
     *
     * @return int|null
     */
    public function getCommissionType();

    /**
     * commission type
     *
     * @param int $i
     * @return $this
     */
    public function setCommissionType($i);

    /**
     * commission value
     *
     * @return float|null
     */
    public function getCommissionValue();

    /**
     * commission value
     *
     * @param float $i
     * @return $this
     */
    public function setCommissionValue($i);
}
