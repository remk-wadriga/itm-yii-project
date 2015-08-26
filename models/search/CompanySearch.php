<?php
/**
 * Created by PhpStorm.
 * User: Developer
 * Date: 26-08-2015
 * Time: 09:52 AM
 */

namespace models\search;


use Yii;
use yii\base\Model;
use models\User;
use models\Company;
use models\CompanyOwnershipType;
use yii\data\ActiveDataProvider;


class CompanySearch extends Company
{
    public function rules()
    {
        return [
            [['id', 'edrpou'], 'integer'],
            [['name', 'userName', 'ownershipName'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Company::find()
            ->select([
                'c.*',
                'userName' => 'CONCAT_WS(\' \', `u`.`first_name`, `u`.`last_name`)',
                'ownershipName' => 'o.name',
            ])
            ->from(['c' => self::tableName()])
            ->leftJoin(['u' => User::tableName()], 'u.id = c.user_id')
            ->leftJoin(['o' => CompanyOwnershipType::tableName()], 'o.id = c.ownership_id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'id',
                    'name',
                    'userName',
                    'ownershipName',
                    'edrpou',
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'c.id' => $this->id,
            'c.edrpou' => $this->edrpou,
        ]);

        $query
            ->andFilterWhere(['like', 'c.name', $this->name])
            ->andFilterWhere(['like', 'u.first_name', $this->userName])
            ->orFilterWhere(['like', 'u.last_name', $this->userName])
            ->andFilterWhere(['like', 'o.name', $this->ownershipName]);

        return $dataProvider;
    }
}