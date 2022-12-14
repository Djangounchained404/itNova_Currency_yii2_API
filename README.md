 Для запуска: 
 1)  common\config\main-local.php -- заменить данные на свои.
 'db' => [
            'class' => \yii\db\Connection::class,
            'dsn' => 'mysql:host=localhost;dbname=itNova',
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
        ],
  2) БД подготовил в миграции. Необходимо инсталл.
  3) Все сделал на Frontend проекте
  4) common\models\Currency.php -- модель для проекта 
  5)\frontend\controllers\SiteController.php -- контролер 
  6) frontend\components\Common.php -- все функции 
  7) \frontend\views\site  -- это вьюхи их не много 
