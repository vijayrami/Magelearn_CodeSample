<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magelearn\CodeSample\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface CodesampleRepositoryInterface
{

    /**
     * Save Codesample
     * @param \Magelearn\CodeSample\Api\Data\CodesampleInterface $codesample
     * @return \Magelearn\CodeSample\Api\Data\CodesampleInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Magelearn\CodeSample\Api\Data\CodesampleInterface $codesample
    );

    /**
     * Retrieve Codesample
     * @param string $entiryId
     * @return \Magelearn\CodeSample\Api\Data\CodesampleInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($entiryId);

    /**
     * Retrieve Codesample matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magelearn\CodeSample\Api\Data\CodesampleSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Codesample
     * @param \Magelearn\CodeSample\Api\Data\CodesampleInterface $codesample
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Magelearn\CodeSample\Api\Data\CodesampleInterface $codesample
    );

    /**
     * Delete Codesample by ID
     * @param string $entiryId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($entiryId);
}

