<?php
/**
 * @copyright Copyright (C) 2015-2017 AIZAWA Hina
 * @license https://github.com/fetus-hina/stat.ink/blob/master/LICENSE MIT
 * @author AIZAWA Hina <hina@bouhime.com>
 */

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "timezone_group".
 *
 * @property integer $id
 * @property integer $order
 * @property string $name
 *
 * @property Timezone[] $timezones
 */
class TimezoneGroup extends ActiveRecord
{
    public static function find()
    {
        return parent::find()
            ->with('timezones')
            ->orderBy([
                'order' => SORT_ASC,
            ]);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'timezone_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order', 'name'], 'required'],
            [['order'], 'default', 'value' => null],
            [['order'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['order'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order' => 'Order',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTimezones()
    {
        return $this->hasMany(Timezone::class, ['group_id' => 'id']);
    }
}
