<?php
// +----------------------------------------------------------------------
// | ExcelTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Others;

use App\Common\Enums\ErrorCode;
use App\Common\Exceptions\BizException;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Tests\UnitTestCase;

/**
 * Class UnitTest
 */
class ExcelTest extends UnitTestCase
{
    public function testRead()
    {
        $file = TESTS_PATH . '/_data/question.xlsx';
        $loader = IOFactory::load($file);
        $rows = $loader->getSheet(0)->getRowIterator();
        $result = [];
        foreach ($rows as $row) {
            $iterator = $row->getCellIterator();
            $question = '';
            $options = [];
            $scores = [];
            $index = 0;
            foreach ($iterator as $cell) {
                if (is_null($cell->getValue())) {
                    break;
                }
                if (empty($question)) {
                    $question = $cell->getValue();
                } else {
                    switch ($index % 2) {
                        case 0:
                            $options[] = $cell->getValue();
                            break;
                        case 1:
                            $scores[] = $cell->getValue();
                            break;
                    }
                    $index++;
                }
            }

            if (empty($question)) {
                break;
            }

            if (count($options) !== count($scores)) {
                throw new BizException(ErrorCode::$ENUM_EXCEL_INVALID);
            }

            $result[] = [
                'question' => $question,
                'options' => $options,
                'scores' => $scores
            ];
        }

        $this->assertEquals([
            [
                'question' => '你好么？',
                'options' => [
                    '我很好',
                    '我不好'
                ],
                'scores' => [
                    1, 2
                ]
            ],
            [
                'question' => '你多少岁',
                'options' => [
                    '不到18',
                    '过了18岁了'
                ],
                'scores' => [
                    1, 2
                ],
            ]
        ], $result);
    }
}