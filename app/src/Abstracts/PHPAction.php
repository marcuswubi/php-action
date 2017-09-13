<?php
namespace PHPAction;

//dependencies
use PHPAction\Concerns\HasAction;
use PHPAction\Contracts\ActionContract;

/**
 * Class Action
 * @package PHPAction\Abstracts
 */
abstract class PHPAction implements ActionContract
{
    use HasAction;
}