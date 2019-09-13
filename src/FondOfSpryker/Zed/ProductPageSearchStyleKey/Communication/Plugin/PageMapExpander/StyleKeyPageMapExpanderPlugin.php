<?php

namespace FondOfSpryker\Zed\ProductPageSearchStyleKey\Communication\Plugin\PageMapExpander;

use Generated\Shared\Search\PageIndexMap;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\PageMapTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\ProductPageSearch\Dependency\Plugin\ProductPageMapExpanderInterface;
use Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface;

class StyleKeyPageMapExpanderPlugin extends AbstractPlugin implements ProductPageMapExpanderInterface
{
    /**
     * @param \Generated\Shared\Transfer\PageMapTransfer $pageMapTransfer
     * @param \Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface $pageMapBuilder
     * @param array $productData
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     *
     * @return \Generated\Shared\Transfer\PageMapTransfer
     */
    public function expandProductPageMap(PageMapTransfer $pageMapTransfer, PageMapBuilderInterface $pageMapBuilder, array $productData, LocaleTransfer $localeTransfer): PageMapTransfer
    {
        if (!array_key_exists('attributes', $productData)) {
            return $pageMapTransfer;
        }

        if (!array_key_exists(PageIndexMap::STYLE_KEY, $productData['attributes'])) {
            return $pageMapTransfer;
        }

        if (!method_exists($pageMapTransfer, 'setStyleKey')) {
            return $pageMapTransfer;
        }

        $this->addStyleKeyToPageMapTransfer($pageMapTransfer, $productData);

        return $pageMapTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\PageMapTransfer $pageMapTransfer
     * @param array $productData
     *
     * @return void
     */
    protected function addStyleKeyToPageMapTransfer(PageMapTransfer $pageMapTransfer, array $productData): void
    {
        $pageMapTransfer->setStyleKey($productData['attributes'][PageIndexMap::STYLE_KEY]);
    }
}
