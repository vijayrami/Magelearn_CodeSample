<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magelearn\CodeSample\Controller\Adminhtml\Codesample;

use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{

    protected $dataPersistor;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('entity_id');
        
            $model = $this->_objectManager->create(\Magelearn\CodeSample\Model\Codesample::class)->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Codesample no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }
        	if(is_array($data['product_ids']) && !empty($data['product_ids'])) {
        		$data['product_ids'] = trim(implode(",", $data['product_ids']), ",");
        	}
            $model->setData($data);
        
            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Codesample.'));
                $this->dataPersistor->clear('magelearn_codesample_codesample');
        
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['codesample_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Codesample.'));
            }
        
            $this->dataPersistor->set('magelearn_codesample_codesample', $data);
            return $resultRedirect->setPath('*/*/edit', ['codesample_id' => $this->getRequest()->getParam('codesample_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}

