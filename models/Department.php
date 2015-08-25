<?php

namespace models;

use Yii;
use abstracts\ModelAbstract;

/**
 * This is the model class for table "department".
 *
 * @property integer $id
 * @property integer $company_id
 * @property integer $user_id
 * @property string $name
 * @property string $description
 *
 * @property Company $company
 * @property User $user
 * @property DepartmentWorker[] $departmentWorkers
 */
class Department extends ModelAbstract
{
    public static function tableName()
    {
        return 'department';
    }

    public function rules()
    {
        return [
            [['company_id', 'user_id', 'name'], 'required'],
            [['company_id', 'user_id'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
            'user_id' => 'User ID',
            'name' => 'Name',
            'description' => 'Description',
        ];
    }



    // Depending

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartmentWorkers()
    {
        return $this->hasMany(DepartmentWorker::className(), ['department_id' => 'id']);
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
