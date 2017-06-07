<?php

/*
 * This file is part of the PhpCsFixerConfig project.
 *
 * Copyright (c) 2017-present LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Spec\LIN3S\PhpCsFixerConfig;

use LIN3S\PhpCsFixerConfig\Lin3sConfig;
use PhpSpec\ObjectBehavior;

class Lin3sConfigSpec extends ObjectBehavior
{
    function it_gets_rules_array()
    {
        $this->beConstructedWith('Our awesome project', '2017');
        $this->shouldHaveType(Lin3sConfig::class);
        $this->getRules()->shouldBeArray();
    }

    function it_gets_required_visibility_rule_when_is_phpspec_configuration()
    {
        $this->beConstructedWith('Our awesome project', '2017', true);
        $this->getRules()->shouldBeArray();
        $this->getRules()->shouldHaveKeyWithValue('visibility_required', false);
    }
}
