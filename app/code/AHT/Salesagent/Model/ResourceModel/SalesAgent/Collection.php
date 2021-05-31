<?php
namespace AHT\Salesagent\Model\ResourceModel\SalesAgent;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    protected $_eventPrefix = 'aht_salesagent_salesagent_collection';
    protected $_eventObject = 'salesagent_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('AHT\Salesagent\Model\SalesAgent', 'AHT\Salesagent\Model\ResourceModel\SalesAgent');
    }
}
