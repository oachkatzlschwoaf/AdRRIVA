<?php

/**
 * Action form base class.
 *
 * @method Action getObject() Returns the current form's model object
 *
 * @package    adrriva
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseActionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'    => new sfWidgetFormInputHidden(),
      'hash'  => new sfWidgetFormInputText(),
      'time'  => new sfWidgetFormInputText(),
      'ua_id' => new sfWidgetFormPropelChoice(array('model' => 'UserAdvertise', 'add_empty' => false)),
      'cost'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'    => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'hash'  => new sfValidatorString(array('max_length' => 4)),
      'time'  => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'ua_id' => new sfValidatorPropelChoice(array('model' => 'UserAdvertise', 'column' => 'id')),
      'cost'  => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
    ));

    $this->widgetSchema->setNameFormat('action[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Action';
  }


}
