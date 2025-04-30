BEGIN;

RENAME SCHEMA imet TO imet_v1v2;

RENAME TABLE imet_common.imet_countries TO imet_common.countries;
RENAME TABLE imet_common.imet_currencies TO imet_common.currencies;
RENAME TABLE imet_common.imet_pas_non_wdpa TO imet_common.protected_areas_non_wdpa;
RENAME TABLE imet_common.imet_pas TO imet_common.protected_areas;
RENAME TABLE imet_common.imet_regions TO imet_common.regions;


COMMIT;