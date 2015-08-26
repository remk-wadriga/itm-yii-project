<?php
/**
 * Created by Rem.
 * Author: Dmitry Kushneriv
 * Email: remkwadriga@yandex.ua
 * Date: 10-08-2015
 * Time: 14:11 PM
 */

namespace abstracts;

use yii\db\ActiveRecord;

abstract class ModelAbstract extends ActiveRecord
{
    private static $_items;

    /**
     * @return array
     */
    public static function getItems()
    {
        $class = static::className();

        if (isset(self::$_items[$class])) {
            return self::$_items[$class];
        }

        self::$_items[$class] = [
            0 => '---'
        ];

        $itemsList = static::find()
            ->select(static::getItemsNames())
            ->orderBy('name')
            ->asArray()
            ->all();

        if (!empty($itemsList)) {
            foreach ($itemsList as $item) {
                self::$_items[$class][$item['id']] = $item['name'];
            }
        }

        return self::$_items[$class];
    }

    protected static function getItemsNames()
    {
        return ['id', 'name'];
    }
}