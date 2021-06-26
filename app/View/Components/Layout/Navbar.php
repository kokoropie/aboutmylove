<?php

namespace App\View\Components\Layout;

use Illuminate\View\Component;

use App\Models;

class Navbar extends Component
{
    /**
     * List navbar
     *
     * @var array
     */
    public $navbar;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($active)
    {
        $navbar = $this->getNavbar($active, 0, 0);
        $this->navbar = $navbar;
    }

    public function getNavbar($active, $by_id, $index) {
        $navbar = [];
        $listNavbar = Models\Navbar::where('by_id', $by_id)->orderBy('order', 'ASC')->get();
        foreach ($listNavbar as $item) {
            $data = [];
            $data["title"] = $item->title;
            $data["ref"] = $item->ref;
            $data["url"] = "javascript:void(0)";
            $data["active"] = false;
            $data["item"] = [];

            if ($item->by_id == 0) $data["icon"] = $item->icon;

            $url = json_decode($item->url);

            if (isset($url->route)) 
                if (\Route::has($url->route)) $data["url"] = route($url->route);
                else unset($url->route);
                
            if (empty($url->route) && isset($url->href)) $data["url"] = url($url->href);
            
            if (isset($active[$index])) 
                if ($active[$index] == $item->ref) $data["active"] = true;

            if (Models\Navbar::where('by_id', $item->navbar_id)->exists())
                $data["item"] = $this->getNavbar($active, $item->navbar_id, $index+1);

            $navbar[] = $data;
        }
        return $navbar;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.layout.navbar');
    }
}
