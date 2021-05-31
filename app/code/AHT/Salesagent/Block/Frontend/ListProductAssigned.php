<?php
namespace AHT\Salesagent\Block\Frontend;

use Exception;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use Magento\Customer\Model\Session as CustomerSession;

class ListProductAssigned extends \Magento\Framework\View\Element\Template
{
    protected $_productCollectionFactory;
    protected $_customerSession;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        ProductCollectionFactory $productCollectionFactory,
        CustomerSession $customerSession,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->_customerSession = $customerSession;     
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if ($this->getCollection()) {
            $pager = $this->getLayout()->createBlock(
                'Magento\Theme\Block\Html\Pager',
                'aht.salesagent.pager'
                )->setAvailableLimit(array(5=>5,10=>10,15=>15))->setCollection(
                    $this->getCollection()
                );

                $this->setChild('pager', $pager);
                $this->getCollection()->load();
        }

        return $this;
    }

    public function getCollection() 
    {
        $page = ($this->getRequest()->getParam('p'))? $this->getRequest()->getParam('p') : 1;
        $pageSize = ($this->getRequest()->getParam('limit'))? $this->getRequest()->getParam('limit') : 5; 
        $collection = $this->_productCollectionFactory->create();
        $idLoggedIn = $this->_customerSession->getCustomer()->getId();
        $collection->addAttributeToSelect('*')->addAttributeToFilter('sale_agent_id', $idLoggedIn);
        $collection->setPageSize($pageSize);  
        $collection->setCurPage($page);
        return $collection;
    }

    public function getPagerHtml() 
    {
        return $this->getChildHtml('pager');
    }
}
