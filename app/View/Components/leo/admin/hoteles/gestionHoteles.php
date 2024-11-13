<?php

namespace App\View\Components\leo\admin\hoteles;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class gestionHoteles extends Component
{
  public $servicios;
  public $hoteles;

  /**
   * Create a new component instance.
   */
  public function __construct($servicios, $hoteles)
  {
    $this->servicios = $servicios;
    $this->hoteles = $hoteles;
  }

  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View|Closure|string
  {
    return view('components.leo.admin.hoteles.gestion-hoteles');
  }
}
