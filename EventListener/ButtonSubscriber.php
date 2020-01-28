<?php

namespace MauticPlugin\AMNameSanitizerBundle\EventListener;

use Mautic\CoreBundle\CoreEvents;
use Mautic\CoreBundle\Event\CustomButtonEvent;
use Mautic\CoreBundle\EventListener\CommonSubscriber;
use Mautic\CoreBundle\Templating\Helper\ButtonHelper;
use Mautic\LeadBundle\Entity\Lead;
use Mautic\PluginBundle\Helper\IntegrationHelper;
use MauticPlugin\AMNameSanitizerBundle\Integration\AMNameSanitizerIntegration;

class ButtonSubscriber extends CommonSubscriber
{
    /**
     * @var IntegrationHelper
     */
    protected $integrationHelper;

    private $event;

    public function __construct(IntegrationHelper $integrationHelper)
    {
        $this->integrationHelper = $integrationHelper;
    }

    public static function getSubscribedEvents()
    {
        return [
            CoreEvents::VIEW_INJECT_CUSTOM_BUTTONS => ['injectViewButtons', 0],
        ];
    }

    /**
     * @param CustomButtonEvent $event
     */
    public function injectViewButtons(CustomButtonEvent $event)
    {

        $integration = $this->integrationHelper->getIntegrationObject('AMNameSanitizer');
        if (false === $integration || ! $integration->getIntegrationSettings()->getIsPublished()) {
            return;
        }

        $event->addButton(
            [
                'attr'      => [
                    'class'       => 'btn btn-default btn-sm btn-nospin',
                    'data-toggle' => '',
                    'data-method' => '',
                    'data-target' => '_blank',
                    'href'        => $this->router->generate('am_sanitize_names'),
                    'data-header' => 'Extra Button',
                ],
                'tooltip'   => 'Limpa os nomes dos contatos cadastrados.',
                'btnText'   => 'Limpar nomes',
                'iconClass' => 'fa fa-check',
                'primary'   => false,
                'priority'  => -1,
            ],

            /* ButtonHelper::LOCATION_LIST_ACTIONS,
            'mautic_contact_index' */

            ButtonHelper::LOCATION_TOOLBAR_ACTIONS,
            'mautic_contact_index'

            /* ButtonHelper::LOCATION_PAGE_ACTIONS,
        ['mautic_contact_action', ['objectAction' => 'view']] */
        );
    }
}
