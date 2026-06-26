<?php

use Illuminate\Support\Str;
use Carbon\Carbon;

if (! function_exists('to_sql')) {
    function to_sql($query)
    {
        return vsprintf(str_replace(array('?'), array('\'%s\''), $query->toSql()), $query->getBindings());
    }
}

if (! function_exists('plural_from_model')) {
    function plural_from_model($model)
    {
        $plural = Str::plural(class_basename($model));
        return Str::camel($plural);
    }
}

if (! function_exists('to_link')) {
    function to_link($str, $link, $args_by_get = '', $class = '')
    {
        return '<a href="' . LaravelLocalization::localizeURL($link) . $args_by_get . '"' .
            ($class ? ' class="' . $class . '"' : '') . '>' . $str . '</a>';
    }
}

if (! function_exists('to_route')) {
    function to_route($str, $route, $obj = null, $args_by_get = '', $class = '')
    {
        $link = $obj ? route($route, $obj) : route($route);
        return to_link($str, $link, $class);
    }
}

if (! function_exists('to_show')) {
    function to_show($str, $model, $obj, $args_by_get = '')
    {
        return to_link($str, route(plural_from_model($model) . '.show', $obj), $args_by_get);
    }
}

if (! function_exists('back_to_show')) {
    function back_to_show($model, $obj, $args_by_get = '', $message = '')
    {
        return to_link(
            $message ? $message : trans('messages.back_to_show'),
            route(plural_from_model($model) . '.show', $obj),
            $args_by_get
        );
    }
}

if (! function_exists('to_back')) {
    function to_back($model, $args_by_get = '')
    {
        return to_link(trans('messages.back_to_list'), route(plural_from_model($model) . '.index'), $args_by_get);
    }
}

// extracts some parameters from object Request into array $url_args
if (! function_exists('url_args')) {
    function url_args($request, $limit_min = 30)
    {
        $url_args = [
            'portion' => (int)$request->input('portion'), // number of records per page
            'page'      => (int)$request->input('page'),      // number of page
        ];
        if (!$url_args['page']) {
            $url_args['page'] = 1;
        }

        if ($url_args['portion'] <= 0) {
            $url_args['portion'] = $limit_min;
        } elseif ($url_args['portion'] > 1000) {
            $url_args['portion'] = 1000;
        }
        return $url_args;
    }
}

// Converts the array $url_args (name->value) to String
// Usage:
// $this->args_by_get = search_values_by_URL($this->url_args);
if (! function_exists('search_values_by_URL')) {
    function search_values_by_URL(array $url_args = [])
    {
        $out = http_build_query(remove_empty_args($url_args));
        return $out ? '?' . $out : '';
        //        return $out;
    }
}

if (! function_exists('remove_empty_args')) {
    function remove_empty_args(array $url_args = [])
    {
        $url_args = remove_default($url_args);

        foreach ($url_args as $k => $v) {
            if (!$v || is_array($v) && (!sizeof($v) || sizeof($v) == 1 && isset($v[1]) && !$v[1])) {
                unset($url_args[$k]);
            }
        }
        return $url_args;
    }
}

if (! function_exists('remove_default')) {
    function remove_default(array $url_args = [])
    {
        if (array_key_exists('portion', $url_args) && $url_args['portion'] == 10) {
            unset($url_args['portion']);
        }
        if (array_key_exists('page', $url_args) && $url_args['page'] == 1) {
            unset($url_args['page']);
        }
        if (array_key_exists('list_name', $url_args)) {
            unset($url_args['list_name']);
        }

        return $url_args;
    }
}

if (! function_exists('remove_empty_items')) {
    function remove_empty_items(array $arr = [])
    {
        return array_filter($arr, function ($value) {
            return !empty($value);
        });
    }
}

/* Перевести в верхний регистр первую букву строки */
if (!function_exists('mb_ucfirst') && function_exists('mb_substr')) {
    function mb_ucfirst($string)
    {
        $string = mb_strtoupper(mb_substr($string, 0, 1)) . mb_substr($string, 1);
        return $string;
    }
}

if (!function_exists('prev_args')) {
    function prev_args($url_args)
    {
        $url_args['page'] = $url_args['page'] > 1 ? $url_args['page'] - 1 : 1;
        return search_values_by_URL($url_args);
    }
}

if (!function_exists('next_args')) {
    function next_args($url_args)
    {
        $url_args['page'] = $url_args['page'] + 1;
        return search_values_by_URL($url_args);
    }
}

if (!function_exists('args_replace')) {
    function args_replace($url_args, $values)
    {
        foreach ($values as $key => $value) {
            $url_args[$key] = $value;
        }
        return search_values_by_URL($url_args);
    }
}

if (!function_exists('count_not_empty_elems')) {
    function count_not_empty_elems($list)
    {
        $count = 0;
        foreach ($list as $key => $value) {
            if (is_array($value) && sizeof($value) > 0 && !empty($value[0])) {
                $count++;
                //print "<p>$key=$value[0]</p>";
            } elseif (!empty($value)) {
                $count++;
                //print "<p>$key=$value</p>";
            }
        }
        return $count;
    }
}

