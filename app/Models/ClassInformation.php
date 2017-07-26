<?php

namespace SON\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;

class ClassInformation extends Model implements TableInterface
{
    protected $fillable = [
        'date_start',
        'date_end',
        'cycle',
        'subdivision',
        'semester',
        'year'
    ];

    protected $dates = [
        'date_start', //Carbon wrapper \DateTime
        'date_end'
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
        return [
            'ID',
            'Data Início',
            'Data Fim',
            'Ciclo',
            'Subdivisão',
            'Semestre',
            'Ano'
        ];
    }

    /**
     * Get the value for a given header. Note that this will be the value
     * passed to any callback functions that are being used.
     *
     * @param string $header
     * @return mixed
     */
    public function getValueForHeader($header)
    {
        switch ($header) {
            case 'ID':
                return $this->id;
            case 'Data Início':
                return $this->date_start->format('d/m/Y'); //Carbon
            case 'Data Fim':
                return $this->date_end->format('d/m/Y');
            case 'Ciclo':
                return $this->cycle;
            case 'Subdivisão':
                return $this->subdivision;
            case 'Semestre':
                return $this->semester;
            case 'Ano':
                return $this->year;
        }
    }
}
