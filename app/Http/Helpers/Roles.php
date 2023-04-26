<?php

namespace App\Http\Helpers;

use MyCLabs\Enum\Enum;

class Roles extends Enum
{
    public const SUPER_ADMIN = 'Super Admin';
    public const SUB_ADMIN = "Sub Admin";
    public const CLIENT = "Client";
    public const CONSULTANT = "Consultant";
}