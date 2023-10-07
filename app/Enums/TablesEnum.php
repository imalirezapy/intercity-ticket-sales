<?php

namespace App\Enums;

enum TablesEnum : string
{
    case USERS = 'users';
    case PASSWORD_RESET_TOKENS = 'password_reset_tokens';
    case PERSONAL_ACCESS_TOKENS = 'personal_access_tokens';
    case PLANS = 'plans';
}
