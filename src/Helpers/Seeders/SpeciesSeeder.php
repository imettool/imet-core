<?php

namespace ImetCore\Helpers\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use ImetCore\Factories\SpeciesFactory;
use ImetCore\Helpers\SpeciesUpdater;

class SpeciesSeeder extends Seeder
{
    use WithoutModelEvents;

    const int NUM_MODELS = 1000;

    public const array SAMPLE_DATA = [
        ['Animalia', 'Chordata', 'Mammalia', 'Cetacea', 'Delphinidae', 'Feresa', 'Feresa attenuata', 'Gray, 1874', '3DYJD', 'Pygmy Killer Whale', 'Orca pigmea', ''],
        ['Animalia', 'Chordata', 'Mammalia', 'Artiodactyla', 'Cervidae', 'Alces', 'Alces americanus', '(Clinton, 1822)', 'BHC4', 'Moose', '', ''],
        ['Animalia', 'Chordata', 'Mammalia', 'Lagomorpha', 'Leporidae', 'Oryctolagus', 'Oryctolagus cuniculus', '(Linnaeus, 1758)', '74ZBP', 'European Rabbit, Wild Rabbit', 'Conejo', ''],
        ['Animalia', 'Chordata', 'Mammalia', 'Artiodactyla', 'Giraffidae', 'Giraffa', 'Giraffa giraffa', '(von Schreber, 1784)', '3G3KP', 'Southern Giraffe', '', ''],
        ['Animalia', 'Chordata', 'Mammalia', 'Primates', 'Hominidae', 'Gorilla', 'Gorilla gorilla', '(Savage & Wyman, 1847)', '3H3C9', 'Western Gorilla, gorilla', '', ''],
        ['Animalia', 'Chordata', 'Mammalia', 'Carnivora', 'Otariidae', 'Otaria', 'Otaria byronia', '(de Blainville, 1820)', '4B23F', 'South American sea lion, South American sealion', '', ''],
        ['Animalia', 'Chordata', 'Mammalia', 'Artiodactyla', 'Cervidae', 'Alces', 'Alces alces', '(Linnaeus, 1758)', 'BHC3', 'Eurasian Elk, moose', '', 'orignal'],
        ['Animalia', 'Chordata', 'Aves', 'Charadriiformes', 'Alcidae', 'Fratercula', 'Fratercula arctica', '(Linnaeus, 1758)', '6JMR3', 'Atlantic Puffin', 'Frailecillo atlántico', 'Macareux moine'],
        ['Animalia', 'Chordata', 'Mammalia', 'Perissodactyla', 'Rhinocerotidae', 'Diceros', 'Diceros bicornis', '(Linnaeus, 1758)', '35JVB', 'African black rhinoceros, Black Rhinoceros', '', ''],
        ['Animalia', 'Chordata', 'Mammalia', 'Carnivora', 'Otariidae', 'Phocarctos', 'Phocarctos hookeri', '(Gray, 1844)', '4GK6L', "Auckland sea lion, Hooker's sea lion, New Zealand Sealion, New Zealand sea lion", '', ''],
        ['Animalia', 'Chordata', 'Aves', 'Anseriformes', 'Anatidae', 'Anas', 'Anas platyrhynchos', 'Linnaeus, 1758', 'DGP6', 'Mallard', 'Pato de collar, Ánade azulón', 'Canard colvert'],
        ['Animalia', 'Chordata', 'Mammalia', 'Primates', 'Hominidae', 'Pongo', 'Pongo pygmaeus', '(Linnaeus, 1760)', '4LTT2', 'Bornean Orangutan, orangutan', '', ''],
        ['Animalia', 'Chordata', 'Mammalia', 'Carnivora', 'Canidae', 'Otocyon', 'Otocyon megalotis', '(Desmarest, 1822)', '4B7CH', 'Bat-eared Fox, Big-eared Fox', '', ''],
        ['Animalia', 'Chordata', 'Mammalia', 'Carnivora', 'Ursidae', 'Ursus', 'Ursus arctos', 'Linnaeus, 1758', '7F2KB', 'Brown Bear, Grizzly Bear', 'Oso pardo', ''],
        ['Animalia', 'Chordata', 'Mammalia', 'Artiodactyla', 'Giraffidae', 'Giraffa', 'Giraffa camelopardalis', '(Linnaeus, 1758)', '3G3KN', 'Giraffe, Northern Giraffe', '', ''],
        ['Animalia', 'Chordata', 'Mammalia', 'Artiodactyla', 'Bovidae', 'Capra', 'Capra hircus', 'Linnaeus, 1758', 'QS68', 'Goat, domestic goat, goat (feral)', '', ''],
        ['Animalia', 'Chordata', 'Elasmobranchii', 'Lamniformes', 'Odontaspididae', 'Carcharias', 'Carcharias tricuspidatus', 'Day, 1878', '5WZJV', 'Indian sand tiger', '', ''],
        ['Animalia', 'Chordata', 'Mammalia', 'Primates', 'Hominidae', 'Homo', 'Homo sapiens', 'Linnaeus, 1758', '6MB3T', 'Human, Humans, man', '', ''],
        ['Animalia', 'Chordata', 'Aves', 'Accipitriformes', 'Accipitridae', 'Haliaeetus', 'Haliaeetus leucocephalus', '(Linnaeus, 1766)', '3JBJW', 'Bald Eagle', 'Pigargo americano, Águila cabeza blanca', 'Pygargue à tête blanche'],
        ['Animalia', 'Chordata', 'Mammalia', 'Diprotodontia', 'Macropodidae', 'Osphranter', 'Osphranter rufus', '(Desmarest, 1822)', 'KQB98', 'Red Kangaroo', '', ''],
        ['Animalia', 'Chordata', 'Mammalia', 'Cetacea', 'Delphinidae', 'Orcinus', 'Orcinus orca', '(Linnaeus, 1758)', '74SZC', 'Killer Whale, orca', 'Orca común', 'épaulard'],
        ['Animalia', 'Chordata', 'Aves', 'Anseriformes', 'Anatidae', 'Aix', 'Aix galericulata', '(Linnaeus, 1758)', '5TV4F', 'Mandarin Duck', 'Pato mandarín', 'Canard mandarin'],
        ['Animalia', 'Chordata', 'Elasmobranchii', 'Lamniformes', 'Lamnidae', 'Carcharodon', 'Carcharodon carcharias', '(Linnaeus, 1758)', '5WZLF', 'Tommy, anchovy-eater, blue pointer, cowshark, death shark, demon shark, great white death, great white shark, jumping shark, man-eater shark, mudshark, tuna shark, uptail, white death, white death shark, white pointer, white shark', 'ca mari, jaquetón blanco, jaquetón de ley, marraco, salproig, salproix, salroig, sarda, taburo, tauró blanc, tiburo, tiburón blanco', 'grand requin blanc, requin blanc'],
        ['Animalia', 'Chordata', 'Mammalia', 'Proboscidea', 'Elephantidae', 'Elephas', 'Elephas maximus', 'Linnaeus, 1758', '398D9', 'Asian Elephant, Asiatic Elephant', '', ''],
        ['Animalia', 'Chordata', 'Mammalia', 'Carnivora', 'Otariidae', 'Zalophus', 'Zalophus californianus', '(Lesson, 1828)', '5CV54', 'California Sealion, California sea lion', 'Lobo-marino californiano', ''],
        ['Animalia', 'Chordata', 'Mammalia', 'Carnivora', 'Felidae', 'Panthera', 'Panthera leo', '(Linnaeus, 1758)', '4CGXP', 'Lion', 'León', 'Lion'],
        ['Animalia', 'Chordata', 'Mammalia', 'Artiodactyla', 'Giraffidae', 'Giraffa', 'Giraffa tippelskirchi', 'Matschie, 1898', '3G3KR', 'Masai Giraffe', '', ''],
        ['Animalia', 'Chordata', 'Mammalia', 'Diprotodontia', 'Phascolarctidae', 'Phascolarctos', 'Phascolarctos cinereus', '(Goldfuss, 1817)', '4FVNB', 'Koala', '', ''],
        ['Animalia', 'Chordata', 'Mammalia', 'Rodentia', 'Muridae', 'Mus', 'Mus (Mus) musculus', 'Linnaeus, 1758', '7VW9H', 'House Mouse', '', 'souris commune'],
        ['Animalia', 'Chordata', 'Aves', 'Passeriformes', 'Corvidae', 'Corvus', 'Corvus corax', 'Linnaeus, 1758', 'YNHG', 'Common Raven, Northern Raven', 'Cuervo común', 'grand corbeau'],
        ['Animalia', 'Chordata', 'Mammalia', 'Cetacea', 'Delphinidae', 'Tursiops', 'Tursiops truncatus', '(Montagu, 1821)', '59R5F', 'Bottlenose Dolphin, Bottlenosed Dolphin, common bottlenose dolphin', 'Delfín tonina', ''],
        ['Animalia', 'Chordata', 'Aves', 'Struthioniformes', 'Struthionidae', 'Struthio', 'Struthio camelus', 'Linnaeus, 1758', '6ZYDX', 'Common Ostrich, Ostrich', '', ''],
        ['Animalia', 'Chordata', 'Aves', 'Sphenisciformes', 'Spheniscidae', 'Aptenodytes', 'Aptenodytes forsteri', 'G. R. Gray, 1844', 'FYD9', 'Emperor Penguin', 'Pingüino emperador', 'Manchot empereur'],
        ['Animalia', 'Chordata', 'Mammalia', 'Artiodactyla', 'Bovidae', 'Bos', 'Bos taurus', 'Linnaeus, 1758', 'MLQ5', 'domestic cattle (feral), domesticated cattle', '', ''],
        ['Animalia', 'Chordata', '', 'Testudines', 'Cheloniidae', 'Chelonia', 'Chelonia mydas', '(Linnaeus, 1758)', 'TVGD', '', 'Tortuga Blanca de Mar', ''],
        ['Animalia', 'Chordata', '', 'Squamata', 'Iguanidae', 'Iguana', 'Iguana iguana', '(Linnaeus, 1758)', '6MV3G', 'Common Green Iguana, Grenadines horned iguana, Saint Lucia horned iguana [sanctaluciae], pink rhino iguana [insularis]', 'Iguana de Ribera', ''],
        ['Animalia', 'Chordata', 'Mammalia', 'Carnivora', 'Felidae', 'Felis', 'Felis catus', 'Linnaeus, 1758', '3DXV3', 'Domestic Cat', '', ''],
        ['Animalia', 'Chordata', 'Mammalia', 'Carnivora', 'Otariidae', 'Neophoca', 'Neophoca cinerea', '(Péron, 1816)', '46Q8P', 'Australian Sealion, Australian sea lion, white-capped sea lion', '', ''],
        ['Animalia', 'Chordata', 'Mammalia', 'Artiodactyla', 'Suidae', 'Sus', 'Sus celebensis', 'Müller & Schlegel, 1843', '53HGK', 'Celebes Warty Pig, Celebes wild boar', '', ''],
        ['Animalia', 'Chordata', 'Amphibia', 'Caudata', 'Ambystomatidae', 'Ambystoma', 'Ambystoma mexicanum', '(Shaw & Nodder, 1798)', 'CQ4M', 'Axolotl', 'Salamandra ajolote', ''],
        ['Animalia', 'Chordata', 'Elasmobranchii', 'Lamniformes', 'Odontaspididae', 'Odontaspis', 'Odontaspis noronhai', '(Maul, 1955)', '48NNK', 'bigeye sand tiger, black sand tiger, oceanic sand tiger', 'solrayo ojigrande', 'requin noronhai'],
        ['Animalia', 'Chordata', '', 'Squamata', 'Varanidae', 'Varanus', 'Varanus komodoensis', 'Ouwens, 1912', '7FFW5', 'Komodo Dragon', '', ''],
        ['Animalia', 'Chordata', 'Mammalia', 'Carnivora', 'Canidae', 'Vulpes', 'Vulpes vulpes', '(Linnaeus, 1758)', '5BSG3', 'Red Fox', '', 'renard roux'],
        ['Animalia', 'Chordata', '', 'Crocodylia', 'Crocodylidae', 'Crocodylus', 'Crocodylus niloticus', 'Laurenti, 1768', 'ZKNK', 'Nile crocodile', '', ''],
        ['Animalia', 'Chordata', 'Mammalia', 'Rodentia', 'Caviidae', 'Hydrochoerus', 'Hydrochoerus hydrochaeris', '(Linnaeus, 1766)', '6MK7J', 'Capybara, Greater Capybara', '', ''],
        ['Animalia', 'Chordata', 'Mammalia', 'Artiodactyla', 'Giraffidae', 'Giraffa', 'Giraffa reticulata', 'de Winton, 1899', '3G3KQ', 'Reticulated Giraffe', '', ''],
        ['Animalia', 'Chordata', 'Mammalia', 'Cetacea', 'Balaenopteridae', 'Balaenoptera', 'Balaenoptera musculus', '(Linnaeus, 1758)', 'KF8T', 'Blue Whale', 'Ballena azul', 'rorqual bleu'],
        ['Animalia', 'Chordata', 'Mammalia', 'Cetacea', 'Delphinidae', 'Delphinus', 'Delphinus delphis', 'Linnaeus, 1758', '34JWM', 'Short-beaked Common Dolphin, Short-beaked Saddleback Dolphin, common dolphin, saddle-backed dolphin, short-beaked saddle-backed dolphin', 'Delfín común', ''],
        ['Animalia', 'Chordata', 'Mammalia', 'Rodentia', 'Caviidae', 'Hydrochoerus', 'Hydrochoerus isthmius', 'Goldman, 1912', '3N64F', 'Lesser Capybara', '', ''],
        ['Animalia', 'Chordata', 'Aves', 'Strigiformes', 'Strigidae', 'Bubo', 'Bubo bubo', '(Linnaeus, 1758)', 'NKSD', 'Eurasian Eagle-Owl', 'Búho real', "Grand-duc d'Europe"],
        ['Animalia', 'Chordata', '', 'Squamata', 'Elapidae', 'Naja', 'Naja naja', '(Linnaeus, 1758)', '45KXG', 'Common cobra, Spectacled cobra', '', ''],
        ['Animalia', 'Chordata', 'Aves', 'Falconiformes', 'Falconidae', 'Falco', 'Falco peregrinus', 'Tunstall, 1771', '3DTGL', 'Peregrine Falcon', 'Halcón peregrino', 'Faucon pèlerin'],
        ['Animalia', 'Chordata', 'Mammalia', 'Carnivora', 'Otariidae', 'Zalophus', 'Zalophus wollebaeki', 'Sivertsen, 1953', '5CV57', 'Galápagos sea lion', '', ''],
        ['Animalia', 'Chordata', 'Mammalia', 'Carnivora', 'Otariidae', 'Eumetopias', 'Eumetopias jubatus', '(Schreber, 1776)', '6H93Y', "Northern Sea Lion, Steller Sea Lion, Steller's sea lion", '', ''],
        ['Animalia', 'Chordata', 'Aves', 'Accipitriformes', 'Accipitridae', 'Buteo', 'Buteo jamaicensis', '(J. F. Gmelin, 1788)', '69669', 'Red-tailed Hawk', 'Aguililla cola roja, Busardo colirrojo', 'Buse à queue rousse'],
        ['Animalia', 'Chordata', 'Aves', 'Ciconiiformes', 'Ciconiidae', 'Ciconia', 'Ciconia ciconia', '(Linnaeus, 1758)', '5Z5T3', 'White Stork', 'Cigüeña blanca', 'Cigogne blanche'],
        ['Animalia', 'Chordata', 'Mammalia', 'Artiodactyla', 'Suidae', 'Sus', 'Sus scrofa', 'Linnaeus, 1758', '53HGR', 'pig, pig (feral), wild boar', '', ''],
        ['Animalia', 'Chordata', 'Mammalia', 'Carnivora', 'Ursidae', 'Ailuropoda', 'Ailuropoda melanoleuca', '(David, 1869)', '6673Q', 'Bamboo Bear, Giant Panda, Great Panda, Panda Bear, Parti-colored Bear, White Bear', '', ''],
        ['Animalia', 'Chordata', 'Mammalia', 'Cetacea', 'Delphinidae', 'Pseudorca', 'Pseudorca crassidens', '(Owen, 1846)', '4P9FG', 'False Killer Whale', 'Orca-falsa', ''],
        ['Animalia', 'Chordata', 'Mammalia', 'Proboscidea', 'Elephantidae', 'Loxodonta', 'Loxodonta africana', '(Blumenbach, 1797)', '3W9KV', 'African Bush Elephant, African Savanna Elephant, African elephant, African savannah elephant', '', ''],
        ['Animalia', 'Chordata', 'Mammalia', 'Cetacea', 'Delphinidae', 'Orcinus', 'Orcinus rectipinnus', '(Cope in Scammon, 1869)', 'CBP3Q', "Bigg's Killer Whale", '', ''],
        ['Animalia', 'Chordata', 'Mammalia', 'Rodentia', 'Muridae', 'Rattus', 'Rattus norvegicus', '(Berkenhout, 1769)', '4RM67', 'Brown Rat, Norway Rat', '', 'rat surmulot'],
        ['Animalia', 'Chordata', 'Mammalia', 'Carnivora', 'Felidae', 'Panthera', 'Panthera tigris', '(Linnaeus, 1758)', '4CGXS', 'Tiger', 'Tigre', 'Tigre'],
        ['Animalia', 'Chordata', 'Mammalia', 'Carnivora', 'Mustelidae', 'Lutra', 'Lutra lutra', '(Linnaeus, 1758)', '72PQL', 'Common Otter, Eurasian Otter, European Otter', '', ''],
        ['Animalia', 'Chordata', 'Teleostei', 'Salmoniformes', 'Salmonidae', 'Salmo', 'Salmo salar', 'Linnaeus, 1758', '6XCXT', 'Atlantic salmon, N. Atlantic salmon, black salmon, common Atlantic salmon, grilse, kelt, parr, salmon, sea salmon, silver salmon', 'salmón, salmón común, salmón del Atlántico', "saumon, saumon Atlantique, saumon d'Atlantique, saumon de l'Atlantique, tacon Atlantique"],
        ['Animalia', 'Chordata', 'Mammalia', 'Carnivora', 'Canidae', 'Canis', 'Canis lupus', 'Linnaeus, 1758', 'QLXL', 'Gray Wolf, Wolf', 'Lobo gris', 'loup'],
    ];

