<?php

/**
 * Created by Artisan.
 * User: placeless
 * Date: 16/12/16
 * Time: 上午11:56
 */
$str =  <<< TEMPLATE
<?php

/**
 * Created by Artisan.
 * @desc: silence is gold
 */
namespace App\Model;
use Illuminate\Database\Eloquent\Model as Eloquent;
class %s extends Eloquent{

}

TEMPLATE;
return $str;