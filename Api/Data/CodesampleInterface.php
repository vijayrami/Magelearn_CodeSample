<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magelearn\CodeSample\Api\Data;

interface CodesampleInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const ENTITY_ID = 'entity_id';
    const PRODUCT_IDS = 'product_ids';
    const ADDITIONAL_TEXT = 'additional_text';

    /**
     * Get entity_id
     * @return string|null
     */
    public function getEntityId();

    /**
     * Set entity_id
     * @param string $entiryId
     * @return \Magelearn\CodeSample\Api\Data\CodesampleInterface
     */
    public function setEntityId($entiryId);
    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Magelearn\CodeSample\Api\Data\CodesampleExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Magelearn\CodeSample\Api\Data\CodesampleExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Magelearn\CodeSample\Api\Data\CodesampleExtensionInterface $extensionAttributes
    );

    /**
     * Get product_ids
     * @return string|null
     */
    public function getProductIds();

    /**
     * Set product_ids
     * @param string $productIds
     * @return \Magelearn\CodeSample\Api\Data\CodesampleInterface
     */
    public function setProductIds($productIds);

    /**
     * Get additional_text
     * @return string|null
     */
    public function getAdditionalText();

    /**
     * Set additional_text
     * @param string $additionalText
     * @return \Magelearn\CodeSample\Api\Data\CodesampleInterface
     */
    public function setAdditionalText($additionalText);
}

