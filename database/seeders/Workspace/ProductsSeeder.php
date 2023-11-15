<?php

namespace Database\Seeders\Workspace;

use App\Models\Workspace\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productsData = [
            [
                'module'       => '1',
                'name'         => 'Diagnóstico Organizacional',
                'abbreviation' => 'OD',
                'description'  => 'Destinado à identificação dos problemas das principais áreas da empresa e ao apontamento de soluções eficientes.'
            ],
            [
                'module'       => '1',
                'name'         => 'Swot Organizacional',
                'abbreviation' => 'Swot',
                'description'  => 'Módulo orientado à análise do ambiente externo e interno no qual a empresa está inserida, com identificação dos principais pontos fortes, pontos fracos, ameaças e oportunidades.',
            ],
            [
                'module'       => '1',
                'name'         => 'Ciclo PDCA',
                'abbreviation' => 'PDCA',
                'description'  => 'Elaboração de planos de ação para situações específicas apontadas tanto no Diagnóstico quanto na SWOT Organizacional ou ainda para demandas específicas da empresa.',
            ],
            [
                'module'       => '2',
                'name'         => 'BSC Balanced Scorecard',
                'abbreviation' => 'BSC',
                'description'  => 'Realização do planejamento das principais ações e objetivos de médio prazo por meio das perspectivas financeira, de clientes, processos internos e aprendizagem.',
            ],
            [
                'module'       => '2',
                'name'         => 'Planejamento Estratégico',
                'abbreviation' => 'SP',
                'description'  => 'Módulo orientado ao planejamento de ações de médio e longo prazo da organização.',
            ],
            [
                'module'       => '2',
                'name'         => 'Canvas de Negócios',
                'abbreviation' => 'BC',
                'description'  => 'Identificação da visão geral da estrutura organizacional através da metodologia Canvas.',
            ],
            [
                'module'       => '1',
                'name'         => 'BrainStorm',
                'abbreviation' => 'BSTM',
                'description'  => 'Dinâmica colaborativa para resolução de problemas específicos, desenvolvimento de projetos e novas ideias, coleta de informações e estimulo ao pensamento criativo organizacional.',
            ]
        ];

        foreach ($productsData as $productData) {
            Product::create($productData);
        }
    }
}