if (!function_exists('found_rem')) {
    /**
     * Высчитывается остаток от деления для последующего вычисления окончания фразы
     */
    function found_rem(int $total)
    {
        return $total > 20 ? ($total % 10 == 0 ? $total : $total % 10)  : $total;
    }
}

if (!function_exists('getUnitCase')) {
    function getUnitCase(int $value, string $unit1, string $unit2, string $unit3)
    {
        $value = abs((int)$value);
        if (($value % 100 >= 11) && ($value % 100 <= 19)) {
            return $unit3;
        } else {
            switch ($value % 10) {
                case 1:
                    return $unit1;
                case 2:
                case 3:
                case 4:
                    return $unit2;
                default:
                    return $unit3;
            }
        }
    }
}

if (! function_exists('byte_format')) {
    function byte_format(float $size)
    {
        if ($size < 1024) {
            return $size . ' b';
        } elseif ($size < 1024 ** 2) {
            return number_format($size / 1024, 2) . ' Kb';
        } elseif ($size < 1024 ** 3) {
            return number_format($size / (1024 ** 2), 2) . ' Mb';
        } elseif ($size >= 1024 ** 3) {
            return number_format($size / (1024 ** 3), 2) . ' Gb';
        }
    }
}

if (! function_exists('xmlEntities')) {
    function xmlEntities(string $str)
    {
        $str = htmlentities($str);
        $xml = array('&#34;', '&#38;', '&#38;', '&#60;', '&#62;', '&#160;', '&#161;', '&#162;', '&#163;', '&#164;', '&#165;', '&#166;', '&#167;', '&#168;', '&#169;', '&#170;', '&#171;', '&#172;', '&#173;', '&#174;', '&#175;', '&#176;', '&#177;', '&#178;', '&#179;', '&#180;', '&#181;', '&#182;', '&#183;', '&#184;', '&#185;', '&#186;', '&#187;', '&#188;', '&#189;', '&#190;', '&#191;', '&#192;', '&#193;', '&#194;', '&#195;', '&#196;', '&#197;', '&#198;', '&#199;', '&#200;', '&#201;', '&#202;', '&#203;', '&#204;', '&#205;', '&#206;', '&#207;', '&#208;', '&#209;', '&#210;', '&#211;', '&#212;', '&#213;', '&#214;', '&#215;', '&#216;', '&#217;', '&#218;', '&#219;', '&#220;', '&#221;', '&#222;', '&#223;', '&#224;', '&#225;', '&#226;', '&#227;', '&#228;', '&#229;', '&#230;', '&#231;', '&#232;', '&#233;', '&#234;', '&#235;', '&#236;', '&#237;', '&#238;', '&#239;', '&#240;', '&#241;', '&#242;', '&#243;', '&#244;', '&#245;', '&#246;', '&#247;', '&#248;', '&#249;', '&#250;', '&#251;', '&#252;', '&#253;', '&#254;', '&#255;');
        $html = array('&quot;', '&amp;', '&amp;', '&lt;', '&gt;', '&nbsp;', '&iexcl;', '&cent;', '&pound;', '&curren;', '&yen;', '&brvbar;', '&sect;', '&uml;', '&copy;', '&ordf;', '&laquo;', '&not;', '&shy;', '&reg;', '&macr;', '&deg;', '&plusmn;', '&sup2;', '&sup3;', '&acute;', '&micro;', '&para;', '&middot;', '&cedil;', '&sup1;', '&ordm;', '&raquo;', '&frac14;', '&frac12;', '&frac34;', '&iquest;', '&Agrave;', '&Aacute;', '&Acirc;', '&Atilde;', '&Auml;', '&Aring;', '&AElig;', '&Ccedil;', '&Egrave;', '&Eacute;', '&Ecirc;', '&Euml;', '&Igrave;', '&Iacute;', '&Icirc;', '&Iuml;', '&ETH;', '&Ntilde;', '&Ograve;', '&Oacute;', '&Ocirc;', '&Otilde;', '&Ouml;', '&times;', '&Oslash;', '&Ugrave;', '&Uacute;', '&Ucirc;', '&Uuml;', '&Yacute;', '&THORN;', '&szlig;', '&agrave;', '&aacute;', '&acirc;', '&atilde;', '&auml;', '&aring;', '&aelig;', '&ccedil;', '&egrave;', '&eacute;', '&ecirc;', '&euml;', '&igrave;', '&iacute;', '&icirc;', '&iuml;', '&eth;', '&ntilde;', '&ograve;', '&oacute;', '&ocirc;', '&otilde;', '&ouml;', '&divide;', '&oslash;', '&ugrave;', '&uacute;', '&ucirc;', '&uuml;', '&yacute;', '&thorn;', '&yuml;');
        $str = str_replace($html, $xml, $str);
        $str = str_ireplace($html, $xml, $str);
        return $str;
    }
}

if (! function_exists('text2word')) {
    function text2word(string $str)
    {
        return preg_replace("/\r\n/", chr(10), $str);
    }
}

if (!function_exists('format_number')) {
    function format_number(float $total)
    {
        return number_format($total, 0, ',', ' ');
    }
}

