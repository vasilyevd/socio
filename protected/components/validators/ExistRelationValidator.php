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
                if (is_object($data)) {
                    $model = $data;
                } else {
                    // Get relation model name from relation settings.
                    $settings = $object->relations();
                    $model = CActiveRecord::model($settings[$attribute][1])->findByPk($data);

                    // Related record with given PK does not exist.
                    // Set model as invalid.
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
                if (is_object($object->$attribute)) {
                    $model = $object->$attribute;
                } else {
                    // Get relation model name from relation settings.
                    $settings = $object->relations();
                    $model = CActiveRecord::model($settings[$attribute][1])->findByPk($object->$attribute);

                    // Related record with given PK does not exist.
                    // Set model as invalid.
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
