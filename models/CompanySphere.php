<?php

namespace models;

use Yii;
use abstracts\ModelAbstract;

/**
 * This is the model class for table "company_sphere".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 *
 * @property companyToSphere[] $companyToSpheres
 * @property Company[] $companies
 */
class CompanySphere extends ModelAbstract
{
    public static function tableName()
    {
        return 'company_sphere';
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
    public function getCompanyToSpheres()
    {
        return $this->hasMany(companyToSphere::className(), ['sphere_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies()
    {
        return $this->hasMany(Company::className(), ['id' => 'company_id'])->viaTable('company_to_sphere', ['sphere_id' => 'id']);
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
