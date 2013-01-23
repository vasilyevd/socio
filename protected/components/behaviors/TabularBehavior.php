<?php

class TabularBehavior extends CActiveRecordBehavior
{
    public $relations = array();
    private $_models = array();
    private $_settings;

    /**
     * Calls tabular method for all relations and saves relation models. Sets
     * relations to empty or valid and adds validation errors where needed.
     */
    public function beforeValidate()
    {
        // Find relations settings once.
        if (!isset($this->_settings)) {
            $this->_settings = $this->owner->relations();
        }

        foreach ($this->relations as $rel => $options) {
            $method = $rel . 'Tabular';
            $this->_models[$rel] = $this->owner->$method();

            // Check validation.
            if ($this->_models[$rel] === null) {
                // Set relation as empty.
                $this->owner->$rel = null;
            } elseif ($this->_models[$rel] === array()) {
                // Set relation as empty.
                $this->owner->$rel = array();
            } elseif ($this->_models[$rel] === false) {
                // Set relation as having models (but don't set models, because
                // related models are not saved).
                $this->owner->$rel = true;
                // Set validation error for current relation.
                $this->owner->addError($rel, 'Неверно задано поле ' . $this->owner->getAttributeLabel($rel));
            } else {
                // Set relation as having models (but don't set models, because
                // related models are not saved).
                $this->owner->$rel = true;
            }
        }
    }

    /**
     * Saves all 'MANY_MANY' and 'HAS_MANY' relations with relation link
     * attribute as null (to find ID).
     * Saves all 'BELONGS_TO' master relations and sets their links.
     */
    public function beforeSave()
    {
        foreach ($this->relations as $rel => $options) {
            if ($this->_settings[$rel][0] === CActiveRecord::MANY_MANY ||
                $this->_settings[$rel][0] === CActiveRecord::HAS_MANY
            ) {
                // Save all related models. Their link attribute is set to
                // null, because owner model is new and don't have ID yet.
                foreach ($this->_models[$rel] as $m) {
                    $m->save();
                }
                // Set relation as array of models or empty array. Relation
                // creation will be handled by 'EActiveRecordRelationBehavior'
                // accordingly, later in 'afterSave'.
                $this->owner->$rel = $this->_models[$rel];
            } elseif ($this->_settings[$rel][0] === CActiveRecord::BELONGS_TO) {
                if ($this->_models[$rel] === null) {
                    // Set link ID attribute of owner model as null.
                    $this->owner->setAttribute($this->_settings[$rel][2], null);
                } else {
                    // Save related model.
                    $this->_models[$rel]->save();
                    // Set link ID attribute of owner model as new related
                    // model ID.
                    $this->owner->setAttribute($this->_settings[$rel][2], $this->_models[$rel]->id);
                }
            }
        }
    }

    /**
     * Deletes homeless models for 'HAS_MANY' relations, based on 'delete'
     * option.
     */
    public function afterSave()
    {
        foreach ($this->relations as $rel => $options) {
            if ($this->_settings[$rel][0] === CActiveRecord::HAS_MANY &&
                $options['delete'] === true
            ) {
                // Find all related models with null ID link.
                $deleteModels = call_user_func($this->_settings[$rel][1] . '::model')->findAllByAttributes(array($this->_settings[$rel][2] => null));
                foreach ($deleteModels as $m) {
                    $m->delete();
                }
            }
        }
    }
}
