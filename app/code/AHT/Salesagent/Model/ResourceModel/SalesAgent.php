<?php
namespace AHT\Salesagent\Model\ResourceModel;

class SalesAgent extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    )
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('aht_salesagent_salesagent', 'entity_id');
    }
}
