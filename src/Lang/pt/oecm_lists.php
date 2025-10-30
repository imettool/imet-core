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

return [

    'GovernanceModel' => [
        'government' => 'Governança pelo governo',
        'shared' => 'Governança partilhada',
        'private' => 'Governança privada',
        'indigenous' => 'Governança por povos indígenas e comunidades locais',
        'not_reported' => 'Não reportado',
    ],

    'SubGovernanceModel' => [
        'government' => [
            'national' => 'Ministério ou agência federal/nacional',
            'sub_national' => 'Ministério ou agência subnacional',
            'delegated' => 'Gestão delegada pelo governo',
            'other' => 'Outro',
        ],
        'shared' => [
            'transboundary' => 'Governança transfronteiriça',
            'collaborative' => 'Governança colaborativa',
            'joint' => 'Governança conjunta',
            'other' => 'Outro',
        ],
        'private' => [
            'individual' => 'Proprietários de terras individuais',
            'non_profit' => 'Organização sem fins lucrativos',
            'for_profit' => 'Organizações com fins lucrativos',
            'other' => 'Outro',
        ],
        'indigenous' => [
            'indigenous' => 'Povos indígenas',
            'local_communities' => 'Comunidades locais',
            'other' => 'Outro',
        ],
    ],

];
