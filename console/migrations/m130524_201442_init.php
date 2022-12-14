<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

//        ALTER TABLE `sibers_users` ADD `USD` DECIMAL(6,4) NULL AFTER `role`;

        $this->createTable('{{%currency}}', [
            'id' => $this->primaryKey(),
            'date' => $this->integer(12)->notNull(),
            'date_update' => $this->integer(12)->Null(),
            'AUD' => $this->decimal(7,4)->Null()->comment("Австралийский доллар"),
            'AZN' => $this->decimal(7,4)->Null()->comment("Азербайджанский манат"),
            'GBP' => $this->decimal(7,4)->Null()->comment("Фунт стерлингов Соединенного королевства"),
            'AMD' => $this->decimal(7,4)->Null()->comment("Армянских драмов"),
            'BYN' => $this->decimal(7,4)->Null()->comment("Белорусский рубль"),
            'BGN' => $this->decimal(7,4)->Null()->comment("Болгарский лев"),
            'BRL' => $this->decimal(7,4)->Null()->comment("Бразильский реал"),
            'HUF' => $this->decimal(7,4)->Null()->comment("Венгерских форинтов"),
            'HKD' => $this->decimal(7,4)->Null()->comment("Гонконгских долларов"),
            'DKK' => $this->decimal(7,4)->Null()->comment("Датских крон"),
            'USD' => $this->decimal(7,4)->Null()->comment("Доллар США"),
            'EUR' => $this->decimal(7,4)->Null()->comment("Евро"),
            'INR' => $this->decimal(7,4)->Null()->comment("Индийских рупий"),
            'KZT' => $this->decimal(7,4)->Null()->comment("Казахстанских тенге"),
            'CAD' => $this->decimal(7,4)->Null()->comment("Канадский доллар"),
            'KGS' => $this->decimal(7,4)->Null()->comment("Киргизских сомов"),
            'CNY' => $this->decimal(7,4)->Null()->comment("Китайских юаней"),
            'MDL' => $this->decimal(7,4)->Null()->comment("Молдавских леев"),
            'NOK' => $this->decimal(7,4)->Null()->comment("Норвежских крон"),
            'PLN' => $this->decimal(7,4)->Null()->comment("Польский злотый"),
            'RON' => $this->decimal(7,4)->Null()->comment("Румынский лей"),
            'XDR' => $this->decimal(7,4)->Null()->comment("СДР (специальные права заимствования)"),
            'SGD' => $this->decimal(7,4)->Null()->comment("Сингапурский доллар"),
            'TJS' => $this->decimal(7,4)->Null()->comment("Таджикских сомони"),
            'TRY' => $this->decimal(7,4)->Null()->comment("Турецких лир"),
            'TMT' => $this->decimal(7,4)->Null()->comment("Новый туркменский манат"),
            'UZS' => $this->decimal(7,4)->Null()->comment("Узбекских сумов"),
            'UAH' => $this->decimal(7,4)->Null()->comment("Украинских гривен"),
            'CZK' => $this->decimal(7,4)->Null()->comment("Чешских крон"),
            'SEK' => $this->decimal(7,4)->Null()->comment("Шведских крон"),
            'CHF' => $this->decimal(7,4)->Null()->comment("Швейцарский франк"),
            'ZAR' => $this->decimal(7,4)->Null()->comment("Южноафриканских рэндов"),
            'KRW' => $this->decimal(7,4)->Null()->comment("Вон Республики Корея"),
            'JPY' => $this->decimal(7,4)->Null()->comment("Японских иен"),




//            'username' => $this->string()->notNull()->unique(),
//            'auth_key' => $this->string(32)->notNull(),
//            'password_hash' => $this->string()->notNull(),
//            'password_reset_token' => $this->string()->unique(),
//            'email' => $this->string()->notNull()->unique(),
//
//            'status' => $this->smallInteger()->notNull()->defaultValue(10),
//            'created_at' => $this->integer()->notNull(),
//            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
