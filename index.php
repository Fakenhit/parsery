<?php
	function getPageByUrl ($url)
	{
		//Инициализируем сеанс
		$curl = curl_init($url);
        @curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.128 Safari/537.36");
        curl_setopt($curl, CURLOPT_ENCODING,"gzip,deflate");
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);

		//Указываем адрес страницы
		//curl_setopt($curl, CURLOPT_URL, $url);

		$result = curl_exec($curl);

		//Отлавливаем ошибки подключения
		if ($result === false) {			echo "Ошибка CURL: " . curl_error($curl);
			return false;
		} else {
			return $result;
		}
	}
    // $array_query = ["Электропускатели"]; in_array # TODO
	$htg = getPageByUrl("https://essonline.uz/");
    $htg2 = <<<SITE
        {$htg}
    SITE;
    // $re = '/([+]{0,1}[\d\-)( ]{10,})/m';
    $re = '/([+]{0,1}[35789()]{1}[\d\-)( ]{9,})/m';
    // echo $htg;
    preg_match_all($re, $htg2, $matches, PREG_SET_ORDER, 0);

    // Print the entire match result
    // var_dump($matches);
    $temp_array_key = [];
    foreach ($matches as $key) {
        foreach($key as $phones) {
            $temp_array_key[] = $phones;
        }

        // echo var_dump($key);
    }
    foreach (array_unique($temp_array_key) as $phone) {
        echo $phone;
        echo "<br/>";
    }
    // ([+]{0,1}[\d-)( ]{8,}) TODO
    
    // Регулярка для номера телефона
    // $tel = replace(" ", $tel)
    // $tel = replace("(", "", $tel)
    // $tel = replace(")", "", $tel)
    // $tel = replace("-", "", $tel)
    // <a href="tel:$tel">$tel</a>

    // Hello world sdjfhsd jkfhdsjk dsujhjd iursehhsu roufhesrfius ehvhjsdh uosehfuse yuewgfyvu 9
    // var_dump(htmlentities($matches[0][2]));
    // var_dump(htmlentities($matches[0][4]));
    // var_dump(htmlentities($htg2));
?>