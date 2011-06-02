<?php

/**
 * StatAgentDaily form base class.
 *
 * @method StatAgentDaily getObject() Returns the current form's model object
 *
 * @package    adrriva
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseStatAgentDailyForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'      => new sfWidgetFormInputHidden(),
      'date'    => new sfWidgetFormDate(),
      'user_id' => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => false)),
      'ua_id'   => new sfWidgetFormPropelChoice(array('model' => 'UserAdvertise', 'add_empty' => false)),
      'clicks'  => new sfWidgetFormInputText(),
      'points'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'      => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'date'    => new sfValidatorDate(),
      'user_id' => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id')),
      'ua_id'   => new sfValidatorPropelChoice(array('model' => 'UserAdvertise', 'column' => 'id')),
      'clicks'  => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'points'  => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'StatAgentDaily', 'column' => array('date', 'user_id', 'ua_id')))
    );

    $this->widgetSchema->setNameFormat('stat_agent_daily[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'StatAgentDaily';
  }


}
