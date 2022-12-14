<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Currency extends ActiveRecord
{


    public static function tableName()
    {
        return '{{%currency}}';
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            [['date','date_update'], 'safe'],
            [['AUD', 'AZN', 'GBP', 'AMD',
                'BYN', 'BGN', 'BRL', 'HUF',
                'HKD', 'DKK', 'USD', 'EUR',
                'INR', 'KZT', 'CAD', 'KGS',
                'CNY', 'MDL', 'NOK', 'PLN',
                'RON', 'XDR', 'SGD', 'TJS',
                'TRY', 'TMT', 'UZS', 'UAH',
                'CZK', 'SEK', 'CHF', 'ZAR',
                'KRW', 'JPY'], 'safe'],


        ];
    }

    public function attributeLabels()
    {
        return [
            'date'=>'Дата',
            'AUD' =>'Австралийский доллар',
            'AZN' =>'Азербайджанский манат',
            'GBP' =>'Фунт стерлингов Соединенного королевства',
            'AMD' =>'Армянских драмов',
            'BYN' =>'Белорусский рубль',
            'BGN' =>'Болгарский лев',
            'BRL' =>'Бразильский реал',
            'HUF' =>'Венгерских форинтов',
            'HKD' =>'Гонконгских долларов',
            'DKK' =>'Датских крон',
            'USD' =>'Доллар США',
            'EUR' =>'Евро',
            'INR' =>'Индийских рупий',
            'KZT' =>'Казахстанских тенге',
            'CAD' =>'Канадский доллар',
            'KGS' =>'Киргизских сомов',
            'CNY' =>'Китайских юаней',
            'MDL' =>'Молдавских леев',
            'NOK' =>'Норвежских крон',
            'PLN' =>'Польский злотый',
            'RON' =>'Румынский лей',
            'XDR' =>'СДР (специальные права заимствования)',
            'SGD' =>'Сингапурский доллар',
            'TJS' =>'Таджикских сомони',
            'TRY' =>'Турецких лир',
            'TMT' =>'Новый туркменский манат',
            'UZS' =>'Узбекских сумов',
            'UAH' =>'Украинских гривен',
            'CZK' =>'Чешских крон',
            'SEK' =>'Шведских крон',
            'CHF' =>'Швейцарский франк',
            'ZAR' =>'Южноафриканских рэндов',
            'KRW' =>'Вон Республики Корея',
            'JPY' =>'Японских иен',

        ];
    }
}