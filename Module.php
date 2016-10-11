<?php
namespace Test;

use Omeka\Module\AbstractModule;
use Omeka\Event\Event;
use Zend\Form\Fieldset;
use Zend\EventManager\SharedEventManagerInterface;

class Module extends AbstractModule
{
    
    public function getConfig()
    {
        return include __DIR__.'/config/module.config.php';
    }
    
    public function attachListeners(SharedEventManagerInterface $sharedEventManager)
    {
/*
        $sharedEventManager->attach(
            'Omeka\Form\SettingForm',
            Event::SITE_SETTINGS_ADD_ELEMENTS,
            [$this, 'addElements']
        );

        $sharedEventManager->attach(
            'Omeka\Form\SettingForm',
            Event::SITE_SETTINGS_ADD_INPUT_FILTERS,
            [$this, 'addInputFilters']
        );
*/
        $sharedEventManager->attach(
            '*',
            'view.show.before',
            [$this, 'testViewEvents']
        );
        
        $sharedEventManager->attach(
            '*',
            'view.show.after',
            [$this, 'testViewEvents']
        );
        
        $sharedEventManager->attach(
            '*',
            'view.browse.before',
            [$this, 'testViewEvents']
        );
        
        $sharedEventManager->attach(
            '*',
            'view.browse.after',
            [$this, 'testViewEvents']
        );
    }
    
    public function testViewEvents(Event $event)
    {
        $name = $event->getName();
        echo "<p style='color:red'>$name</p>";
    }
    
    public function addElements(Event $event)
    {
        
    }
    
    public function addInputFilters(Event $event)
    {
        
    }
}