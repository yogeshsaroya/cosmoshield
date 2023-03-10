<?php
/* print array and string */
function ec($str = null, $txt = null)
{
    if (!is_null($str)) {
        if (is_array($str) || is_object($str)) {
            echo $txt . " ";
            if (is_array($str)) {
                echo count($str);
            }
            echo "<pre>";
            print_r($str);
            echo "</pre>";
        } else {
            echo "$txt <br>$str<br>";
        }
    } else {
        echo "$txt <br>Empty/Null<br>";
    }
}

function num_2($num, $limit = 2)
{
    return number_format((float) $num, $limit, '.', '');
}

function cu($num, $limit = 2)
{
    return number_format((float) $num, $limit);
}

function num($num = null)
{
    if ($num == 0) {
        return 0;
    } else {
        return (int) $num;
    }
}

function show_image($full_path = null, $w = 100, $h = 100, $dimensions = 'ff', $clean_url = 1, $formate = 'jpg')
{
    $img_url = null;
    if (!empty($full_path) && file_exists($full_path)) {
        if ($clean_url == 1) {
            $img_url = SITEURL . "images/" . $w . "_" . $h . "_" . $dimensions . "_" . $formate . "/" . $full_path;
        } else {
            $img_url = SITEURL . "imgd.php?w=$w&h=$h&no-cache&skip-original&$dimensions=ffffff7f&sa=$formate&src=$full_path&ver=" . rand(123456, 987654);
        }
    }
    if (empty($img_url)) {
        if ($clean_url == 1) {
            $img_url = SITEURL . "images/" . $w . "_" . $h . "_ff_png/img/placeholder.png";
        } else {
            $img_url = SITEURL . "imgd.php?w=$w&h=$h&no-cache&skip-original&$dimensions=ffffff7f&sa=png&src=img/placeholder.png&ver=" . rand(123456, 987654);
        }
    }
    return $img_url;
}

/**
 * check give string is date or not
 *
 * @call validateDate($str,$format = 'Y-m-d H:i:s');
 *
 */
function validateDate($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

function uc_text($str = null)
{
    return ucwords(strtolower(trim($str)));
}

function set_version($t = null)
{
    if ($t == 'c') {
        return '.css?v=' . rand(111, 999999);
    } elseif ($t == 'j') {
        return '.js?v=' . rand(111, 999999);
    }
}

function set_tooltip($pos = 'top', $title = null)
{
    return '<i class="fa fa-question-circle" data-animation="false" data-toggle="tooltip" data-html="true" data-placement="' . $pos . '" title="' . $title . '"></i>';
}

function getStatus()
{
    return ['1' => 'Draft', '2' => 'Sent', '3' => 'Failed'];
}


function formatting($phone)
{
    $format = null;
    if (preg_match('/^\+[0-9]([0-9]{3})([0-9]{3})([0-9]{4})$/', $phone, $value)) {
        $format = ' (' . $value[1] . ') ' . $value[2] . ' ' . $value[3];
    }
    return $format;
}

function seeds()
{
    return [
        'Cosmos' => 'Cosmos', 'Juno' => 'Juno', 'Secret' => 'Secret', 'Akash' => 'Akash', 'Agoric' => 'Agoric', 'Luna C' => 'Luna C', 'Osmosi' => 'Osmosi',
        'Evmos' => 'Evmos', 'Kujira' => 'Kujira', 'Comdex' => 'Comdex', 'Sentin' => 'Sentin', 'Persis' => 'Persis', 'Starga' => 'Starga', 'Umee' => 'Umee',
        'Sifcha' => 'Sifcha', 'Axelar' => 'Axelar', 'Emoney' => 'Emoney', 'Stride' => 'Stride', 'Gravit' => 'Gravit', 'Crypto' => 'Crypto', 'Regen' => 'Regen',
        'Chihua' => 'Chihua', 'Rebus' => 'Rebus', 'Orai' => 'Orai', 'AssetM' => 'AssetM', 'Terito' => 'Terito', 'Iris' => 'Iris', 'Inject' => 'Inject', 'Carbon' => 'Carbon', 'Canto' => 'Canto'
    ];
}
