<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magelearn\CodeSample\Model\Data;

use Magelearn\CodeSample\Api\Data\CodesampleInterface;

class Codesample extends \Magento\Framework\Api\AbstractExtensibleObject implements CodesampleInterface
{

    /**
     * Get entity_id
     * @return string|null
     */
    public function getEntityId()
    {
        return $this->_get(self::ENTITY_ID);
    }

    /**
     * Set entity_id
     * @param string $entiryId
     * @return \Magelearn\CodeSample\Api\Data\CodesampleInterface
     */
    public function setEntityId($entiryId)
    {
        return $this->setData(self::ENTITY_ID, $entiryId);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Magelearn\CodeSample\Api\Data\CodesampleExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Magelearn\CodeSample\Api\Data\CodesampleExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Magelearn\CodeSample\Api\Data\CodesampleExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get product_ids
     * @return string|null
     */
    public function getProductIds()
    {
        return $this->_get(self::PRODUCT_IDS);
    }

    /**
     * Set product_ids
     * @param string $productIds
     * @return \Magelearn\CodeSample\Api\Data\CodesampleInterface
     */
    public function setProductIds($productIds)
    {
        return $this->setData(self::PRODUCT_IDS, $productIds);
    }

    /**
     * Get additional_text
     * @return string|null
     */
    public function getAdditionalText()
    {
        return $this->_get(self::ADDITIONAL_TEXT);
    }

    /**
     * Set additional_text
     * @param string $additionalText
     * @return \Magelearn\CodeSample\Api\Data\CodesampleInterface
     */
    public function setAdditionalText($additionalText)
    {
        return $this->setData(self::ADDITIONAL_TEXT, $additionalText);
    }
}

