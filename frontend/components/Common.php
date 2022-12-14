<?php

namespace frontend\components;

use function Symfony\Component\String\s;
use Yii;

use common\models\Currency;
use yii\base\Component;
use yii\helpers\ArrayHelper;
use yii\httpclient\Client;
use yii\db\Connection;

class Common extends Component
{


    public static function arrСhoiceСurrency ()  {  //ункция получени кода валюты для выбора
        $date = date('d.m.Y');
        $url = "http://www.cbr.ru/scripts/XML_daily.asp?date_req=$date"; // URL, XML документ, всегда содержит актуальные данные


        if (!$xml = simplexml_load_file($url)) die('Ошибка загрузки XML');
        for ($i = 0; $i < count($xml); $i++) {
            $idArrСhoiceСurrency[$i] = [
                "CharCode" => $xml->Valute[$i]->CharCode->__toString(),
            ];
?>

    <?}
    return  $idArrСhoiceСurrency; // передается масив в ajax.php
    }


    public static function fullArrDataGiven () { // функция для получения общего масива с  www.cbr.ru перебором данных

        $date = date('d.m.Y');
        //$date = date('10.12.2022');
        $url = "http://www.cbr.ru/scripts/XML_daily.asp?date_req=$date"; // URL, XML документ, всегда содержит актуальные данные
        $idArr = [];
        if (!$xml = simplexml_load_file($url)) die('Ошибка загрузки XML');

        for ($i = 0; $i < count($xml); $i++) {

            $idArr[$i] = [
                "ID" => $xml->Valute[$i]->attributes()->__toString(),
                "NumCode" => $xml->Valute[$i]->NumCode->__toString(),
                "date" => $date,
                "CharCode" => $xml->Valute[$i]->CharCode->__toString(),
                "Nominal" => $xml->Valute[$i]->Nominal->__toString(),
                "Name" => $xml->Valute[$i]->Name->__toString(),
                "Value" => $xml->Valute[$i]->Value->__toString(),
            ];
        }

        return  $idArr ;

    }






        public static function changeStringToFloat ($var) { //функция колдовства в флоат из стринга

        $first = str_replace(',','.',$var);
        $second =floatval($first);
        return $second;
    }




    public static function сurrencyAddViews ($fullArr){  // вывод в виде блока данные по кажой валюте
        if (!empty($fullArr)) {

 foreach ($fullArr as $items){?>
                    <div class="col-8 col-xxl-3 col-xl-3 col-lg-4  col-md-4 col-sm-5 currency_show ">
                        <div class="list-group list-group_currency_show ">
                            <div class="d-flex w-100 justify-content-between  content_currency_name">
                                <h5 class="mb-1 content_currency"><?=$items["Name"]?></h5>
                            </div>
                            <small class="content_currency">Дата: <?=$items["date"]?></small>
                            <p class="mb-1 content_currency">ID: <?=$items["ID"]?></p>
                            <p class="mb-1 content_currency">Код валюты: <?=$items["NumCode"]?></p>
                            <p class="mb-1 content_currency">Сокращение: <?=$items["CharCode"]?></p>
                            <p class="mb-1 content_currency">Количество: <?=$items["Nominal"]?></p>
                            <p class="mb-1 content_currency">Стоимость  <?=$items["Value"]?> руб.</p>

                            <?
                            if (!isset(Currency::find()->orderBy(['id' => SORT_DESC])->offset(1)->one()["id"]) ) { //проверка на наличие предидущей записи в БД
                                ?>
                                <div class="col-12  content_currency_comparison " style="background-color: red">
                                    <p class="mb-1 content_currency content_currency_2" >"Нет ранее полученого значения"</p>
                                </div>
                                <?
                            }
                            else {
                                $var_1 = self::changeStringToFloat(Currency::find()->orderBy(['id' => SORT_DESC])->offset(1)->one()[$items["CharCode"]]); // перевод во влоат значение из БД
                                $var_2 = self::changeStringToFloat ($items["Value"]);// перевод во влоат значение из масива (текущее)
                                if ($var_2>$var_1) {
                                    ?>
                                    <div class="col-12 content_currency_comparison" style="background-color: green">
                                        <p class="mb-1 content_currency content_currency_2" ><?= Currency::find()->orderBy(['id' => SORT_DESC])->offset(1)->one()[$items["CharCode"]]?></p>
                                    </div>
                                    <?
                                }
                                else if ($var_2<$var_1) {
                                    ?>
                                    <div class="col-12 content_currency_comparison" style="background-color: red">
                                        <p class="mb-1 content_currency content_currency_2"><?= Currency::find()->orderBy(['id' => SORT_DESC])->offset(1)->one()[$items["CharCode"]]?></p>
                                    </div>
                                    <?
                                }
                                else if ($var_2==$var_1) {
                                    ?>
                                    <div class="col-12 content_currency_comparison" style="background-color: #5c636a">
                                        <p class="mb-1 content_currency content_currency_2"><?= Currency::find()->orderBy(['id' => SORT_DESC])->offset(1)->one()[$items["CharCode"]]?></p>
                                    </div>
                                    <?
                                }

                            }

                            // блок для даты в блоке информации о валюте

                            if (!empty(Currency::find()->orderBy(['date_update' => SORT_DESC])->offset(0)->one()['date_update'])) {
                                $date_update_val = date("d.m.Y H:i", Currency::find()->orderBy(['id' => SORT_DESC])->offset(0)->one()['date_update']);
                            }
                            elseif (!empty(Currency::find()->orderBy(['date' => SORT_DESC])->offset(0)->one()['date'])){
                                $date_update_val = date("d.m.Y H:i", Currency::find()->orderBy(['id' => SORT_DESC])->offset(0)->one()['date']);
                            }
                            else {
                                $date_update_val =  date("d.m.Y H:i");
                            }
                            ?>


                           <div class="col-12" >
                                <p class="mb-1 content_currency  content_currency_2" >Дата обновления: <?=$date_update_val?></p>
                            </div>


                        </div>
                    </div>
<?
                        }


                }
         else {
             //здесь переход на страницу эрор404 потом напишу

                    }
        }





