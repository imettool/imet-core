<?php

/*
 * Copyright (C) 2025 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

namespace ImetCore\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use ImetCore\Models\Species;

/**
 * Class ProtectedAreaFactory
 * Factory for creating instances of the ProtectedArea model for testing and seeding (ONLY DEV ENVIRONMENT).
 */
class SpeciesFactory extends Factory
{
    protected $model = Species::class;

    private const array SAMPLE_KINGDOMS = ['Animalia', 'Plantae'];
    private const array SAMPLE_PHYLA = ['Chordata', 'Arthropoda', 'Tracheophyta'];
    private const array SAMPLE_CLASSES = ['Actinopterygii', 'Amphibia', 'Arachnida', 'Aves', 'Cephalopoda', 'Chondrichthyes', 'Gastropoda', 'Insecta', 'Mammalia', 'Reptilia'];
    private const array SAMPLE_ORDERS = ['Artiodactyla', 'Carnivora', 'Cetacea', 'Chiroptera', 'Diptera', 'Lepidoptera', 'Perissodactyla', 'Primates', 'Rodentia', 'Squamata'];
    private const array SAMPLE_FAMILIES = ['Accipitridae', 'Bovidae', 'Canidae', 'Felidae', 'Hominidae', 'Muridae', 'Phasianidae', 'Salamandridae', 'Ursidae', 'Viperidae'];
    private const array SAMPLE_SCIENTIFIC_NAMES = [
        'Ailuropoda melanoleuca', 'Aix galericulata', 'Alces alces', 'Ambystoma mexicanum', 'Anas platyrhynchos',
        'Apis mellifera', 'Aptenodytes forsteri', 'Balaenoptera musculus', 'Bison bison', 'Bos taurus', 'Bubo bubo',
        'Buteo jamaicensis', 'Canis lupus', 'Capra hircus', 'Carcharodon carcharias', 'Chelonia mydas', 'Ciconia ciconia',
        'Corvus corax', 'Crocodylus niloticus', 'Delphinus delphis', 'Diceros bicornis', 'Elephas maximus',
        'Equus ferus caballus', 'Falco peregrinus', 'Felis catus', 'Fratercula arctica', 'Giraffa camelopardalis',
        'Gorilla gorilla', 'Haliaeetus leucocephalus', 'Homo sapiens', 'Hydrochoerus hydrochaeris', 'Iguana iguana',
        'Loxodonta africana', 'Lutra lutra', 'Macropus rufus', 'Mus musculus', 'Naja naja', 'Orcinus orca', 'Oryctolagus cuniculus',
        'Panthera leo', 'Panthera tigris', 'Phascolarctos cinereus', 'Pongo pygmaeus', 'Rattus norvegicus', 'Salmo salar',
        'Struthio camelus', 'Sus scrofa', 'Tursiops truncatus', 'Ursus arctos', 'Varanus komodoensis', 'Vulpes vulpes'
    ];

    private const array SAMPLE_VERNACULAR_NAMES_EN = [
        'Giant panda', 'Mandarin duck', 'Moose', 'Axolotl', 'Mallard', 'Western honey bee', 'Emperor penguin', 'Blue whale',
        'American bison', 'Domestic cattle', 'Eurasian eagle-owl', 'Red-tailed hawk', 'Gray wolf', 'Domestic goat', 'Great white shark',
        'Green sea turtle', 'White stork', 'Common raven', 'Nile crocodile', 'Common dolphin', 'Black rhinoceros', 'Asian elephant',
        'Domestic horse', 'Peregrine falcon', 'Domestic cat', 'Atlantic puffin', 'Giraffe', 'Western gorilla', 'Bald eagle', 'Human',
        'Capybara', 'Green iguana', 'African bush elephant', 'European otter', 'Red kangaroo', 'House mouse', 'Indian cobra',
        'Killer whale', 'European rabbit', 'Lion', 'Tiger', 'Koala', 'Bornean orangutan', 'Brown rat', 'Atlantic salmon', 'Common ostrich',
        'Wild boar', 'Common bottlenose dolphin', 'Brown bear', 'Komodo dragon', 'Red fox'
    ];

