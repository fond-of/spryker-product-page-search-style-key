<?php

namespace FondOfSpryker\Zed\ProductPageSearchStyleKey\Communication\Plugin\PageDataExpander;

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
        if (!array_key_exists('attributes', $productData)) {
            return;
        }

        $attributesData = \json_decode($productData['attributes'], true);

        if (!array_key_exists(PageIndexMap::STYLE_KEY, $attributesData)) {
            return;
        }

        if (!method_exists($productAbstractPageSearchTransfer, 'setModelKey')) {
            return;
        }

        $productAbstractPageSearchTransfer->setModelKey($attributesData[PageIndexMap::STYLE_KEY]);
    }
}
