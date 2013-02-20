<?php

class ExistRelationValidator extends CValidator
{
    protected function validateAttribute($object, $attribute)
    {
        $valid = true;

        if (is_array($object->$attribute)) {
            // Handle relations with array of models.
            $tabular = array();

            foreach ($object->$attribute as $data) {
                if ($data instanceof CActiveRecord) {
                    $model = $data;
                } else {
                    // Get relation model name from relation settings.
                    $settings = $object->relations();
                    $model = $settings[$attribute][1]::model()->findByPk($data);

                    if (is_null($model)) {
                        $valid = false;
                    }
                }

                $tabular[] = $model;
            }
        } else {
            // Handle relations with single model.
            $tabular = null;

            if (!empty($object->$attribute)) {
                if ($object->$attribute instanceof CActiveRecord) {
                    $model = $object->$attribute;
                } else {
                    // Get relation model name from relation settings.
                    $settings = $object->relations();
                    $model = $settings[$attribute][1]::model()->findByPk($object->$attribute);

                    if (is_null($model)) {
                        $valid = false;
                    }
                }

                $tabular = $model;
            }
        }

        $object->$attribute = $tabular;
        if (!$valid) {
            $this->addError($object, $attribute, 'Неверно задано поле ' . $object->getAttributeLabel($attribute));
        }
    }
}
