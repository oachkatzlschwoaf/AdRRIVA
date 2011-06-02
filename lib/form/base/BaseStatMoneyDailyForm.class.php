<?php

/**
 * StatMoneyDaily form base class.
 *
 * @method StatMoneyDaily getObject() Returns the current form's model object
 *
 * @package    adrriva
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseStatMoneyDailyForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                              => new sfWidgetFormInputHidden(),
      'date'                            => new sfWidgetFormDate(),
      'turnover'                        => new sfWidgetFormInputText(),
      'turnover_points'                 => new sfWidgetFormInputText(),
      'revenue'                         => new sfWidgetFormInputText(),
      'revenue_points'                  => new sfWidgetFormInputText(),
      'pay_count'                       => new sfWidgetFormInputText(),
      'avg_check'                       => new sfWidgetFormInputText(),
      'avg_check_points'                => new sfWidgetFormInputText(),
      'incoming_funds'                  => new sfWidgetFormInputText(),
      'incoming_funds_points'           => new sfWidgetFormInputText(),
      'outgoing_funds'                  => new sfWidgetFormInputText(),
      'outgoing_funds_points'           => new sfWidgetFormInputText(),
      'diff_funds'                      => new sfWidgetFormInputText(),
      'diff_funds_points'               => new sfWidgetFormInputText(),
      'avg_agent_revenue'               => new sfWidgetFormInputText(),
      'avg_agent_revenue_points'        => new sfWidgetFormInputText(),
      'avg_advert_cost'                 => new sfWidgetFormInputText(),
      'avg_advert_cost_points'          => new sfWidgetFormInputText(),
      'avg_active_agent_revernue'       => new sfWidgetFormInputText(),
      'avg_active_agent_revenue_points' => new sfWidgetFormInputText(),
      'avg_active_advert_cost'          => new sfWidgetFormInputText(),
      'avg_active_advert_cost_points'   => new sfWidgetFormInputText(),
      'avg_click_cost'                  => new sfWidgetFormInputText(),
      'avg_click_cost_points'           => new sfWidgetFormInputText(),
      'avg_click_revenue'               => new sfWidgetFormInputText(),
      'avg_click_revenue_points'        => new sfWidgetFormInputText(),
      'arpu'                            => new sfWidgetFormInputText(),
      'arpu_points'                     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                              => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'date'                            => new sfValidatorDate(),
      'turnover'                        => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'turnover_points'                 => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'revenue'                         => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'revenue_points'                  => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'pay_count'                       => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'avg_check'                       => new sfValidatorNumber(),
      'avg_check_points'                => new sfValidatorNumber(),
      'incoming_funds'                  => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'incoming_funds_points'           => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'outgoing_funds'                  => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'outgoing_funds_points'           => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'diff_funds'                      => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'diff_funds_points'               => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'avg_agent_revenue'               => new sfValidatorNumber(),
      'avg_agent_revenue_points'        => new sfValidatorNumber(),
      'avg_advert_cost'                 => new sfValidatorNumber(),
      'avg_advert_cost_points'          => new sfValidatorNumber(),
      'avg_active_agent_revernue'       => new sfValidatorNumber(),
      'avg_active_agent_revenue_points' => new sfValidatorNumber(),
      'avg_active_advert_cost'          => new sfValidatorNumber(),
      'avg_active_advert_cost_points'   => new sfValidatorNumber(),
      'avg_click_cost'                  => new sfValidatorNumber(),
      'avg_click_cost_points'           => new sfValidatorNumber(),
      'avg_click_revenue'               => new sfValidatorNumber(),
      'avg_click_revenue_points'        => new sfValidatorNumber(),
      'arpu'                            => new sfValidatorNumber(),
      'arpu_points'                     => new sfValidatorNumber(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'StatMoneyDaily', 'column' => array('date')))
    );

    $this->widgetSchema->setNameFormat('stat_money_daily[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'StatMoneyDaily';
  }


}
