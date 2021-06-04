<?php
namespace AHT\CustomCheckout\Block;

use AHT\CustomCheckout\Api\Data\CustomFieldsInterface;
use AHT\CustomCheckout\Api\CustomFieldsRepositoryInterface;

class Delivery extends \Magento\Framework\View\Element\Template
{
    
    protected $_registry;
    protected $_customFieldsRepository;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        CustomFieldsRepositoryInterface $customFieldsRepository,
        array $data = []
    ) {
        $this->_registry = $registry;
        $this->_customFieldsRepository = $customFieldsRepository;
        $this->_isScopePrivate = true;
        parent::__construct($context, $data);
    }

    public function getCurrentOrder() {
        return $this->_registry->registry('current_order');
    }

    public function getDeliveryInfo() {
        $a = $this->_customFieldsRepository->getCustomFields($this->getCurrentOrder());
        return $a;
    }

    
}
