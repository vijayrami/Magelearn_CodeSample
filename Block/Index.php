<?php

namespace Magelearn\CodeSample\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magelearn\CodeSample\Model\CodesampleFactory as DataFactory;
use Magento\Framework\Serialize\Serializer\Json as Serializer;

/**
 * Class Index
 *
 * @package Magelearn\CodeSample\Block
 */
class Index extends Template
{
    /**
     * @var array|\Magento\Checkout\Block\Checkout\LayoutProcessorInterface[]
     */
    protected $_layoutProcessors;

    /**
     * @var ScopeConfigInterface
     */
    protected $_scopeConfig;

    /**
     * @var DataFactory
     */
    protected $_dataFactory;

    /**
     * @var Serializer
     */
    protected $_serializer;
	
	protected $_productRepository;

    /**
     * Index constructor.
     *
     * @param ScopeConfigInterface $_scopeConfig
     * @param Template\Context     $context
     * @param DataFactory          $_dataFactory
     * @param Serializer           $_serializer
     * @param array                $_layoutProcessors
     * @param array                $data
     */
    public function __construct(
        ScopeConfigInterface $_scopeConfig,
        Template\Context $context,
        DataFactory $_dataFactory,
        Serializer $_serializer,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        array $_layoutProcessors = [],
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_scopeConfig = $_scopeConfig;
        $this->_dataFactory = $_dataFactory;
        $this->_serializer = $_serializer;
		$this->_productRepository = $productRepository;
        $this->jsLayout = isset($data['jsLayout'])
        && is_array(
            $data['jsLayout']
        ) ? $data['jsLayout'] : [];
        $this->_layoutProcessors = $_layoutProcessors;
    }


    /**
     * @return mixed
     */
    private function _getCollection()
    {
    	$codesampledata = $this->_dataFactory->create();
        $codesample_collection = $codesampledata->getCollection();
        return $codesample_collection;
    }

    /**
     * @return string
     */
    public function getJsLayout()
    {
        foreach ($this->_layoutProcessors as $processor) {
            $this->jsLayout = $processor->process($this->jsLayout);
        }
        return \Zend_Json::encode($this->jsLayout);
    }

    /**
     * @return mixed
     */
    public function getNotice()
    {
        return $this->_serializer->serialize($this->_scopeConfig->getValue(
            'codesample/general/notice_text'
        ));
    }

    /**
     * @return bool|false|string
     */
    public function getProductCollectionJsonData()
    {
        $_productCollection = $this->_getCollection();
        $i = 0;
        $productDataArray = array();
        foreach ($_productCollection as $product) {
        	$product_skus = '';
        	if(isset($product['product_ids']) && $product['product_ids'] != '') {
        		$product_ids = $product_sku = [];
        		$product_ids = explode(",", $product['product_ids']);
				
				foreach ($product_ids as $product_id) {
					$productdata = $this->_productRepository->getById($product_id);
					$product_sku[] = $productdata->getSku();
				}
				$product_skus = trim(implode(",", $product_sku),",");
        	}
            $productDataArray[$i] = array(
                'entity_id'       => $product['entity_id'],
                'product_ids'     => $product_skus,
                'additional_text' => $product['additional_text']
            );
            $i++;
        }
		
        return $this->_serializer->serialize($productDataArray);
    }
}