<?php

namespace Darake\SculpinCategoryListBundle;

use Sculpin\Core\Sculpin;
use Sculpin\Core\Event\SourceSetEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Dflydev\DotAccessConfiguration\ConfigurationInterface;

class CategoryListGenerator implements EventSubscriberInterface
{
    protected $siteConfigration;
    protected $taxonomyTypes;

    public function __construct(ConfigurationInterface $siteConfigration, array $taxonomyTypes)
    {
        $this->siteConfigration = $siteConfigration;
        $this->taxonomyTypes = $taxonomyTypes;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [
            Sculpin::EVENT_BEFORE_RUN => array('beforeRun', 100),
        ];
    }

    public function beforeRun(SourceSetEvent $sourceSetEvent): void
    {
        $sourceSet = $sourceSetEvent->sourceSet();
        $allSources = $sourceSet->allSources();

        $taxonMap = [];

        foreach ($this->taxonomyTypes as $taxon) {
            foreach ($allSources as $source) {
                if ($sourceTags = $source->data()->get($taxon)) {
                    foreach ($sourceTags as $tag) {
                        $taxonMap[$taxon][$tag][] = $source->sourceId();
                    }
                }
            }
        }

        foreach ($taxonMap as $taxon => $list) {
            $results = [];
            foreach ($list as $tag => $index) {
                $results[$tag] = [
                    "name" => $tag,
                    "count" => count($index),
                ];
            }

            $this->siteConfigration->set($taxon . "_list", $results);
        }
    }
}
