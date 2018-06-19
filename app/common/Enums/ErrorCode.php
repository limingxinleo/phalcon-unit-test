<?php
// +----------------------------------------------------------------------
// | ErrorCode.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Common\Enums;

use Xin\Phalcon\Enum\Enum;

class ErrorCode extends Enum
{
    /**
     * @Message('系统错误')
     */
    public static $ENUM_SYSTEM_ERROR = 400;

    /**
     * @Message('TOKEN 不符')
     */
    public static $ENUM_AUTH_TOKEN_ERROR = 1001;

    /**
     * @Message('SESSION ERROR')
     */
    public static $ENUM_SESSION_ERROR = 1002;

    /**
     * @Message('Invoke测试 至少传入一个参数')
     */
    public static $ENUM_INVOKE_ERROR = 2000;

    /**
     * @Message('Calculater 未定义')
     */
    public static $ENUM_CALCULATER_NOT_DEFINED = 2001;

    /**
     * @Message('Calculater 表达式不合法')
     */
    public static $ENUM_CALCULATER_STRING_INVALID = 2002;

    /**
     * @Message('Excel 不合法')
     */
    public static $ENUM_EXCEL_INVALID = 2003;
}
