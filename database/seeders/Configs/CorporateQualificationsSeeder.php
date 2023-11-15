<?php

namespace Database\Seeders\Configs;

use App\Models\Configs\CorporateQualification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CorporateQualificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CorporateQualification::factory(10)
            ->create();

        $qualificationsData = [
            ['code' => '5',  'name' => 'Administrador'],
            ['code' => '10', 'name' => 'Diretor'],
            ['code' => '16', 'name' => 'Presidente'],
            ['code' => '17', 'name' => 'Procurador'],
            ['code' => '19', 'name' => 'Síndico de Condomínio'],
            ['code' => '20', 'name' => 'Sociedade Consorciada'],
            ['code' => '22', 'name' => 'Sócio'],
            ['code' => '24', 'name' => 'Sócio-Comanditado'],
            ['code' => '25', 'name' => 'Sócio-Comanditário'],
            ['code' => '29', 'name' => 'Sócio ou Acionista Incapaz ou Relativamente Incapaz (exceto menor)'],
            ['code' => '30', 'name' => 'Sócio ou Acionista Menor (assistido ou representado)'],
            ['code' => '31', 'name' => 'Sócio-Ostensivo'],
            ['code' => '32', 'name' => 'Tabelião'],
            ['code' => '37', 'name' => 'Sócio Pessoa Jurídica domiciliada no Exterior'],
            ['code' => '38', 'name' => 'Sócio Pessoa Física residente ou domiciliada no Exterior'],
            ['code' => '39', 'name' => 'Diplomata'],
            ['code' => '40', 'name' => 'Consul'],
            ['code' => '41', 'name' => 'Representante de Organização Internacional'],
            ['code' => '42', 'name' => 'Oficial de Registro'],
            ['code' => '43', 'name' => 'Responsável'],
            ['code' => '46', 'name' => 'Ministro de Estado das Relações Exteriores'],
            ['code' => '49', 'name' => 'Sócio-Administrador'],
            ['code' => '50', 'name' => 'Empresário'],
            ['code' => '51', 'name' => 'Candidato a cargo político Eletivo'],
            ['code' => '54', 'name' => 'Fundador'],
            ['code' => '55', 'name' => 'Sócio-Comanditado Residente no Exterior'],
            ['code' => '56', 'name' => 'Sócio-Comanditário Pessoa Física residente no Exterior'],
            ['code' => '57', 'name' => 'Sócio-Comanditário Pessoa Jurídica domiciliado no Exterior'],
            ['code' => '58', 'name' => 'Sócio-Comanditário Incapaz'],
            ['code' => '60', 'name' => 'Consul Honorário'],
            ['code' => '61', 'name' => 'Responsável Indígena'],
            ['code' => '62', 'name' => 'Representante de Insituição Extraterritorial'],
            ['code' => '63', 'name' => 'Quotas em Tesouraria'],
            ['code' => '65', 'name' => 'Titular pessoa física domiciliada no Brasil'],
        ];

        foreach ($qualificationsData as $qualificationData) {
            CorporateQualification::create($qualificationData);
        }
    }
}
