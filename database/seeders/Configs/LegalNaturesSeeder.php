<?php

namespace Database\Seeders\Configs;

use App\Models\Configs\LegalNature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LegalNaturesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // LegalNature::factory(10)
        //     ->create();

        $legalNaturesData = [
            ['role' => '1', 'code' => '101-5', 'name' => 'Órgão Público do Poder Executivo Federal'],
            ['role' => '1', 'code' => '102-3', 'name' => 'Órgão Público do Poder Executivo Estadual ou do Distrito Federal'],
            ['role' => '1', 'code' => '103-1', 'name' => 'Órgão Público do Poder Executivo Municipal'],
            ['role' => '2', 'code' => '201-1', 'name' => 'Empresa Pública'],
            ['role' => '2', 'code' => '203-8', 'name' => 'Sociedade de Economia Mista'],
            ['role' => '2', 'code' => '204-6', 'name' => 'Sociedade Anônima Aberta'],
            ['role' => '3', 'code' => '303-4', 'name' => 'Serviço Notarial e Registral (Cartório)'],
            ['role' => '3', 'code' => '306-9', 'name' => 'Fundação Privada'],
            ['role' => '3', 'code' => '307-7', 'name' => 'Serviço Social Autônomo'],
            ['role' => '4', 'code' => '401-4', 'name' => 'Empresa Individual Imobiliária'],
            ['role' => '4', 'code' => '409-0', 'name' => 'Candidato a Cargo Político Eletivo'],
            ['role' => '4', 'code' => '412-0', 'name' => 'Produtor Rural (Pessoa Física)'],
            ['role' => '5', 'code' => '501-0', 'name' => 'Organização Internacional'],
            ['role' => '5', 'code' => '502-9', 'name' => 'Representação Diplomática Estrangeira'],
            ['role' => '5', 'code' => '503-7', 'name' => 'Outras Instituições Extraterritoriais'],
        ];

        foreach ($legalNaturesData as $legalNatureData) {
            LegalNature::create($legalNatureData);
        }
    }
}