    private const array SAMPLE_VERNACULAR_NAMES_FR = [
        'Panda géant', 'Canard mandarin', 'Orignal', 'Axolotl', 'Canard colvert', 'Abeille domestique', 'Manchot empereur',
        'Baleine bleue', 'Bison d’Amérique', 'Bovin domestique', 'Grand-duc d’Europe', 'Buse à queue rousse', 'Loup gris',
        'Chèvre domestique', 'Grand requin blanc', 'Tortue verte', 'Cigogne blanche', 'Grand corbeau', 'Crocodile du Nil',
        'Dauphin commun', 'Rhinocéros noir', 'Éléphant d’Asie', 'Cheval domestique', 'Faucon pèlerin', 'Chat domestique',
        'Macareux moine', 'Girafe', 'Gorille de l’Ouest', 'Pygargue à tête blanche', 'Humain', 'Capybara', 'Iguane vert',
        'Éléphant de savane', 'Loutre d’Europe', 'Kangourou roux', 'Souris domestique', 'Cobra indien', 'Orque', 'Lapin de garenne',
        'Lion', 'Tigre', 'Koala', 'Orang-outan de Bornéo', 'Rat brun', 'Saumon atlantique', 'Autruche', 'Sanglier', 'Grand dauphin',
        'Ours brun', 'Dragon de Komodo', 'Renard roux'
    ];


    private const array SAMPLE_VERNACULAR_NAMES_SP = [
        'Panda gigante', 'Pato mandarín', 'Alce', 'Ajolote', 'Ánade real', 'Abeja europea', 'Pingüino emperador', 'Ballena azul',
        'Bisonte americano', 'Ganado vacuno', 'Búho real', 'Halcón cola roja', 'Lobo gris', 'Cabra doméstica', 'Tiburón blanco',
        'Tortuga verde', 'Cigüeña blanca', 'Cuervo común', 'Cocodrilo del Nilo', 'Delfín común', 'Rinoceronte negro', 'Elefante asiático',
        'Caballo doméstico', 'Halcón peregrino', 'Gato doméstico', 'Frailecillo atlántico', 'Jirafa', 'Gorila occidental',
        'Águila calva', 'Humano', 'Capibara', 'Iguana verde', 'Elefante africano', 'Nutria europea', 'Canguro rojo',
        'Ratón doméstico', 'Cobra india', 'Orca', 'Conejo europeo', 'León', 'Tigre', 'Koala', 'Orangután de Borneo',
        'Rata parda', 'Salmón del Atlántico', 'Avestruz', 'Jabalí', 'Delfín mular', 'Oso pardo', 'Dragón de Komodo', 'Zorro rojo'
    ];

    public function definition(): array
    {
        $species = explode(' ', $this->faker->randomElement(self::SAMPLE_SCIENTIFIC_NAMES));
        return [
            'kingdom' => $this->faker->randomElement(self::SAMPLE_KINGDOMS),
            'phylum' => $this->faker->randomElement(self::SAMPLE_PHYLA),
            'class' => $this->faker->randomElement(self::SAMPLE_CLASSES),
            'order' => $this->faker->randomElement(self::SAMPLE_ORDERS),
            'family' => $this->faker->randomElement(self::SAMPLE_FAMILIES),
            'genus' => $species[0],
            'species' => $species[1],
            'authorship' => fake()->lastName() . ' ' . fake()->year(),
            'col_id' => fake()->bothify('******'),
            'vernacular_names_eng' => $this->faker->randomElement(self::SAMPLE_VERNACULAR_NAMES_EN),
            'vernacular_names_spa' => $this->faker->randomElement(self::SAMPLE_VERNACULAR_NAMES_SP),
            'vernacular_names_fra' => $this->faker->randomElement(self::SAMPLE_VERNACULAR_NAMES_FR),
        ];
    }
}
