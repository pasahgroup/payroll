<?php
namespace App\Lib\Enumerations;

class UserStatus
{
    public static $ACTIVE           = 1;
    public static $INACTIVE         = 2;
    public static $TERMINATE        = 3;
    public static $PROBATION_PERIOD = 0;
    public static $PERMANENT        = 1;
    public static $FULLTIME         = 2;
    public static $PARTTIME         = 3;
}
