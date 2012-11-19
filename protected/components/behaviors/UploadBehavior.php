<?php

class UploadBehavior extends CActiveRecordBehavior
{
    public $attributes = array();

    /**
     * Saves upload file with model and removes old one.
     */
    public function beforeSave()
    {
        foreach ($this->attributes as $attr) {
            $upload = CUploadedFile::getInstance($this->owner, $attr);

            if ($upload) {
                // Remove old upload.
                // if (isset($this->owner->$attr)) {
                if ($this->owner->$attr) {
                    $this->deleteUpload($attr);
                }

                // Save new upload.
                $filename = uniqid() . '.' . $upload->getExtensionName();
                $upload->saveAs($this->getUploadPath($attr, $filename));
                $this->owner->$attr = $filename;
            }
        }
    }

    /**
     * Remove all uploads from all attributes.
     */
    public function afterDelete()
    {
        foreach ($this->attributes as $attr) {
            $this->deleteUpload($attr);
        }
    }

    /**
     * Creates full path for upload file.
     */
    public function getUploadPath($attribute, $filename)
    {
        return Yii::getPathOfAlias('webroot')
            . '/uploads/'
            . strtolower(get_class($this->owner)) . '/'
            . $attribute . '/'
            . $filename;
    }

    /**
     * Creates relative URL for upload file.
     */
    public function getUploadUrl($attribute, $filename)
    {
        return Yii::app()->createUrl('uploads/'
            . strtolower(get_class($this->owner)) . '/'
            . $attribute . '/'
            . $filename);
    }

    /**
     * Finds uploaded files by their attribute or name and deletes them.
     */
    public function deleteUpload($attribute, $filename = '')
    {
        // Don't delete with empty attribute field.
        if (empty($this->owner->$attribute)) {
            return;
        }

        // Multi upload: attribute got several files.
        if (is_array($this->owner->$attribute)) {
            // No specific name, remove all files from attribute.
            if (empty($filename)) {
                foreach ($this->owner->$attribute as $f) {
                    // Don't delete placeholder image.
                    if ($f != 'placeholder.jpg') {
                        unlink($this->getUploadPath($attribute, $f));
                    }
                }
                // Empty whole attribute.
                $this->owner->$attribute = array();
            // Name specified, delete only one file from attribute.
            } else {
                // Don't delete placeholder image.
                if ($filename != 'placeholder.jpg') {
                    unlink($this->getUploadPath($attribute, $filename));
                }
                // Empty one element from attribute.
                $this->owner->$attribute = array_diff($this->owner->$attribute, array($filename));
            }
        // Regular upload: attribute got single file.
        } else {
            // Don't delete placeholder image.
            if ($this->owner->$attribute != 'placeholder.jpg') {
                unlink($this->getUploadPath($attribute, $this->owner->$attribute));
            }
            // Empty whole attribute.
            $this->owner->$attribute = '';
        }
    }
}
