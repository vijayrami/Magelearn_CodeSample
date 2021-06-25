<?php
namespace Magelearn\CodeSample\Block;

class Grid extends \Magento\Framework\View\Element\Template
{
     protected $_gridFactory;
	 protected $_productFactory;
	 
     public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magelearn\CodeSample\Model\CodesampleFactory $gridFactory,
        \Magento\Catalog\Model\ProductFactory $_productFactory,
        array $data = []
     ) {
        $this->_gridFactory = $gridFactory;
		$this->_productFactory = $_productFactory;
        parent::__construct($context, $data);
        //get collection of data 
        $collection = $this->_gridFactory->create()->getCollection();
        $this->setCollection($collection);
        $this->pageConfig->getTitle()->set(__('My Grid List'));
    }
 
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if ($this->getCollection()) {
            // create pager block for collection 
            $pager = $this->getLayout()->createBlock(
                'Magento\Theme\Block\Html\Pager',
                'magelearn.grid.record.pager'
            )->setCollection(
                $this->getCollection() // assign collection to pager
            );
            $this->setChild('pager', $pager);// set pager block in layout
        }
        return $this;
    }
 
    /**
     * @return string
     */
    // method for get pager html
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
	
	public function getProductSkus($productids)
    {
    	$product_ids = $product_sku = [];
    	$product_ids = explode(",", $productids);
		
		foreach ($product_ids as $product_id) {
			$productdata = $this->_productFactory->create()->load($product_id);
			$product_sku[] = $productdata->getSku();
		}
		return trim(implode(",", $product_sku),",");
    }   
}
?>