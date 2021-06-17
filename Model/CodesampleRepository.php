<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magelearn\CodeSample\Model;

use Magelearn\CodeSample\Api\CodesampleRepositoryInterface;
use Magelearn\CodeSample\Api\Data\CodesampleInterfaceFactory;
use Magelearn\CodeSample\Api\Data\CodesampleSearchResultsInterfaceFactory;
use Magelearn\CodeSample\Model\ResourceModel\Codesample as ResourceCodesample;
use Magelearn\CodeSample\Model\ResourceModel\Codesample\CollectionFactory as CodesampleCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;

class CodesampleRepository implements CodesampleRepositoryInterface
{

    protected $codesampleCollectionFactory;

    protected $resource;

    protected $extensibleDataObjectConverter;
    protected $searchResultsFactory;

    protected $dataCodesampleFactory;

    private $storeManager;

    protected $dataObjectHelper;

    protected $codesampleFactory;

    protected $dataObjectProcessor;

    protected $extensionAttributesJoinProcessor;

    private $collectionProcessor;


    /**
     * @param ResourceCodesample $resource
     * @param CodesampleFactory $codesampleFactory
     * @param CodesampleInterfaceFactory $dataCodesampleFactory
     * @param CodesampleCollectionFactory $codesampleCollectionFactory
     * @param CodesampleSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceCodesample $resource,
        CodesampleFactory $codesampleFactory,
        CodesampleInterfaceFactory $dataCodesampleFactory,
        CodesampleCollectionFactory $codesampleCollectionFactory,
        CodesampleSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->codesampleFactory = $codesampleFactory;
        $this->codesampleCollectionFactory = $codesampleCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataCodesampleFactory = $dataCodesampleFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Magelearn\CodeSample\Api\Data\CodesampleInterface $codesample
    ) {
        /* if (empty($codesample->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $codesample->setStoreId($storeId);
        } */
        
        $codesampleData = $this->extensibleDataObjectConverter->toNestedArray(
            $codesample,
            [],
            \Magelearn\CodeSample\Api\Data\CodesampleInterface::class
        );
        
        $codesampleModel = $this->codesampleFactory->create()->setData($codesampleData);
        
        try {
            $this->resource->save($codesampleModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the codesample: %1',
                $exception->getMessage()
            ));
        }
        return $codesampleModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($codesampleId)
    {
        $codesample = $this->codesampleFactory->create();
        $this->resource->load($codesample, $codesampleId);
        if (!$codesample->getId()) {
            throw new NoSuchEntityException(__('Codesample with id "%1" does not exist.', $codesampleId));
        }
        return $codesample->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->codesampleCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Magelearn\CodeSample\Api\Data\CodesampleInterface::class
        );
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Magelearn\CodeSample\Api\Data\CodesampleInterface $codesample
    ) {
        try {
            $codesampleModel = $this->codesampleFactory->create();
            $this->resource->load($codesampleModel, $codesample->getCodesampleId());
            $this->resource->delete($codesampleModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Codesample: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($entiryId)
    {
        return $this->delete($this->get($entiryId));
    }
}

