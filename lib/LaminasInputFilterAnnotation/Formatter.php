<?php

/*
 * The MIT License
 *
 * Copyright (c) 2010 Johannes Mueller <circus2(at)web.de>
 * Copyright (c) 2012-2024 Toha <tohenk@yahoo.com>
 * Copyright (c) 2013 WitteStier <development@wittestier.nl>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace MwbExporter\Formatter\Doctrine2\LaminasInputFilterAnnotation;

use MwbExporter\Configuration\Filename as FilenameConfiguration;
use MwbExporter\Formatter\Doctrine2\Annotation\Formatter as BaseFormatter;
use MwbExporter\Formatter\Doctrine2\LaminasInputFilterAnnotation\Configuration\EntityArrayCopy as EntityArrayCopyConfiguration;
use MwbExporter\Formatter\Doctrine2\LaminasInputFilterAnnotation\Configuration\EntityPopulate as EntityPopulateConfiguration;
use MwbExporter\Model\Base;

class Formatter extends BaseFormatter
{
    /**
     * (non-PHPdoc)
     * @see \MwbExporter\Formatter\Formatter::init()
     */
    protected function init()
    {
        parent::init();
        $this->getConfigurations()
            ->add(new EntityPopulateConfiguration())
            ->add(new EntityArrayCopyConfiguration())
            ->merge([
                FilenameConfiguration::class => 'Entity/%entity%.%extension%',
            ], true)
        ;
    }

    /**
     * (non-PHPdoc)
     * @see \MwbExporter\Formatter\Formatter::createDatatypeConverter()
     */
    protected function createDatatypeConverter()
    {
        return new DatatypeConverter();
    }

    /**
     * (non-PHPdoc)
     * @see \MwbExporter\Formatter\Formatter::createTable()
     */
    public function createTable(Base $parent, $node)
    {
        return new Model\Table($parent, $node);
    }

    /**
     * (non-PHPdoc)
     * @see \MwbExporter\Formatter\Formatter::getTitle()
     */
    public function getTitle()
    {
        return 'Doctrine 2.0 Annotation with Laminas input filter Classes';
    }

    /**
     * (non-PHPdoc)
     * @see \MwbExporter\Formatter\Formatter::getFileExtension()
     */
    public function getFileExtension()
    {
        return 'php';
    }

    /**
     * Get configuration scope.
     *
     * @return string
     */
    public static function getScope()
    {
        return 'Doctrine 2.0 Annotation Laminas Input Filter';
    }
}
