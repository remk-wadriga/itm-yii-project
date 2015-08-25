<?php

namespace models;

use Yii;
use abstracts\ModelAbstract;

/**
 * This is the model class for table "currency".
 *
 * @property integer $id
 * @property integer $icon_id
 * @property string $name
 * @property string $code
 *
 * @property CompanyRequisite[] $companyRequisites
 */
class Currency extends ModelAbstract
{
    public static function tableName()
    {
        return 'currency';
    }

    public function rules()
    {
        return [
            [['icon_id'], 'integer'],
            [['name', 'code'], 'required'],
            [['name'], 'string', 'max' => 54],
            [['code'], 'string', 'max' => 4]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'icon_id' => 'Icon ID',
            'name' => 'Name',
            'code' => 'Code',
        ];
    }



    // Depending

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanyRequisites()
    {
        return $this->hasMany(CompanyRequisite::className(), ['currency_id' => 'id']);
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
