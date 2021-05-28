<?php
namespace AHT\KnockoutJs\Controller\FastOrder;

class Search extends \Magento\Framework\App\Action\Action
{

    protected $_productCollectionFactory;
    protected $_imgHelper;
    protected $_priceHelper;
    protected $_priceCurrency;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Catalog\Helper\Image $imgHelper,
        \Magento\Framework\Pricing\Helper\Data $priceHelper,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency     
    )
    {
        $this->_imgHelper = $imgHelper;
        $this->_priceHelper = $priceHelper;
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->_priceCurrency = $priceCurrency;
        return parent::__construct($context);
    }
    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $key = $this->getRequest()->getParam('key');
        if ($key != null || $key != "") {
            $list = $this->_productCollectionFactory->create()
                ->addAttributeToSelect('*')
                ->addAttributeToFilter('status', ['eq' => 1])
                ->addAttributeToFilter([
                    ['attribute' => 'name', 'like' => '%'.$key.'%'],
                    ['attribute' => 'sku', 'like' => '%'.$key.'%']
                   ])->setPageSize(5);
            $data = [];
            foreach ($list as $index => $item) {
                $data[$index] = $item->getData();
                $data[$index]['srcthumbnail'] = $this->_imgHelper->init($item, 'product_thumbnail_image')->getUrl();
                $data[$index]['srcsmall'] = $this->_imgHelper->init($item, 'product_small_image')->getUrl();
                $data[$index]['priceSymbol'] = $this->_priceHelper->currency($item->getFinalPrice(), true, false);
            }
            $products['list'] = array_values($data);
            $products['symbol'] = $this->_priceCurrency->getCurrencySymbol();
            echo json_encode($products);    
        } else {
            echo json_encode(null); 
        }
    }
}
