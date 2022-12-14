<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\Base;
use App\Models\Empresa;
use App\Models\Grupo;
use App\Models\User;
use Illuminate\Contracts\View\View;

use function add_user_log;
use function view;

class Search extends Base
{
    public string $query         = '';
    public array  $models        = [
        Empresa::class,
    ];
    public array  $searchResults = [];

    public function render(): View
    {
        $this->searchResults = [];

        if (strlen($this->query) > 2) {
            foreach ($this->models as $model) {
                $query   = new $model();
                $fields  = $query->getModel()->searchable;
                $fields  = implode(',', $fields);
                $search  = str_replace('@', '', $this->query);
                $query = $query
                    ->whereRaw('MATCH (' . $fields . ') AGAINST (? IN BOOLEAN MODE)', ['*' . $search . '*'])
                    ->take(10);
                if ($query->getModel()->section == "Empresa") {
                    // incluir a pesquisa pelo grupo
                    $query = $query->selectRaw('empresas.*');
                    $query = $query->join('grupos as g', 'empresas.grupo_id', '=', 'g.id')
                        ->orWhereRaw("g.nome like '%$search%'");
                }
                // $query = $query->toSql();
                $results = $query->get();
                // dd($query);
                foreach ($results as $result) {
                    $this->searchResults[] = [
                        'label'   => $result[$query->getModel()->label],
                        'route'   => $query->getModel()->route($result->id),
                        'section' => $result->section
                    ];
                }
            }

            add_user_log([
                'title'        => "Searched: " . $this->query,
                'link'         => route('admin.settings'),
                'reference_id' => auth()->id(),
                'section'      => 'Search',
                'type'         => 'Search'
            ]);
        }

        return view('livewire.admin.search');
    }
}
