<?php
namespace AHT\KnockoutJs\Controller\FastOrder;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\ProductRepository;
use Magento\Checkout\Model\Cart as CustomerCart;
use Magento\Framework\Exception\NoSuchEntityException;

class AddToCart extends \Magento\Framework\App\Action\Action
{
    protected $_json;
    protected $_storeManagerInterface;
    protected $_productRepositoryInterface;
    protected $_customerCart;
    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Serialize\Serializer\Json $json,
        \Magento\Store\Model\StoreManagerInterface $storeManagerInterface,
        ProductRepositoryInterface $productRepositoryInterface,
        \Magento\Checkout\Model\Cart $customerCart
    )
    {
        $this->_json = $json;
        $this->_storeManagerInterface = $storeManagerInterface;
        $this->_productRepositoryInterface = $productRepositoryInterface;
        $this->_customerCart = $customerCart;
        return parent::__construct($context);
    }
    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getContent();
        $response = $this->_json->unserialize($data);   

        foreach ($response as $value) {
            $product = $this->_initProduct($value['product']);
            $this->_customerCart->addProduct($product, $value);
        }

        $result = $this->_customerCart->save();
    }

    protected function _initProduct($id)
    {
        $productId = $id;
        if ($productId) {
            $storeId = $this->_storeManagerInterface->getStore()->getId();
            try {
                return $this->_productRepositoryInterface->getById($productId, false, $storeId);
            } catch (NoSuchEntityException $e) {
                return false;
            }
        }
        return false;
    }
}
