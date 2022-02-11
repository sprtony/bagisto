<?php

namespace Quimaira\Contactos\Exports;

use Quimaira\Contactos\Models\Contacto;
use Maatwebsite\Excel\Concerns\FromCollection;


class ContactosExport implements FromCollection
{

  public function collection()
  {
    return Contacto::all();
  }
}
