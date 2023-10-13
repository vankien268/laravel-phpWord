<?php
namespace App\Biz\Newway\Template;

require_once __DIR__ . "/../mustache/src/Mustache/Autoloader.php";
use App\Biz\Newway\mustache\src\Mustache\Autoloader;
use Mustache_Engine;
use Image;

class CpmsTemplate implements ICpmsTemplate
{
    /**
     * chuyeern template sang mustache
     *
     * @param  mixed $view
     * @param  mixed $data
     * @return void
     */
    public function convertMustache($view, array $data)
    {
        $dataImg = @$data["HotelLogo"] ?? @$data["data"]["HotelLogo"] ?? 'https://upload.wikimedia.org/wikipedia/vi/thumb/6/65/VNPT_Logo.svg/640px-VNPT_Logo.svg.png';
//         $image = Image::make($dataImg);
//         $image->resize(100, 70)->save(storage_path("app/public/images/logo.png"));
        $img =
            "<img width='100' height='auto' style='display:block; margin: auto;object-fit: cover;' src='" .
            $dataImg .
            "' alt=''/>";
        $newView = str_replace("{{HotelLogo}}", $img, $view);
        //////////
        $autoload = new Autoloader();
        Autoloader::register();

        $m = new Mustache_Engine(["entity_flags" => ENT_QUOTES]);
        $tpl = $m->loadTemplate($newView);
//        dd($m->render($newView,$data));
        return $tpl->render($data);
    }

    /**
     * Summary of convertMustacheReport
     * @param mixed $view
     * @param array $data
     * @return string
     */
    public function convertMustacheReport($view, array $data)
    {
        //////////
        $autoload = new Autoloader();
        Autoloader::register();
        $m = new Mustache_Engine(["entity_flags" => ENT_QUOTES]);
        $tpl = $m->loadTemplate($view);
        return $tpl->render($data);
    }
}
