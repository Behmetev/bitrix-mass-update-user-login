<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<?
$filter = Array
(
    //Массив для фильтрации пользователей
    //"ID"                  => "1 | 2",
    "TIMESTAMP_1"         => "04.02.2019", // в формате текущего сайта
    "TIMESTAMP_2"         => "04.02.2020",
    //"LAST_LOGIN_1"        => "01.02.2004",
    "ACTIVE"              => "Y",
    //"LOGIN"               => "",
    //"NAME"                => "",
    //"EMAIL"               => "mail1@server.com | mail2@server.com",
    //"KEYWORDS"            => "",
    //"PERSONAL_PROFESSION" => "",
    //"PERSONAL_GENDER"     => "M",
    //"PERSONAL_COUNTRY"    => "4 | 1", // Беларусь или Россия
    //"ADMIN_NOTES"         => "",
    //"GROUPS_ID"           => Array(1,4,10)
);

$rsUsers = CUser::GetList(($by="id"), ($order="desc"), $filter); // выбираем пользователей
$is_filtered = $rsUsers->is_filtered;

while($rsUsers->NavNext(true, "f_")) :
    if ($f_LOGIN != $f_EMAIL){
        echo  "[".$f_ID."] (".$f_LOGIN.") ".$f_EMAIL." ".$f_PERSONAL_PHONE."<br>";
        $user = new CUser;
        $fields = Array(
            //Рбязательные поля для сохранения пользователя (могут отличатся)
            "EMAIL" => $f_EMAIL,
            "LOGIN" => $f_EMAIL,
            "PERSONAL_PHONE" => $f_PERSONAL_PHONE
        );
        echo "<pre>";
        print_r($fields);
        echo "</pre>";
        $user->Update($f_ID, $fields);
        $strError .= $user->LAST_ERROR;
    }
endwhile;
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>