          public static function showDb ($arrData) {  // вот тут немного мутно но по другому не придумал как записывать в БД


        $dbData = new Currency(); // \common\models\Currency.php там создал модель , здесь обратился
        if (!empty($arrData)) { // проверка на пустой масив


         if (!isset(Currency::find()->orderBy(['id' => SORT_DESC])->offset(0)->one()["id"]) ) {     //База пустая

                 for ($i = 0; $i < count($arrData); $i++) { //перебераем полученный массив
                     $tmpChar = $arrData[$i]["CharCode"];
                     $tmpVal = str_replace(',', '.', $arrData[$i]["Value"]);
                     $tmpVal = floatval($tmpVal);//первод значения в флоат
                     $dbData->$tmpChar = $tmpVal;//закидываем в модель
                     }
                     $dbData->date = strtotime($arrData[0]["date"]);
                     $dbData->save();  // сохраняем в БД
         }



         else if (isset(Currency::find()->orderBy(['id' => SORT_DESC])->offset(0)->one()["id"])){  //База не пустая при условии что 1 запись в БД

             $tmpArr = []; //масив для поля которое требуется заменить.
             $var_comparison = Currency::find()->orderBy(['id' => SORT_DESC])->offset(0)->one()['date']; //Дата из БД текущей записи
             $dbData->date = strtotime($arrData[0]["date"]);

             if ($dbData->date==$var_comparison) {   //проверить на дату перепроверить!!! Сравнивание даты из БД текущей записи с датой из масива.



                             for ($i = 0; $i < count($arrData); $i++) {     //перебераем полученный массив
                                 $tmpChar = $arrData[$i]["CharCode"];
                                 $tmpVal = str_replace(',', '.', $arrData[$i]["Value"]);
                                 $tmpVal = floatval($tmpVal);  //первод значения в флоат

                                 $dbData->$tmpChar = $tmpVal; //закидываем в модель


                                 $var_comparison_data = self::changeStringToFloat(Currency::find()->orderBy(['id' => SORT_DESC])->offset(0)->one()[$arrData[$i]["CharCode"]]); // это записи из БД текущей записи для проверки на одинаковые значения.
                                 if ($tmpVal != $var_comparison_data) { // условие сравнения данных по каждому полю
                                     $tmpArr[$tmpChar] = $tmpVal;   // запись в масив данных которые различаются

                                 }
                                 }
                                                 if (!empty($tmpArr)) {  // условие на пустоту масива
                                                   foreach ($tmpArr as $key=>$valCharCode) { // перебор масива

                                                       $idForComparison=Currency::find()->orderBy(['id' => SORT_DESC])->offset(0)->one()["id"]; // получение id текущей записи

                                                       $findeCharCode = Currency::findOne($idForComparison); //берем строку из бд для правки значений
                                                       $findeCharCode->$key= $valCharCode; // берем значение
                                                      $findeCharCode->update(); // записываем в БД

                                                   }
                                                     $findeCharCode->date_update= time(); // записываем в БД время обновления.
                                                     $findeCharCode->update(); // записываем в БД
                                                 }
                    }
             else{
                 $dbDataNew = new Currency();

                 for ($i = 0; $i < count($arrData); $i++) { //перебераем полученный массив
                     $tmpChar = $arrData[$i]["CharCode"];
                     $tmpVal = str_replace(',', '.', $arrData[$i]["Value"]);
                     $tmpVal = floatval($tmpVal);//первод значения в флоат
                     $dbDataNew->$tmpChar = $tmpVal;//закидываем в модель
                 }
                 $dbDataNew->date = strtotime($arrData[0]["date"]);
                 $dbDataNew->save();  // сохраняем в БД

             }

             }
         }

          }



    public static function showIsTheGun ($arrShowCur) { // функция для получения валюты при выборе в ajax.php

        $date = date('d.m.Y');
        //$date = date('14.12.2022');
        $url = "http://www.cbr.ru/scripts/XML_daily.asp?date_req=$date"; // URL, XML документ, всегда содержит актуальные данные
        $idArr = [];
        $arrTmp=[];
        if (!$xml = simplexml_load_file($url)) die('Ошибка загрузки XML');

        for ($i = 0; $i < count($xml); $i++) {

            $idArr[$i] = [
                "ID" => $xml->Valute[$i]->attributes()->__toString(),
                "NumCode" => $xml->Valute[$i]->NumCode->__toString(),
                "date" => $date,
                "CharCode" => $xml->Valute[$i]->CharCode->__toString(),
                "Nominal" => $xml->Valute[$i]->Nominal->__toString(),
                "Name" => $xml->Valute[$i]->Name->__toString(),
                "Value" => $xml->Valute[$i]->Value->__toString(),
            ];
        }


        for ($t=0; $t<count($idArr); $t++){ //перебераем на совпадение старый масив и требуемых значений

                    for ($y=0;$y<count($arrShowCur);$y++){

                        if ($idArr[$t]['CharCode'] == $arrShowCur[$y] ){
                            $arrTmp[$y]=$idArr[$t]; // получаем масив с выбранной валютой.
                        }
                    }


        }

        self::сurrencyAddViews($arrTmp);

    }





}