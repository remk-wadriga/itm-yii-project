<?php

namespace models;

use Yii;
use abstracts\ModelAbstract;

/**
 * This is the model class for table "department_worker".
 *
 * @property integer $department_id
 * @property integer $user_id
 * @property integer $position_id
 * @property double $salary
 *
 * @property Department $department
 * @property Position $position
 * @property User $user
 */
class DepartmentWorker extends ModelAbstract
{
    public static function tableName()
    {
        return 'department_worker';
    }

    public function rules()
    {
        return [
            [['department_id', 'user_id', 'position_id'], 'required'],
            [['department_id', 'user_id', 'position_id'], 'integer'],
            [['salary'], 'number']
        ];
    }

    public function attributeLabels()
    {
        return [
            'department_id' => 'Department ID',
            'user_id' => 'User ID',
            'position_id' => 'Position ID',
            'salary' => 'Salary',
        ];
    }



    // Depending

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosition()
    {
        return $this->hasOne(Position::className(), ['id' => 'position_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
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
