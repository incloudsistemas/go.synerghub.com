<?php

namespace Database\Seeders\Configs;

use App\Models\Configs\Cnae;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CnaesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cnae::factory(10)
        //     ->create();

        $cnaesData = [
            ['code' => '0111-3/01', 'name' => 'Cultivo de arroz'],
            ['code' => '0111-3/02', 'name' => 'Cultivo de milho'],
            ['code' => '0111-3/03', 'name' => 'Cultivo de trigo'],
            ['code' => '0111-3/99', 'name' => 'Cultivo de outros cereais não especificados anteriormente'],
            ['code' => '0112-1/01', 'name' => 'Cultivo de algodão herbáceo'],
            ['code' => '0112-1/02', 'name' => 'Cultivo de juta'],
            ['code' => '0112-1/99', 'name' => 'Cultivo de outras fibras de lavoura temporária não especificadas anteriormente'],
            ['code' => '0113-0/00', 'name' => 'Cultivo de cana-de-açúcar'],
            ['code' => '0114-8/00', 'name' => 'Cultivo de fumo'],
            ['code' => '0115-6/00', 'name' => 'Cultivo de soja'],
            ['code' => '0116-4/01', 'name' => 'Cultivo de amendoim'],
            ['code' => '0116-4/02', 'name' => 'Cultivo de girassol'],
            ['code' => '0116-4/03', 'name' => 'Cultivo de mamona'],
            ['code' => '0116-4/99', 'name' => 'Cultivo de outras oleaginosas de lavoura temporária não especificadas anteriormente'],
            ['code' => '0119-9/01', 'name' => 'Cultivo de abacaxi'],
            ['code' => '0119-9/02', 'name' => 'Cultivo de alho'],
            ['code' => '0119-9/03', 'name' => 'Cultivo de batata-inglesa'],
            ['code' => '0119-9/04', 'name' => 'Cultivo de cebola'],
            ['code' => '0119-9/05', 'name' => 'Cultivo de feijão'],
            ['code' => '0119-9/06', 'name' => 'Cultivo de mandioca'],
            ['code' => '0119-9/07', 'name' => 'Cultivo de melão'],
            ['code' => '0119-9/08', 'name' => 'Cultivo de melancia'],
            ['code' => '0119-9/09', 'name' => 'Cultivo de tomate rasteiro'],
            ['code' => '0119-9/99', 'name' => 'Cultivo de outras plantas de lavoura temporária não especificadas anteriormente'],
            ['code' => '0121-1/01', 'name' => 'Horticultura, exceto morango'],
            ['code' => '0121-1/02', 'name' => 'Cultivo de morango'],
            ['code' => '0122-9/00', 'name' => 'Floricultura'],
            ['code' => '0131-8/00', 'name' => 'Cultivo de laranja'],
            ['code' => '0132-6/00', 'name' => 'Cultivo de uva'],
            ['code' => '0133-4/01', 'name' => 'Cultivo de açaí'],
            ['code' => '0133-4/02', 'name' => 'Cultivo de banana'],
            ['code' => '0133-4/03', 'name' => 'Cultivo de caju'],
            ['code' => '0133-4/04', 'name' => 'Cultivo de cítricos, exceto laranja'],
            ['code' => '0133-4/05', 'name' => 'Cultivo de coco-da-baía'],
            ['code' => '0133-4/06', 'name' => 'Cultivo de guaraná'],
            ['code' => '0133-4/07', 'name' => 'Cultivo de maçã'],
            ['code' => '0133-4/08', 'name' => 'Cultivo de mamão'],
            ['code' => '0133-4/09', 'name' => 'Cultivo de maracujá'],
            ['code' => '0133-4/10', 'name' => 'Cultivo de manga'],
            ['code' => '0133-4/11', 'name' => 'Cultivo de pêssego'],
            ['code' => '0133-4/99', 'name' => 'Cultivo de frutas de lavoura permanente não especificadas anteriormente'],
            ['code' => '0134-2/00', 'name' => 'Cultivo de café'],
            ['code' => '0135-1/00', 'name' => 'Cultivo de cacau'],
            ['code' => '0139-3/01', 'name' => 'Cultivo de chá-da-índia'],
            ['code' => '0139-3/02', 'name' => 'Cultivo de erva-mate'],
            ['code' => '0139-3/03', 'name' => 'Cultivo de pimenta-do-reino'],
            ['code' => '0139-3/04', 'name' => 'Cultivo de plantas para condimento, exceto pimenta-do-reino'],
            ['code' => '0139-3/05', 'name' => 'Cultivo de dendê'],
            ['code' => '0139-3/06', 'name' => 'Cultivo de seringueira'],
            ['code' => '0139-3/99', 'name' => 'Cultivo de outras plantas de lavoura permanente não especificadas anteriormente'],
            ['code' => '0141-5/01', 'name' => 'Produção de sementes certificadas, exceto de forrageiras para pasto'],
            ['code' => '0141-5/02', 'name' => 'Produção de sementes certificadas de forrageiras para formação de pasto'],
            ['code' => '0142-3/00', 'name' => 'Produção de mudas e outras formas de propagação vegetal, certificadas'],
            ['code' => '0151-2/01', 'name' => 'Criação de bovinos para corte'],
            ['code' => '0151-2/02', 'name' => 'Criação de bovinos para leite'],
            ['code' => '0151-2/03', 'name' => 'Criação de bovinos, exceto para corte e leite'],
            ['code' => '0152-1/01', 'name' => 'Criação de bufalinos'],
            ['code' => '0152-1/02', 'name' => 'Criação de eqüinos'],
            ['code' => '0152-1/03', 'name' => 'Criação de asininos e muares'],
            ['code' => '0153-9/01', 'name' => 'Criação de caprinos'],
            ['code' => '0153-9/02', 'name' => 'Criação de ovinos, inclusive para produção de lã'],
            ['code' => '0154-7/00', 'name' => 'Criação de suínos'],
            ['code' => '0155-5/01', 'name' => 'Criação de frangos para corte'],
            ['code' => '0155-5/02', 'name' => 'Produção de pintos de um dia'],
            ['code' => '0155-5/03', 'name' => 'Criação de outros galináceos, exceto para corte'],
            ['code' => '0155-5/04', 'name' => 'Criação de aves, exceto galináceos'],
            ['code' => '0155-5/05', 'name' => 'Produção de ovos'],
            ['code' => '0159-8/01', 'name' => 'Apicultura'],
            ['code' => '0159-8/02', 'name' => 'Criação de animais de estimação'],
            ['code' => '0159-8/03', 'name' => 'Criação de escargô'],
            ['code' => '0159-8/04', 'name' => 'Criação de bicho-da-seda'],
            ['code' => '0159-8/99', 'name' => 'Criação de outros animais não especificados anteriormente'],
            ['code' => '0161-0/01', 'name' => 'Serviço de pulverização e controle de pragas agrícolas'],
            ['code' => '0161-0/02', 'name' => 'Serviço de poda de árvores para lavouras'],
            ['code' => '0161-0/03', 'name' => 'Serviço de preparação de terreno, cultivo e colheita'],
            ['code' => '0161-0/99', 'name' => 'Atividades de apoio à agricultura não especificadas anteriormente'],
            ['code' => '0162-8/01', 'name' => 'Serviço de inseminação artificial de animais'],
            ['code' => '0162-8/02', 'name' => 'Serviço de tosquiamento de ovinos'],
            ['code' => '0162-8/03', 'name' => 'Serviço de manejo de animais'],
            ['code' => '0162-8/99', 'name' => 'Atividades de apoio à pecuária não especificadas anteriormente'],
            ['code' => '0163-6/00', 'name' => 'Atividades de pós-colheita'],
            ['code' => '0170-9/00', 'name' => 'Caça e serviços relacionados'],
            ['code' => '0210-1/01', 'name' => 'Cultivo de eucalipto'],
            ['code' => '0210-1/02', 'name' => 'Cultivo de acácia-negra'],
            ['code' => '0210-1/03', 'name' => 'Cultivo de pinus'],
            ['code' => '0210-1/04', 'name' => 'Cultivo de teca'],
            ['code' => '0210-1/05', 'name' => 'Cultivo de espécies madeireiras, exceto eucalipto, acácia-negra, pinus e teca'],
            ['code' => '0210-1/06', 'name' => 'Cultivo de mudas em viveiros florestais'],
            ['code' => '0210-1/07', 'name' => 'Extração de madeira em florestas plantadas'],
            ['code' => '0210-1/08', 'name' => 'Produção de carvão vegetal - florestas plantadas'],
            ['code' => '0210-1/09', 'name' => 'Produção de casca de acácia-negra - florestas plantadas'],
            ['code' => '0210-1/99', 'name' => 'Produção de produtos não-madeireiros não especificados anteriormente em florestas plantadas'],
            ['code' => '0220-9/01', 'name' => 'Extração de madeira em florestas nativas'],
            ['code' => '0220-9/02', 'name' => 'Produção de carvão vegetal - florestas nativas'],
            ['code' => '0220-9/03', 'name' => 'Coleta de castanha-do-pará em florestas nativas'],
            ['code' => '0220-9/04', 'name' => 'Coleta de látex em florestas nativas'],
            ['code' => '0220-9/05', 'name' => 'Coleta de palmito em florestas nativas'],
            ['code' => '0220-9/06', 'name' => 'Conservação de florestas nativas'],
            ['code' => '0220-9/99', 'name' => 'Coleta de produtos não-madeireiros não especificados anteriormente em florestas nativas'],
            ['code' => '0230-6/00', 'name' => 'Atividades de apoio à produção florestal'],
            ['code' => '0311-6/01', 'name' => 'Pesca de peixes em água salgada'],
            ['code' => '0311-6/02', 'name' => 'Pesca de crustáceos e moluscos em água salgada'],
            ['code' => '0311-6/03', 'name' => 'Coleta de outros produtos marinhos'],
            ['code' => '0311-6/04', 'name' => 'Atividades de apoio à pesca em água salgada'],
            ['code' => '0312-4/01', 'name' => 'Pesca de peixes em água doce'],
            ['code' => '0312-4/02', 'name' => 'Pesca de crustáceos e moluscos em água doce'],
            ['code' => '0312-4/03', 'name' => 'Coleta de outros produtos aquáticos de água doce'],
            ['code' => '0312-4/04', 'name' => 'Atividades de apoio à pesca em água doce'],
            ['code' => '0321-3/01', 'name' => 'Criação de peixes em água salgada e salobra'],
            ['code' => '0321-3/02', 'name' => 'Criação de camarões em água salgada e salobra'],
            ['code' => '0321-3/03', 'name' => 'Criação de ostras e mexilhões em água salgada e salobra'],
            ['code' => '0321-3/04', 'name' => 'Criação de peixes ornamentais em água salgada e salobra'],
            ['code' => '0321-3/05', 'name' => 'Atividades de apoio à aqüicultura em água salgada e salobra'],
            ['code' => '0321-3/99', 'name' => 'Cultivos e semicultivos da aqüicultura em água salgada e salobra não especificados anteriormente'],
            ['code' => '0322-1/01', 'name' => 'Criação de peixes em água doce'],
            ['code' => '0322-1/02', 'name' => 'Criação de camarões em água doce'],
            ['code' => '0322-1/03', 'name' => 'Criação de ostras e mexilhões em água doce'],
            ['code' => '0322-1/04', 'name' => 'Criação de peixes ornamentais em água doce'],
            ['code' => '0322-1/05', 'name' => 'Ranicultura'],
            ['code' => '0322-1/06', 'name' => 'Criação de jacaré'],
            ['code' => '0322-1/07', 'name' => 'Atividades de apoio à aqüicultura em água doce'],
            ['code' => '0322-1/99', 'name' => 'Cultivos e semicultivos da aqüicultura em água doce não especificados anteriormente'],
            ['code' => '0500-3/01', 'name' => 'Extração de carvão mineral'],
        ];

        foreach ($cnaesData as $cnaeData) {
            Cnae::create($cnaeData);
        }
    }
}
