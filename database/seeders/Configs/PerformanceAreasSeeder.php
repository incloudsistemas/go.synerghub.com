<?php

namespace Database\Seeders\Configs;

use App\Models\Configs\PerformanceArea;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerformanceAreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // PerformanceArea::factory(10)
        //     ->create();

        $performanceAreasData = [
            ['name' => "Acessórios"],
            ['name' => "Agricultura"],
            ['name' => "Alimentos"],
            ['name' => "Alimentos Diversos"],
            ['name' => "Aluguel de carros"],
            ['name' => "Armas e Munições"],
            ['name' => "Artefatos de Cobre"],
            ['name' => "Artefatos de Ferro e Aço"],
            ['name' => "Automóveis e Motocicletas"],
            ['name' => "Açucar e Alcool"],
            ['name' => "Bancos"],
            ['name' => "Bicicletas"],
            ['name' => "Brinquedos e Jogos"],
            ['name' => "Calçados"],
            ['name' => "Carnes e Derivados"],
            ['name' => "Cervejas e Refrigerantes"],
            ['name' => "Computadores e Equipamentos"],
            ['name' => "Construção Pesada"],
            ['name' => "Corretoras de Seguros"],
            ['name' => "Engenharia Consultiva"],
            ['name' => "Energia Elétrica"],
            ['name' => "Equipamentos"],
            ['name' => "Equipamentos e Serviços"],
            ['name' => "Exploração de Imóveis"],
            ['name' => "Exploração de Rodovias"],
            ['name' => "Exploração, Refino e Distribuição"],
            ['name' => "Fertilizantes e Defensivos"],
            ['name' => "Fios e Tecidos"],
            ['name' => "Gestão de Recursos e Investimentos"],
            ['name' => "Gás"],
            ['name' => "Holdings Diversificadas"],
            ['name' => "Hotelaria"],
            ['name' => "Incorporações"],
            ['name' => "Intermediação Imobiliária"],
            ['name' => "Materiais Diversos"],
            ['name' => "Material Aeronáutico e de Defesa"],
            ['name' => "Material Rodoviário"],
            ['name' => "Material de Transporte"],
            ['name' => "Medicamentos e Outros Produtos"],
            ['name' => "Minerais Metálicos"],
            ['name' => "Motores, Compressores e Outros"],
            ['name' => "Máq. e Equip. Construção e Agrícolas"],
            ['name' => "Máq. e Equip. Industriais"],
            ['name' => "Móveis"],
            ['name' => "Outros"],
            ['name' => "Papel e Celulose"],
            ['name' => "Petroquímicos"],
            ['name' => "Produtos Diversos"],
            ['name' => "Produtos de Limpeza"],
            ['name' => "Produtos de Uso Pessoal"],
            ['name' => "Produtos para Construção"],
            ['name' => "Programas de Fidelização"],
            ['name' => "Programas e Serviços"],
            ['name' => "Produção de Eventos e Shows"],
            ['name' => "Publicidade e Propaganda"],
            ['name' => "Químicos Diversos"],
            ['name' => "Restaurante e Similares"],
            ['name' => "Seguradoras"],
            ['name' => "Serv.Méd.Hospit. Análises e Diagnósticos"],
            ['name' => "Serviços Diversos"],
            ['name' => "Serviços Educacionais"],
            ['name' => "Serviços Financeiros Diversos"],
            ['name' => "Serviços de Apoio e Armazenagem"],
            ['name' => "Siderurgia"],
            ['name' => "Soc. Crédito e Financiamento"],
            ['name' => "Telecomunicações"],
            ['name' => "Tecidos, Vestuário e Calçados"],
            ['name' => "Transporte Aéreo"],
            ['name' => "Transporte Ferroviário"],
            ['name' => "Transporte Hidroviário"],
            ['name' => "Utensílios Domésticos"],
            ['name' => "Vestuário"],
            ['name' => "Viagens e Turismo"],
            ['name' => "Água e Saneamento"]
        ];

        foreach ($performanceAreasData as $performanceAreaData) {
            PerformanceArea::create($performanceAreaData);
        }
    }
}
