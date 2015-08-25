<?php

namespace models;

use Yii;
use abstracts\ModelAbstract;

/**
 * This is the model class for table "company_requisite".
 *
 * @property integer $id
 * @property integer $company_id
 * @property integer $currency_id
 * @property string $bank_name
 * @property string $account
 * @property string $mfo
 *
 * @property Company $company
 * @property Currency $currency
 */
class CompanyRequisite extends ModelAbstract
{
    public static function tableName()
    {
        return 'company_requisite';
    }

    public function rules()
    {
        return [
            [['company_id', 'currency_id', 'bank_name', 'account', 'mfo'], 'required'],
            [['company_id', 'currency_id'], 'integer'],
            [['bank_name'], 'string', 'max' => 255],
            [['account'], 'string', 'max' => 16],
            [['mfo'], 'string', 'max' => 8]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
            'currency_id' => 'Currency ID',
            'bank_name' => 'Bank Name',
            'account' => 'Account',
            'mfo' => 'Mfo',
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
    public function getCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currency_id']);
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
