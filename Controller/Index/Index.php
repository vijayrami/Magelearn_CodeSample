<?php

namespace Magelearn\CodeSample\Controller\Index;

use Magento\Framework\View\Element\UiComponentInterface;
use Magento\Framework\Controller\ResultFactory;
/**
 * Class Index
 * @package Magelearn\CodeSample\Controller\Index
 */
class Index extends \Magelearn\CodeSample\Controller\CodeSampleAbstract
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;
	protected $factory;
    /**
     * Constructor
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\View\Element\UiComponentFactory $factory
    ) {
        $this->resultPageFactory = $resultPageFactory;
		$this->factory = $factory;
        parent::__construct($context);
    }

    /**
     * Execute view action
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
    	$isAjax = $this->getRequest()->isAjax();	
    	if ($isAjax) {
    		$component = $this->factory->create($this->_request->getParam('namespace'));
            $this->prepareComponent($component);
            $this->_response->appendBody((string) $component->render());
		} else {
			return $this->resultPageFactory->create();	
		}
    }
	protected function prepareComponent(UiComponentInterface $component)
    {
        foreach ($component->getChildComponents() as $child) {
            $this->prepareComponent($child);
        }
        $component->prepare();
    }
}