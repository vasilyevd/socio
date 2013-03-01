<?php

class InforequestUpdateBehavior extends CActiveRecordBehavior
{
    public $attributeSource;
    public $attributeCompare;
    protected $_attributeSourceHistory;

    /**
     * This is invoked when record is populated with the data from database.
     */
    public function afterFind()
    {
        // Remember old attribute value.
        $this->_attributeSourceHistory = $this->owner->{$this->attributeSource};
    }

    /**
     * This is invoked after the record is saved.
     */
    public function afterSave()
    {
        // If attribute changed update all 'Inforequest' related records.
        if (
            !$this->owner->isNewRecord &&
            $this->owner->{$this->attributeSource} != $this->_attributeSourceHistory
        ) {
            $criteria = new CDbCriteria;
            // Compare 'sender_id' or 'receiver_id' with current model ID.
            $criteria->compare($this->attributeCompare, $this->owner->id);

            // Additional conditions for 'sender_id' based on 'sender_type'.
            if ($this->attributeCompare == 'sender_id') {
                // Find proper 'sender_type' value.
                switch (get_class($this->owner)) {
                    case 'PersonUser':
                        $senderType = Inforequest::model()->SenderType->find('USER');
                        break;
                    case 'Organization':
                        $senderType = Inforequest::model()->SenderType->find('ORGANIZATION');
                        break;
                    case 'Bizorganization':
                        $senderType = Inforequest::model()->SenderType->find('BIZORGANIZATION');
                        break;
                    default:
                        $senderType = Inforequest::model()->SenderType->find('USER');
                }
                // Restrict 'sender_type' to owner class.
                $criteria->compare('sender_type', $senderType);
            }

            // Strict 'attributeDest'.
            if ($this->attributeCompare == 'sender_id') {
                $attributeDest = 'sender_text';
            } else {
                $attributeDest = 'receiver_text';
            }
            // Update 'attributeDest' of matching 'Inforequest' records.
            Inforequest::model()->updateAll(
                array($attributeDest => $this->owner->{$this->attributeSource}),
                $criteria
            );
        }
    }
}
