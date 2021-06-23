<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magelearn\CodeSample\Ui\Component\Listing\Column;

class ProductSku extends \Magento\Ui\Component\Listing\Columns\Column
{
	protected $_productRepository;

    /**
     * @param \Magento\Framework\View\Element\UiComponent\ContextInterface $context
     * @param \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
		$this->_productRepository = $productRepository;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['product_ids']) && $item['product_ids'] != '') {
                	$product_ids = $product_sku = [];
                    $product_ids = explode(",", $item['product_ids']);
					foreach ($product_ids as $product_id) {
						$productdata = $this->_productRepository->getById($product_id);
						$product_sku[] = $productdata->getSku();
					}
					$item['product_ids'] = trim(implode(",", $product_sku),",");
                }
            }
        }
        return $dataSource;
    }
}
