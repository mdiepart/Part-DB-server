<?php
/**
 * This file is part of Part-DB (https://github.com/Part-DB/Part-DB-symfony).
 *
 * Copyright (C) 2019 - 2020 Jan Böhmer (https://github.com/jbtronics)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

declare(strict_types=1);

namespace App\Tests\Services\Misc;

use App\Services\Misc\FAIconGenerator;
use App\Tests\Services\AmountFormatter;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FAIconGeneratorTest extends WebTestCase
{
    /**
     * @var AmountFormatter
     */
    protected $service;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        //Get an service instance.
        self::bootKernel();
        $this->service = self::$container->get(FAIconGenerator::class);
    }

    public function fileExtensionDataProvider(): array
    {
        return [
            ['pdf', 'fa-file-pdf'],
            ['jpeg', 'fa-file-image'],
            ['txt', 'fa-file-alt'],
            ['doc', 'fa-file-word'],
            ['zip', 'fa-file-archive'],
            ['php', 'fa-file-code'],
            ['tmp', 'fa-file'],
            ['fgd', 'fa-file'],
        ];
    }

    /**
     * @dataProvider fileExtensionDataProvider
     */
    public function testFileExtensionToFAType(string $ext, string $expected): void
    {
        $this->assertSame($expected, $this->service->fileExtensionToFAType($ext));
    }

    public function testGenerateIconHTML(): void
    {
        $this->assertSame('<i class="fa-solid fa-file "></i>', $this->service->generateIconHTML('fa-file'));
        $this->assertSame('<i class="far fa-file "></i>', $this->service->generateIconHTML('fa-file', 'far'));
        $this->assertSame('<i class="far fa-file fa-2x"></i>', $this->service->generateIconHTML('fa-file', 'far', 'fa-2x'));
    }
}