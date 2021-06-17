<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magelearn\CodeSample\Api\Data;

interface CodesampleSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Codesample list.
     * @return \Magelearn\CodeSample\Api\Data\CodesampleInterface[]
     */
    public function getItems();

    /**
     * Set id list.
     * @param \Magelearn\CodeSample\Api\Data\CodesampleInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

