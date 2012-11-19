<?php

/**
 * MultiUploadBehavior takes care of multi file uploads for models.
 */
class MultiUploadBehavior extends CActiveRecordBehavior
{
    public $attributes = array();

    /**
     * Transforms string attributes to array.
     */
    public function afterFind()
    {
        foreach ($this->attributes as $attr) {
            if (empty($this->owner->$attr)) {
                $this->owner->$attr = array();
            } else {
                $this->owner->$attr = explode(',', $this->owner->$attr);
            }
        }
    }

    /**
     * Saves all upload files with model.
     */
    public function beforeSave()
    {
        foreach ($this->attributes as $attr) {
            // Ensure attribute is array.
            if (empty($this->owner->$attr)) {
                $this->owner->$attr = array();
            }

            $upload = CUploadedFile::getInstances($this->owner, $attr);
            $uploadNames = array();

            foreach ($upload as $file) {
                $filename = uniqid() . '.' . $file->getExtensionName();
                $file->saveAs($this->getUploadPath($attr, $filename));
                $uploadNames[] = $filename;
            }

            // Combine attribute with new uploads.
            $uploadNames = array_merge($this->owner->$attr, $uploadNames);
            if (empty($uploadNames)) {
                $this->owner->$attr = '';
            } else {
                $this->owner->$attr = implode(',', $uploadNames);
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
