<?php

namespace models;

use Yii;
use abstracts\ModelAbstract;

/**
 * This is the model class for table "icon".
 *
 * @property integer $id
 * @property string $class
 */
class Icon extends ModelAbstract
{
    public static function tableName()
    {
        return 'icon';
    }

    public function rules()
    {
        return [
            [['class'], 'required'],
            [['class'], 'string', 'max' => 24]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'class' => 'Class',
        ];
    }

    // Depending

    // END Depending


    // Event handlers

    // END Event handlers


    // Getters and setters

    // END Getters and setters


    // Public methods

    // END Public methods


    // Protected methods

    // END Protected methods


    // Implements <some interface>

    // END Implements <some interface>
}
