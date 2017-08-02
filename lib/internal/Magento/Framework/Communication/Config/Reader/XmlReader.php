<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Framework\Communication\Config\Reader;

/**
 * Communication configuration filesystem reader. Reads data from XML configs.
 * @since 2.1.0
 */
class XmlReader extends \Magento\Framework\Config\Reader\Filesystem
{
    /**
     * List of id attributes for merge
     *
     * @var array
     * @since 2.1.0
     */
    protected $_idAttributes = [
        '/config/topic' => 'name'
    ];

    /**
     * @param \Magento\Framework\Config\FileResolverInterface $fileResolver
     * @param \Magento\Framework\Communication\Config\Reader\XmlReader\Converter $converter
     * @param \Magento\Framework\Communication\Config\Reader\XmlReader\SchemaLocator $schemaLocator
     * @param \Magento\Framework\Config\ValidationStateInterface $validationState
     * @param string $fileName
     * @param array $idAttributes
     * @param string $domDocumentClass
     * @param string $defaultScope
     * @since 2.1.0
     */
    public function __construct(
        \Magento\Framework\Config\FileResolverInterface $fileResolver,
        XmlReader\Converter $converter,
        XmlReader\SchemaLocator $schemaLocator,
        \Magento\Framework\Config\ValidationStateInterface $validationState,
        $fileName = 'communication.xml',
        $idAttributes = [],
        $domDocumentClass = \Magento\Framework\Config\Dom::class,
        $defaultScope = 'global'
    ) {
        parent::__construct(
            $fileResolver,
            $converter,
            $schemaLocator,
            $validationState,
            $fileName,
            $idAttributes,
            $domDocumentClass,
            $defaultScope
        );
    }
}
