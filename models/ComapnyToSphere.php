<?php

namespace models;

use Yii;
use abstracts\ModelAbstract;

/**
 * This is the model class for table "company_to_sphere".
 *
 * @property integer $company_id
 * @property integer $sphere_id
 *
 * @property Company $company
 * @property CompanySphere $sphere
 */
class CompanyToSphere extends ModelAbstract
{
    public static function tableName()
    {
        return 'company_to_sphere';
    }

    public function rules()
    {
        return [
            [['company_id', 'sphere_id'], 'required'],
            [['company_id', 'sphere_id'], 'integer']
        ];
    }

    public function attributeLabels()
    {
        return [
            'company_id' => 'company ID',
            'sphere_id' => 'Sphere ID',
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
    public function getSphere()
    {
        return $this->hasOne(CompanySphere::className(), ['id' => 'sphere_id']);
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
