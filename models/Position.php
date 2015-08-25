<?php

namespace models;

use Yii;
use abstracts\ModelAbstract;

/**
 * This is the model class for table "position".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 *
 * @property DepartmentWorker[] $departmentWorkers
 */
class Position extends ModelAbstract
{
    public static function tableName()
    {
        return 'position';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
        ];
    }



    // Depending

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartmentWorkers()
    {
        return $this->hasMany(DepartmentWorker::className(), ['position_id' => 'id']);
    }

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
