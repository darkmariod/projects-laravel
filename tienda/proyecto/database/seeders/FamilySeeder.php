<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //<?php

        $families = [
        // Nutrición Deportiva  
        'Nutrición Deportiva' => [
        // Proteínas Whey
        '100% Whey Gold Standard 2 lb Frutilla',    
        '100% Whey Gold Standard 2 lb Chocolate',   
        '100% Whey Gold Standard 5 lb Vainilla',   
        '100% Whey Gold Standard 5 lb Frutilla',    
        'Isopure Proteína 3 lb Vainilla',            
        'Dymatize Proteína ISO-100 650 g Gourmet Chocolate', 
        'Dymatize Proteína ISO-100 650 g Brownie',  
        'Athletica Suplemento Proteico Premium 1.8 kg Vainilla',   
        'Athletica Suplemento Proteico Premium 1.8 kg Chocolate',   

        // Creatinas y Pre-entrenos
        'Saxofit Creatina Monohidrato 400 g',         
        'Saxofit Creatina Micronizada 400 g',       
        'Optimum Creatina 2500 mg (200 caps)',        
        'Chitos Pulse Creatina 300 g',               
        'Mt Hydroxycut Quemador de Grasa Hardcore Elite 110 ct', 
        'CBN Suplemento Alimenticio 10 000 mcg (60 caps)',  
        'C4 Energético Pre-entreno Creatina 30 servidas Ponche de Frutas',  

        // Otros suplementos deportivos
        'HMB 1000 mg 90 caps (Vegano)',              
        'Athletica Pre Entreno Lipo Burn 60 caps',   
        'GNC Mega Men Sport 180 caps',                
        'Swanson Suplemento Dietario Ultra Alpha Lipoic Acid (60 caps)',  
        'Swanson Suplemento Dietario Ultra B-12 Methylcobalamin (60 caps)',  
    ],

    // Cuidado de Salud  
    'Cuidado de Salud' => [
        'GNC Herbal Plus Suplemento Alimenticio con Fruta de Arándano (500 mg – 100 caps)', 
        'Swanson Suplemento Dietario Ultra Alpha Lipoic Acid (60 caps)', 
        'Swanson Suplemento Dietario Ultra B-12 Methylcobalamin (60 caps)',  
        'CBN Suplemento Alimenticio 10 000 mcg (60 caps)',  
        'HMB 1000 mg 90 caps (Vegano)', 
    ],

    // Accesorios (Shakers, Bottles, etc.)
    'Accesorios' => [
        'Shaker deportivo 700 ml',   
        'Botella térmica 1 l',        
        'Cinturón de levantamiento de pesas',
        'Guantes de gimnasio',         
    ],
];

    
    }
}
