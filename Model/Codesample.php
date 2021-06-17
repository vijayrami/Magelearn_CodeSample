<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magelearn\CodeSample\Model;

use Magelearn\CodeSample\Api\Data\CodesampleInterface;
use Magelearn\CodeSample\Api\Data\CodesampleInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;

class Codesample extends \Magento\Framework\Model\AbstractModel
{

    protected $codesampleDataFactory;

    protected $_eventPrefix = 'magelearn_codesample';
    protected $dataObjectHelper;


    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param CodesampleInterfaceFactory $codesampleDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Magelearn\CodeSample\Model\ResourceModel\Codesample $resource
     * @param \Magelearn\CodeSample\Model\ResourceModel\Codesample\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        CodesampleInterfaceFactory $codesampleDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Magelearn\CodeSample\Model\ResourceModel\Codesample $resource,
        \Magelearn\CodeSample\Model\ResourceModel\Codesample\Collection $resourceCollection,
        array $data = []
    ) {
        $this->codesampleDataFactory = $codesampleDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve codesample model with codesample data
     * @return CodesampleInterface
     */
    public function getDataModel()
    {
        $codesampleData = $this->getData();
        
        $codesampleDataObject = $this->codesampleDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $codesampleDataObject,
            $codesampleData,
            CodesampleInterface::class
        );
        
        return $codesampleDataObject;
    }
}

