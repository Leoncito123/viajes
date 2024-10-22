<?php

namespace App\View\Components\Leo\Hoteles;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class hotelMapa extends Component
{
  public $latitude;
  public $longitude;
  public function __construct($latitude, $longitude)
  {
    $this->latitude = $latitude;
    $this->longitude = $longitude;
  }

  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View|Closure|string
  {
    return view('components.leo.hoteles.hotel-mapa');
  }
}
