<?php

namespace App\View\Components\Leo\Hoteles;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class modalInfo extends Component
{
  public $name;
  public $info;
  public $image;
  public $id;
  public function __construct($name, $info, $image, $id)
  {
    $this->name = $name;
    $this->info = $info;
    $this->image = $image;
    $this->id = $id;
  }

  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View|Closure|string
  {
    return view('components.leo.hoteles.modal-info');
  }
}
