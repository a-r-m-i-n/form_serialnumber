<?php

declare(strict_types = 1);

namespace T3\FormSerialnumber\Finisher;

/*  | This extension is made with ❤ for TYPO3 CMS and zazudesign.
 *  | It is licensed under GNU General Public License.
 *  |
 *  | (c) 2019-2024 Armin Vieweg <armin@v.ieweg.de>
 */
use TYPO3\CMS\Core\Registry;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Form\Domain\Model\Renderable\AbstractRenderable;

/**
 * Serialnumber finisher for EXT:form.
 */
class SerialnumberFinisher extends \TYPO3\CMS\Form\Domain\Finishers\AbstractFinisher
{
    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @var array
     */
    protected $options = [
        'identifier' => 'serialnumber',
        'addField' => false,
        'fieldLabel' => 'Serialnumber',
        'prefix' => '',
    ];

    public function __construct()
    {
        $this->registry = GeneralUtility::makeInstance(Registry::class);
    }

    /**
     * @return string|null
     */
    public function executeInternal()
    {
        $registryKey = $this->parseOption('identifier') . '_last_id';

        $lastId = $this->registry->get(__CLASS__, $registryKey, 0);
        $thisId = $lastId + 1;
        $this->registry->set(__CLASS__, $registryKey, $thisId);

        $serialnumber = $this->parseOption('prefix') . $thisId;

        if ($this->parseOption('addField')) {
            try {
                /** @var AbstractRenderable $newField */
                $newField = $this->finisherContext
                    ->getFormRuntime()
                    ->getFormDefinition()
                    ->getPageByIndex(0)
                    ->createElement('serialnumber', 'Text');
                $newField->setDefaultValue($serialnumber);
                $newField->setDataType('string');
                $newField->setLabel($this->parseOption('fieldLabel'));
            } catch (\TYPO3\CMS\Form\Exception $exception) {
            }
        }

        $this->finisherContext->getFinisherVariableProvider()->add(
            $this->shortFinisherIdentifier,
            'index',
            $thisId
        );
        $this->finisherContext->getFinisherVariableProvider()->add(
            $this->shortFinisherIdentifier,
            'serialnumber',
            $serialnumber
        );

        return null;
    }
}
