<?php
/**
 * @author: Yusnel Rojas Garcia <yrojass@gmail.com>
 * @team : Red Labz
 * @date: 9/25/12
 */
class FSwitchValidator extends CValidator
{
    /**
     * <pre>
     *  'cases'=>array(
     *      'image'=>array(
     *           array('file',  'required')  //more validators to apply to the model
     *           array('file',  'file')  //more validators to apply to the model
     *      ),
     *      'video'=>array(
     *          array('url', 'required'),
     *          array('url', 'validVideoUrl'),
     *      )
     *  )
     * </pre>
     * @var array the range of options
     */
    public $cases = array();

    /**
     * @var array set of rules to apply when no case is matched.
     */
    public $default = array();

    /**
     * @var boolean whether the comparison is strict (both type and value must be the same)
     */
    public $strict=false;

    /**
     * Validates a single attribute.
     * This method should be overridden by child classes.
     * @param CModel $object the data object being validated
     * @param string $attribute the name of the attribute to be validated.
     */
    protected function validateAttribute($object, $attribute)
    {
        $value=$object->$attribute;
        if($value===null || $value==='') return;

        $found = false;
        $cases = $this->cases;
        while ((list($case, $validators) = each($cases)) && !$found){
            if (($this->strict === true) && ($case === $value)){
                $this->applyValidators($object, $validators);
                $found = true;
            }elseif (($this->strict === false) && ($case == $value)){
                $this->applyValidators($object, $validators);
                $found = true;
            }
        }

        if (!$found){
            $this->applyValidators($object, $this->default);
        }
    }

    private function applyValidators($model, $validators)
    {
        if (empty($validators) || ($validators && !is_array(current($validators))) ){ // a single validator
            $validators = array($validators);
        }

        foreach ($validators as $validatorRule){
            $name = $validatorRule[1];
            $attributes = $validatorRule[0];
            unset($validatorRule[1]);
            unset($validatorRule[0]);
            $validator = CValidator::createValidator($name, $model, $attributes, $validatorRule);
            $validator->validate($model, $validator->attributes);
        }
    }
}
