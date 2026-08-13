<?php

namespace App\Enums;

enum Permission: string
{
    case ViewAnyAddress = 'viewAny address';
    case ViewAddress = 'view address';
    case CreateAddress = 'create address';
    case UpdateAddress = 'update address';
    case DeleteAddress = 'delete address';

    case ViewAnyAnnouncement = 'viewAny announcement';
    case ViewAnnouncement = 'view announcement';
    case CreateAnnouncement = 'create announcement';
    case UpdateAnnouncement = 'update announcement';
    case DeleteAnnouncement = 'delete announcement';

    case ViewAnyAttendance = 'viewAny attendance';
    case ViewAttendance = 'view attendance';
    case CreateAttendance = 'create attendance';
    case UpdateAttendance = 'update attendance';
    case DeleteAttendance = 'delete attendance';

    case ViewAnyCountry = 'viewAny country';
    case ViewCountry = 'view country';
    case CreateCountry = 'create country';
    case UpdateCountry = 'update country';
    case DeleteCountry = 'delete country';

    case ViewAnyEvent = 'viewAny event';
    case ViewEvent = 'view event';
    case CreateEvent = 'create event';
    case UpdateEvent = 'update event';
    case DeleteEvent = 'delete event';

    case ViewAnyEventFee = 'viewAny event fee';
    case ViewEventFee = 'view event fee';
    case CreateEventFee = 'create event fee';
    case UpdateEventFee = 'update event fee';
    case DeleteEventFee = 'delete event fee';

    case ViewAnyInstitution = 'viewAny institution';
    case ViewInstitution = 'view institution';
    case CreateInstitution = 'create institution';
    case UpdateInstitution = 'update institution';
    case DeleteInstitution = 'delete institution';

    case ViewAnyMember = 'viewAny member';
    case ViewMember = 'view member';
    case CreateMember = 'create member';
    case UpdateMember = 'update member';
    case DeleteMember = 'delete member';

    case ViewAnyMemberServiceYear = 'viewAny member service year';
    case ViewMemberServiceYear = 'view member service year';
    case CreateMemberServiceYear = 'create member service year';
    case UpdateMemberServiceYear = 'update member service year';
    case DeleteMemberServiceYear = 'delete member service year';

    case ViewAnyMunicipality = 'viewAny municipality';
    case ViewMunicipality = 'view municipality';
    case CreateMunicipality = 'create municipality';
    case UpdateMunicipality = 'update municipality';
    case DeleteMunicipality = 'delete municipality';

    case ViewAnyProvince = 'viewAny province';
    case ViewProvince = 'view province';
    case CreateProvince = 'create province';
    case UpdateProvince = 'update province';
    case DeleteProvince = 'delete province';

    case ViewAnyRegion = 'viewAny region';
    case ViewRegion = 'view region';
    case CreateRegion = 'create region';
    case UpdateRegion = 'update region';
    case DeleteRegion = 'delete region';

    case ViewAnySpeciesOfSpecialization = 'viewAny species of specialization';
    case ViewSpeciesOfSpecialization = 'view species of specialization';
    case CreateSpeciesOfSpecialization = 'create species of specialization';
    case UpdateSpeciesOfSpecialization = 'update species of specialization';
    case DeleteSpeciesOfSpecialization = 'delete species of specialization';

    case ViewAnySponsor = 'viewAny sponsor';
    case ViewSponsor = 'view sponsor';
    case CreateSponsor = 'create sponsor';
    case UpdateSponsor = 'update sponsor';
    case DeleteSponsor = 'delete sponsor';

    case ViewAnyTypeOfPractice = 'viewAny type of practice';
    case ViewTypeOfPractice = 'view type of practice';
    case CreateTypeOfPractice = 'create type of practice';
    case UpdateTypeOfPractice = 'update type of practice';
    case DeleteTypeOfPractice = 'delete type of practice';

    case ViewAnyUser = 'viewAny user';
    case ViewUser = 'view user';
    case CreateUser = 'create user';
    case UpdateUser = 'update user';
    case DeleteUser = 'delete user';
}
