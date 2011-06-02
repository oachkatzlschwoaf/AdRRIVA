<?php

/**
 * StatGlobalHours form base class.
 *
 * @method StatGlobalHours getObject() Returns the current form's model object
 *
 * @package    adrriva
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseStatGlobalHoursForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'date_hour'      => new sfWidgetFormDateTime(),
      'clicks'         => new sfWidgetFormInputText(),
      'actions'        => new sfWidgetFormInputText(),
      'points'         => new sfWidgetFormInputText(),
      'fee'            => new sfWidgetFormInputText(),
      'invalid_clicks' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'date_hour'      => new sfValidatorDateTime(),
      'clicks'         => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'actions'        => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'points'         => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'fee'            => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'invalid_clicks' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'StatGlobalHours', 'column' => array('date_hour')))
    );

    $this->widgetSchema->setNameFormat('stat_global_hours[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'StatGlobalHours';
  }


}
