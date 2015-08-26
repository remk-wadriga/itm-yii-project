<?php

namespace models;

use Yii;
use abstracts\ModelAbstract;

/**
 * This is the model class for table "company".
 *
 * @property integer $id
 * @property string $name
 * @property integer $user_id
 * @property integer $ownership_id
 * @property integer $edrpou
 * @property string $web_address
 * @property string $jur_address
 * @property string $phy_address
 * @property string $postcode
 * @property string $postbox
 * @property string $description
 * @property string $create_date
 * @property string $last_edit_time
 *
 * @property CompanyToSphere[] $companyToSpheres
 * @property CompanySphere[] $spheres
 * @property CompanyOwnershipType $ownership
 * @property User $user
 * @property CompanyRequisite[] $companyRequisites
 * @property Department[] $departments
 *
 * @property integer $userId
 * @property integer $ownershipId
 * @property string $webAddress
 * @property string $jurAddress
 * @property string $phyAddress
 * @property string $createDate
 * @property string $lastEditTime
 *
 * @property array $usersItems
 * @property array $ownershipsItems
 */
class Company extends ModelAbstract
{
    private $_usersItems;

    private $_ownershipsItems;
    
    public $userName;
    public $ownershipName;

    public static function tableName()
    {
        return 'company';
    }

    public function rules()
    {
        return [
            [['name', 'edrpou', 'web_address', 'jur_address', 'phy_address'], 'required'],
            [['user_id', 'ownership_id', 'userId', 'ownershipId', 'edrpou'], 'integer'],
            [['description'], 'string'],
            [['create_date', 'last_edit_time', 'createDate', 'lastEditTime', 'userName', 'ownershipName'], 'safe'],
            [['name', 'web_address', 'jur_address', 'phy_address', 'webAddress', 'jurAddress', 'phyAddress'], 'string', 'max' => 255],
            [['postcode', 'postbox'], 'string', 'max' => 8]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'userId' => 'User ID',
            'ownershipId' => 'Ownership ID',
            'edrpou' => 'Edrpou',
            'webAddress' => 'Web Address',
            'jurAddress' => 'Jur Address',
            'phyAddress' => 'Phy Address',
            'postcode' => 'Postcode',
            'postbox' => 'Postbox',
            'description' => 'Description',
            'createDate' => 'Create Date',
            'lastEditTime' => 'Last Edit Time',
            'userName' => 'User',
            'ownershipName' => 'Ownership'
        ];
    }



    // Depending

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanyToSpheres()
    {
        return $this->hasMany(CompanyToSphere::className(), ['company_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpheres()
    {
        return $this->hasMany(CompanySphere::className(), ['id' => 'sphere_id'])->viaTable('company_to_sphere', ['company_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwnership()
    {
        return $this->hasOne(CompanyOwnershipType::className(), ['id' => 'ownership_id']);
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
    public function getCompanyRequisites()
    {
        return $this->hasMany(CompanyRequisite::className(), ['company_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Department::className(), ['company_id' => 'id']);
    }

    // END Depending


    // Event handlers

    public function beforeSave($insert)
    {
        $dateTime = Yii::$app->timeService->getCurrentDateTime();

        if (!$this->userId) {
            $this->userId = Yii::$app->user->id;
        }
        if (!$this->createDate) {
            $this->createDate = $dateTime;
        }
        if (!$this->isNewRecord && !$this->lastEditTime) {
            $this->lastEditTime = $dateTime;
        }

        return parent::beforeSave($insert);
    }

    // END Event handlers


    // Getters and setters

    //userId
    public function setUserId($val)
    {
        $this->user_id = $val;
    }
    public function getUserId()
    {
        return $this->user_id;
    }

    //ownershipId
    public function setOwnershipId($val)
    {
        $this->ownership_id = $val;
    }
    public function getOwnershipId()
    {
        return $this->ownership_id;
    }

    //webAddress
    public function setWebAddress($val)
    {
        $this->web_address = $val;
    }
    public function getWebAddress()
    {
        return $this->web_address;
    }

    //jurAddress
    public function setJurAddress($val)
    {
        $this->jur_address = $val;
    }
    public function getJurAddress()
    {
        return $this->jur_address;
    }

    //phyAddress
    public function setPhyAddress($val)
    {
        $this->phy_address = $val;
    }
    public function getPhyAddress()
    {
        return $this->phy_address;
    }

    //createDate
    public function setCreateDate($val)
    {
        $this->create_date = $val;
    }
    public function getCreateDate()
    {
        return $this->create_date;
    }

    //lastEditTime
    public function setLastEditTime($val)
    {
        $this->last_edit_time = $val;
    }
    public function getLastEditTime()
    {
        return $this->last_edit_time;
    }

    // END Getters and setters


    // Public methods

    /**
     * getUsersItems
     * @return array
     */
    public function getUsersItems()
    {
        if ($this->_usersItems !== null) {
            return $this->_usersItems;
        }
        $this->_usersItems = [
            0 => '---',
        ];

        $users = User::find()
            ->select([
                'id',
                'first_name',
                'last_name',
            ])
            ->orderBy('first_name')
            ->asArray()
            ->all();

        if (!empty($users)) {
            foreach($users as $user){
                $this->_usersItems[$user['id']] = $user['first_name'] . ' ' . $user['last_name'];
            }
        }

        return $this->_usersItems;
    }

    /**
     * getOwnershipsItems
     * @return array
     */
    public function getOwnershipsItems()
    {
        if ($this->_ownershipsItems !== null) {
            return $this->_ownershipsItems;
        }
        $this->_ownershipsItems = [
            0 => '---',
        ];

        $ownerships = CompanyOwnershipType::find()
            ->select([
                'id',
                'name',
            ])
            ->orderBy('name')
            ->asArray()
            ->all();

        if (!empty($ownerships)) {
            foreach($ownerships as $ownership){
                $this->_ownershipsItems[$ownership['id']] = $ownership['name'];
            }
        }

        return $this->_ownershipsItems;
    }

    // END Public methods


    // Protected methods

    // END Protected methods


    // Implements <some interface>

    // END Implements <some interface>
}
