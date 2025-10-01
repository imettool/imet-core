/*
 * Copyright (C) 2025 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

BEGIN;

RENAME SCHEMA imet TO imet_v1v2;

RENAME TABLE imet_common.imet_countries TO imet_common.countries;
RENAME TABLE imet_common.imet_currencies TO imet_common.currencies;
RENAME TABLE imet_common.imet_pas_non_wdpa TO imet_common.protected_areas_non_wdpa;
RENAME TABLE imet_common.imet_pas TO imet_common.protected_areas;
RENAME TABLE imet_common.imet_regions TO imet_common.regions;

RENAME TABLE imet_v1v2.imet_form TO imet_v1v2.forms
RENAME TABLE imet_oecm.imet_form TO imet_oecm.forms
RENAME TABLE imet_v1v2.imet_report TO imet_v1v2.report
RENAME TABLE imet_oecm.imet_report TO imet_oecm.report
RENAME TABLE imet_v1v2.imet_encoders TO imet_v1v2.encoders
RENAME TABLE imet_oecm.imet_encoders TO imet_oecm.encoders


COMMIT;