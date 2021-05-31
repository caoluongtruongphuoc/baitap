<?php
namespace AHT\Salesagent\Model\Source;

use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory;

class SalesAgentSelect extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    protected $_customerCollectionFactory;

    public function __construct(CollectionFactory $customerCollectionFactory)
    {
        $this->_customerCollectionFactory = $customerCollectionFactory;
    }

    public function getAllOptions() {
        $this->_options = $this->getAllSalesAgent();
        return $this->_options;
    }

    public function getAllSalesAgent() 
    {
        $collection = $this->_customerCollectionFactory->create();
        $collection->addAttributeToFilter('is_sales_agent', 1);

        $data = [];
        foreach ($collection as $item) {
            $data[] = [
                'label' => $item->getId() . '. ' . $item->getFirstname() . ' ' . $item->getLastname(),
                'value' => $item->getId() 
            ]; 
        }

        array_unshift($data, ['label' => __('Please Select'), 'value' => '']);
        return $data;
    }
}
