<?php

namespace App\Enums;

enum ResponseMessageKeys : string
{
    // default messages
    case DEFAULT_SUCCESS_MESSAGE = 'DEFAULT_SUCCESS_MESSAGE';
    case DEFAULT_NOT_FOUND = 'DEFAULT_NOT_FOUND';
    case NOT_FOUND_ATTRIBUTABLE = 'NOT_FOUND_ATTRIBUTABLE';
    case DEFAULT_FAILED_MESSAGE = 'DEFAULT_FAILED_MESSAGE';
    case CREDENTIALS_ERROR = 'CREDENTIALS_ERROR';
    case NEW_TOKEN_GENERATED = 'NEW_TOKEN_GENERATED';
    case INVALID_SEATS_NUMBERS = 'INVALID_SEATS_NUMBERS';
    case SUCCESS_BOOKED_PLAN = 'SUCCESS_BOOKED_PLAN';
}