if (! function_exists('format_date')) {
    function format_date(string $date)
    {
        if (!$date) {
            return null;
        }
        //dd($date, strtotime($date), date('d.m.Y', strtotime($date)));
        if (strlen($date) == 10) {
            $date .= ' 00:00:00';
        }
        return date('d.m.Y', strtotime($date));
    }
}

if (! function_exists('human_date')) {
    function human_date(string $date, $with_year = true)
    {
        if (!$date) {
            return null;
        }
        //        return Carbon::parse($date)->translatedFormat('d F Y').' г.';  
        $d = Carbon::parse($date);
        if ($with_year) {
            return $d->isoFormat('D[ ]MMMM YYYY') . ' г.';
        }
        return $d->isoFormat('D[ ]MMMM');
    }
}

if (! function_exists('doc_date')) {
    function doc_date(string $date)
    {
        if (!$date) {
            return null;
        }
        $d = Carbon::parse($date);
        return $d->isoFormat('[«]DD[» ]MMMM YYYY') . ' г.';
    }
}

if (! function_exists('human_time')) {
    function human_time(string $time)
    {
        if (!$time) {
            return null;
        }
        return substr($time, 0, 5);
    }
}


if (! function_exists('trans_with_choice')) {
    function trans_with_choice(string $var, int $count)
    {
        return trans_choice(
            $var,
            $count % 10 == 0 ? $count : ($count % 100 > 20 ? $count % 10  : $count % 100),
            ['count' => number_with_space($count, 0, ',', ' ')]
        );
    }
}

if (! function_exists('process_text')) {
    function process_text(string $text)
    {
        return str_replace(array("\r\n", "\r", "\n"), '<br>', $text);
    }
}

if (!function_exists('css')) {
    function css(string $filename)
    {
        $code = @filemtime(env('APP_ROOT') . 'public/css/' . $filename . '.css');
        return '<link href="/css/' . $filename . '.css?' . $code . '" rel="stylesheet">';
    }
}

if (!function_exists('js')) {
    function js(string $filename)
    {
        $code = @filemtime(env('APP_ROOT') . 'public/js/' . $filename . '.js');
        return '<script src="/js/' . $filename . '.js?' . $code . '"></script>';
    }
}

if (!function_exists('number_to_word')) {
    function number_to_word(float $num, $is_female = 0)
    {
        //разряд: единицы, десятки, сотни, тысячи
        $nul = 'ноль';
        $ten = [
            ['', 'один', 'два', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'],
            ['', 'одна', 'две', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'],
        ];
        $a20 = ['десять', 'одиннадцать', 'двенадцать', 'тринадцать', 'четырнадцать', 'пятнадцать', 'шестнадцать', 'семнадцать', 'восемнадцать', 'девятнадцать'];
        $tens = [2 => 'двадцать', 'тридцать', 'сорок', 'пятьдесят', 'шестьдесят', 'семьдесят', 'восемьдесят', 'девяносто'];
        $hundred = ['', 'сто', 'двести', 'триста', 'четыреста', 'пятьсот', 'шестьсот', 'семьсот', 'восемьсот', 'девятьсот'];
        $unit = [ // Units
            ['тысяча', 'тысячи', 'тысяч', 1],
            ['миллион', 'миллиона', 'миллионов', 0],
            ['миллиард', 'милиарда', 'миллиардов', 0],
        ];

        $num = sprintf("%012.0f", $num);
        $out = [];

        if (intval($num) > 0) {
            foreach (str_split($num, 3) as $uk => $v) { // by 3 symbols
                if (!intval($v)) continue;
                $uk = sizeof($unit) - $uk - 1; // unit key
                $gender = $uk >= 0 ? $unit[$uk][3] : $is_female;
                list($i1, $i2, $i3) = array_map('intval', str_split($v, 1));

                $out[] = $hundred[$i1]; # 1xx-9xx
                if ($i2 > 1) $out[] = $tens[$i2] . ' ' . $ten[$gender][$i3]; # 20-99
                else $out[] = $i2 > 0 ? $a20[$i3] : $ten[$gender][$i3]; # 10-19 | 1-9
                if ($uk >= 0) {
                    $out[] = morph($v, $unit[$uk][0], $unit[$uk][1], $unit[$uk][2]);
                }
            } //foreach
        } else $out[] = $nul;

        return trim(preg_replace('/ {2,}/', ' ', join(' ', $out)));
    }
}

//Склоняем словоформу
if (!function_exists('morph')) {
    function morph(float $n, string $f1, string $f2, string $f5)
    {
        $n = abs(intval($n)) % 100;
        if ($n > 10 && $n < 20) return $f5;
        $n = $n % 10;
        if ($n > 1 && $n < 5) return $f2;
        if ($n == 1) return $f1;
        return $f5;
    }
}

if (!function_exists('mb_lcfirst')) {
    function mb_lcfirst(string $string)
    {
        return mb_strtolower(mb_substr($string, 0, 1)) . mb_substr($string, 1);
    }
}

if (!function_exists('clear_text')) {
    function clear_text(string $text)
    {
        return preg_replace("/&shy;/", '', $text);
    }
}
