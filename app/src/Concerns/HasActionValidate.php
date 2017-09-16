<?php
namespace PHPAction\Concerns;

//texception
use Solis\Breaker\Abstractions\TExceptionAbstract;

/**
 * Trait HasActionPrepare
 * @package PHPAction
 */
trait HasActionValidate
{
    /**
     * Converts a simple multi-dimensional array
     * @param $array
     * @param string $filterType
     */
    final protected function simpleArraytoMulti(
        &$array,
        $filterType = 'is_string'
    ) {
        $filteredArray = count(
            array_filter(
                array_keys($array),
                $filterType
            )
        ) > 0 ? [$array] : $array;

        $array = $filteredArray;
    }

    /**
     * This is the first Method. If you need to remove some params after processing, you can do here.
     * @param $param
     * @return mixed
     */
    public function prepareDoMany(
        $param
    ) {
        return $param;
    }

    /**
     * Can make Job Right Now? Put here code to check situation or status of record
     * @param $param
     * @return bool
     */
    public function canDoNow(
        $param
    ): bool {
        try {
            return true;
        } catch (TExceptionAbstract $e) {
            //ADICIONA FALHA VIA HASPREPARERETORNO
            $this->newFail(strtoupper($e->getMessage()));
            return false;
        } catch (\Exception $e) {
            //ADICIONA FALHA VIA HASPREPARERETORNO
            $this->newFail(strtoupper($e->getMessage()));
            return false;
        }
    }

    /**
     * Can Do This Job? Puit here code to check if record have requirements to run job
     * @return bool|string
     */
    public function canDo(
        $param
    ): bool {
    
        try {
            //RETORNO
            return true;
        } catch (TExceptionAbstract $e) {
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }
}
