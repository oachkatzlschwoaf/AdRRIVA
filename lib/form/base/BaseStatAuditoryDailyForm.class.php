<?php

/**
 * StatAuditoryDaily form base class.
 *
 * @method StatAuditoryDaily getObject() Returns the current form's model object
 *
 * @package    adrriva
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseStatAuditoryDailyForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'date'           => new sfWidgetFormDate(),
      'users'          => new sfWidgetFormInputText(),
      'agents'         => new sfWidgetFormInputText(),
      'adverts'        => new sfWidgetFormInputText(),
      'active_agents'  => new sfWidgetFormInputText(),
      'active_adverts' => new sfWidgetFormInputText(),
      'new_users'      => new sfWidgetFormInputText(),
      'new_agents'     => new sfWidgetFormInputText(),
      'new_adverts'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'date'           => new sfValidatorDate(),
      'users'          => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'agents'         => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'adverts'        => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'active_agents'  => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'active_adverts' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'new_users'      => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'new_agents'     => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'new_adverts'    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'StatAuditoryDaily', 'column' => array('date')))
    );

    $this->widgetSchema->setNameFormat('stat_auditory_daily[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'StatAuditoryDaily';
  }


}
