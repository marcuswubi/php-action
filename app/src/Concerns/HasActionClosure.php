<?php
namespace PHPAction\Concerns;

/**
 * Trait HasActionClosure
 * @package PHPAction\Concerns
 */
trait HasActionClosure
{
    /**
     * Implement here by overriding, your closure to run when fail
     * @param $param
     */
    public function whenDoFail(
        $param
    ) {
        //IMPLEMENT HERE BY OVERRIDING, YOUR CLOSURE TO RUN WHEN FAIL
    }

    /**
     * Implement here by overriding, your closure to run when success
     * @param $param
     */
    public function whenDoSuccess(
        $param
    ) {
        //IMPLEMENT HERE BY OVERRIDING, YOUR CLOSURE TO RUN WHEN SUCCESS
    }
}
