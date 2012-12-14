<?php

class UploadBehavior extends CActiveRecordBehavior
{
    public $attributes = array();
    public $originalModel;
    public $uploadOffset;

    /**
     * Allow upload attributes to only store not empty 'CUploadedFile' or
     * original filenames and not some random strings.
     */
    public function beforeValidate()
    {
        // Remember original model.
        $originalClass = get_class($this->owner);
        if ($this->owner->isNewRecord) {
            $this->originalModel = new $originalClass;
        } else {
            $this->originalModel = call_user_func($originalClass . '::model')->findByPk($this->owner->id);
        }

        foreach ($this->attributes as $attr) {
            // Apply offset to upload.
            if (isset($this->uploadOffset)) {
                $upload = CUploadedFile::getInstance($this->owner, "[$this->uploadOffset]$attr");
            } else {
                $upload = CUploadedFile::getInstance($this->owner, $attr);
            }

            // Override attribute only with 'CUploadedFile'.
            if (empty($upload)) {
                $this->owner->$attr = $this->originalModel->$attr;
            } else {
                $this->owner->$attr = $upload;
            }
        }
    }

    /**
     * Saves files with model attributes and deletes old ones.
     */
    public function beforeSave()
    {
        foreach ($this->attributes as $attr) {
            if ($this->owner->$attr instanceof CUploadedFile) {
                // Save new upload and set new filename to attribute.
                $upload = $this->owner->$attr;
                $this->owner->$attr = uniqid() . '.' . $upload->getExtensionName();
                $upload->saveAs($this->getUploadPath($attr));

                // Delete old upload on update.
                if (!$this->owner->isNewRecord) {
                    $this->originalModel->deleteUpload($attr);
                }
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
     * @param string $attribute the name of upload model attribute.
     * @return string unix path.
     */
    public function getUploadPath($attribute)
    {
        return Yii::getPathOfAlias('webroot')
            . '/uploads/'
            . strtolower(get_class($this->owner)) . '/'
            . $attribute . '/'
            . $this->owner->$attribute;
    }

    /**
     * Creates relative URL for upload file.
     * @param string $attribute the name of upload model attribute.
     * @return string full URL.
     */
    public function getUploadUrl($attribute)
    {
        return Yii::app()->createUrl('uploads/'
            . strtolower(get_class($this->owner)) . '/'
            . $attribute . '/'
            . $this->owner->$attribute
        );
    }

    /**
     * Finds and deletes uploaded file by its attribute.
     * @param string $attribute the name of upload model attribute.
     */
    public function deleteUpload($attribute)
    {
        // Don't delete with empty attribute field.
        // Don't delete placeholder image.
        if (!empty($this->owner->$attribute) && $this->owner->$attribute != 'placeholder.jpg') {
            // Remove file.
            unlink($this->getUploadPath($attribute));

            // Empty attribute.
            $this->owner->$attribute = '';
        }
    }
}