    public function run(): void
    {
        $this->runWithSample(false);
    }

    /**
     * Run the database seeders using Sample data
     */
    public function runWithSample(?bool $from_file = false): void
    {
        // Run on CSV file if exists, otherwise use sample data
        if ($from_file &&
            file_exists(database_path(SpeciesUpdater::CSV_SPECIES_PATH)) &&
            file_exists(database_path(SpeciesUpdater::CSV_NAMES_PATH))
        ) {
            SpeciesUpdater::insertSpeciesAndVernacularNames(Str::uuid()->toString());

            return;
        }

        foreach (self::SAMPLE_DATA as $species) {
            SpeciesFactory::new()->create([
                'kingdom' => $species[0],
                'phylum' => $species[1],
                'class' => $species[2],
                'order' => $species[3],
                'family' => $species[4],
                'genus' => $species[5],
                'species' => $species[6],
                'authorship' => $species[7],
                'col_id' => $species[8],
                'vernacular_names_eng' => $species[9],
                'vernacular_names_spa' => $species[10],
                'vernacular_names_fra' => $species[11],
            ]);
        }
    }

    /**
     * Run the database seeders using Factory
     */
    public function runWithFactory(?int $num = self::NUM_MODELS): void
    {
        SpeciesFactory::new()
            ->count($num)
            ->create();
    }
}
