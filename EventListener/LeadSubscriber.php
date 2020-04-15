<?php

namespace MauticPlugin\AMNameSanitizerBundle\EventListener;

use Mautic\CoreBundle\EventListener\CommonSubscriber;
use Mautic\LeadBundle\Event\LeadEvent;
use Mautic\LeadBundle\LeadEvents;
use Mautic\PluginBundle\Helper\IntegrationHelper;

class LeadSubscriber extends CommonSubscriber
{
    /**
     * @var IntegrationHelper
     */
    protected $integrationHelper;

    public function __construct(IntegrationHelper $integrationHelper)
    {
        $this->integrationHelper = $integrationHelper;
    }

    public static function getSubscribedEvents()
    {
        return [
            LeadEvents::LEAD_POST_SAVE => ['onLeadPostSave', 0],
        ];
    }

    public function onLeadPostSave(LeadEvent $event)
    {
        $integration = $this->integrationHelper->getIntegrationObject('AMNameSanitizer');
        if (false === $integration || ! $integration->getIntegrationSettings()->getIsPublished() || ! $integration->getInsertSanitize()) {
            return;
        }

        //Prepara o Model do plugin
        $pluginModel = $this->factory->getModel('namesanitizer.model');

        //Pega os dados do lead que está sendo inserido
        $lead = $event->getLead();

        //Altera no banco o nome do lead inserido
        $pluginModel->updateName($lead);

        return;
    }
}
