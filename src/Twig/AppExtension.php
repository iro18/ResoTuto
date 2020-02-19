<?php 

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('iframetuto', [$this, 'IframedTuto'], ['is_safe' => ['html']]),
        ];
    }

    public function IframedTuto($url)
    {
        if(preg_match("#watch\?v=([^/. ]{11})#", $url ,$IDyoutube)){
            $id=$IDyoutube[1];
        }
        else{
            return "Erreur";
        }
        
        return '<iframe src="https://www.youtube.com/embed/'.$id.'" width="100%" height="550" frameborder="0" allowfullscreen="allowfullscreen"></iframe>';
    }
}
?>