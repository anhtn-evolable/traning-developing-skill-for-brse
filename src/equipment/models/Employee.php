<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "employee".
 *
 * @property int $id
 * @property string $name
 * @property int $data_status
 * @property string $employee_no
 * @property int $working_status
 *
 * @property string $dataStatusStr
 *
 * @property LendingHistory[] $lendingHistories
 */
class Employee extends \yii\db\ActiveRecord
{
    const DATA_STATUS_NORMAL = 1;
    const DATA_STATUS_DELETED = 9;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['data_status', 'working_status'], 'default', 'value' => null],
            [['data_status', 'working_status'], 'integer'],
            [['name', 'employee_no'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'data_status' => Yii::t('app', 'Data Status'),
            'employee_no' => Yii::t('app', 'Employee No'),
            'working_status' => Yii::t('app', 'Working Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLendingHistories()
    {
        return $this->hasMany(LendingHistory::className(), ['employee_id' => 'id']);
    }

    public static function dataStatusOptionArr()
    {
      return [
        self::DATA_STATUS_NORMAL => '�ʏ�',
        self::DATA_STATUS_DELETED => '�폜',
      ];
    }
    
    public function getDataStatusStr()
    {
      return ArrayHelper::getValue(self::dataStatusOptionArr(), $this->data_status);
    }
}
