<?php

namespace FondOfSpryker\Zed\ProductPageSearchStyleKey\Communication\Plugin\PageDataExpander;

use FondOfSpryker\Shared\ProductPageSearchStyleKey\ProductPageSearchStyleKeyConstants;
use Generated\Shared\Search\PageIndexMap;
use Generated\Shared\Transfer\ProductPageSearchTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\ProductPageSearch\Dependency\Plugin\ProductPageDataExpanderInterface;

class StyleKeyDataExpanderPlugin extends AbstractPlugin implements ProductPageDataExpanderInterface
{
    public const PLUGIN_NAME = 'StyleKeyDataExpanderPlugin';

    /**
     * @param array $productData
     * @param \Generated\Shared\Transfer\ProductPageSearchTransfer $productAbstractPageSearchTransfer
     *
     * @return void
     */
    public function expandProductPageData(array $productData, ProductPageSearchTransfer $productAbstractPageSearchTransfer): void
    {
        if (!array_key_exists(ProductPageSearchStyleKeyConstants::ATTRIBUTES, $productData)) {
            return;
        }

        $productAttributesData = \json_decode($productData[ProductPageSearchStyleKeyConstants::ATTRIBUTES], true);

        if (!array_key_exists(PageIndexMap::STYLE_KEY, $productAttributesData)) {
            return;
        }

        if (!method_exists($productAbstractPageSearchTransfer, 'setStyleKey')) {
            return;
        }

        $productAbstractPageSearchTransfer->setStyleKey($productAttributesData[PageIndexMap::STYLE_KEY]);
    }
}
