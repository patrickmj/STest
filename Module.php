<?php
namespace STest;

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

        $sharedEventManager->attach(
            'Omeka\Form\SettingForm',
            Event::ADD_ELEMENTS,
            [$this, 'testViewEvents']
        );

        $sharedEventManager->attach(
            'Omeka\Form\SettingForm',
            Event::ADD_INPUT_FILTERS,
            [$this, 'testViewEvents']
        );

        $sharedEventManager->attach(
            'Omeka\Form\SettingForm',
            Event::ADD_ELEMENTS,
            [$this, 'addElements']
        );

        $sharedEventManager->attach(
            'Omeka\Form\SettingForm',
            Event::ADD_ELEMENTS,
            [$this, 'addElements']
        );
        
        $sharedEventManager->attach(
            'Omeka\Form\SiteSettingsForm',
            Event::ADD_ELEMENTS,
            [$this, 'addElements']
        );

        $sharedEventManager->attach(
            '*',
            'view.details',
            [$this, 'testViewEvents']
        );
        
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
        
        $sharedEventManager->attach(
            '*',
            'view.manage-resources.before',
            [$this, 'testViewEvents']
        );
        
        $sharedEventManager->attach(
            '*',
            'view.manage-sites.before',
            [$this, 'testViewEvents']
        );
        
        
        $sharedEventManager->attach(
            '*',
            'view.manage-sites.after',
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
        $form = $event->getParam('form');
        $fieldset = new Fieldset('example');
        $fieldset->setLabel('Example Fieldset');
        
        $fieldset->add([
                'name' => 'example',
                'type' => 'text',
                'options' => [
                    'label' => 'Example text input', // @translate
                ],
            ]);
        
        $form->add($fieldset);
    }
    
    public function addInputFilters(Event $event)
    {
        $inputFilter = $event->getParam('inputFilter');
        $inputFilter->get('example')->add([
                    'name' => 'example',
                    'required' => false,
                ]);
    }
}