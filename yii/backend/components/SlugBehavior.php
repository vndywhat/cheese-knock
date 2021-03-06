<?php
namespace backend\components;

class SlugBehavior extends \yii\behaviors\SluggableBehavior
{

    public function translit($text)
    {
        $converter = [
            'а'	=>'a', 'б'	=>'b', 'в'	=>'v',
            'г'	=>'g', 'д'	=>'d', 'е'	=>'e',
            'ё'	=>'yo', 'ж'	=>'zh', 'з'	=>'z',
            'и'	=>'i', 'й'	=>'y', 'к'	=>'k',
            'л'	=>'l', 'м'	=>'m', 'н'	=>'n',
            'о'	=>'o', 'п'	=>'p', 'р'	=>'r',
            'с'	=>'s', 'т'	=>'t', 'у'	=>'u',
            'ф'	=>'f', 'х'	=>'h', 'ц'	=>'z',
            'ч'	=>'ch', 'ш'	=>'sh', 'щ'	=>'sch',
            'ь'	=>'', 'ы'	=>'y', 'ъ'	=>'',
            'э'	=>'e', 'ю'	=>'yu', 'я'	=>'ya',
            'А'	=>'A', 'Б'	=>'B', 'В'	=>'V',
            'Г'	=>'G', 'Д'	=>'D', 'Е'	=>'E',
            'Ё'	=>'Yo', 'Ж'	=>'Zh', 'З'	=>'Z',
            'И'	=>'I', 'Й'	=>'Y', 'К'	=>'K',
            'Л'	=>'L', 'М'	=>'M', 'Н'	=>'N',
            'О'	=>'O', 'П'	=>'P', 'Р'	=>'R',
            'С'	=>'S', 'Т'	=>'T', 'У'	=>'U',
            'Ф'	=>'F', 'Х'	=>'H', 'Ц'	=>'Z',
            'Ч'	=>'Ch', 'Ш'	=>'Sh', 'Щ'	=>'Sch',
            'Ь'	=>'', 'Ы'	=>'Y', 'Ъ'	=>'',
            'Э'	=>'E', 'Ю'	=>'Yu', 'Я'	=>'Ya',
        ];
        return strtr($text, $converter);
    }

    public function generateSlug($slugParts)
    {
        //Удаляем пробелы
        $len = 0;
        while(true)
        {
            $text = str_replace('  ', ' ', implode('-', $slugParts));
            $newlen = strlen($text);
            if($len == $newlen) break;
            $len = $newlen;
        }
        $text = trim($text);
        // переводим в транслит
        $text		 = self::translit($text);
        // в нижний регистр
        $text		 = strtolower($text);
        // пробел на тире
        $converter	 = array(' '=>'-');
        $text		 = strtr($text, $converter);
        // удаляем все лишнее
        $text		 = preg_replace('/[^a-z0-9_\-]/u', '', $text);
        return $text;
    }

}