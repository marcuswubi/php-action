<?php
namespace PHPAction\Concerns;

use Solis\Breaker\Abstractions\TExceptionAbstract;

trait HasActionSteps
{

    /**
     * Metodo responsavel por fazer algo antes de executar a acao
     * @param array $param
     * @return array
     */
    public function beforeDo(
        array $param
    ): array {
        try {
            return $this->before($param);
        } catch (TExceptionAbstract $e) {
            //ADICIONA FALHA VIA HASPREPARERETORNO
            $this->newFail(strtoupper($e->getMessage()));
            return [
                'success' => false,
                'message' => strtoupper($e->getMessage())
            ];
        } catch (\Exception $e) {
            //ADICIONA FALHA VIA HASPREPARERETORNO
            $this->newFail(strtoupper($e->getMessage()));
            return [
                'success' => false,
                'message' => strtoupper($e->getMessage())
            ];
        }
    }

    /**
     * Metodo responsavel por fazer algo depois de executar a acao
     * @param array $param
     * @return array
     */
    public function afterDo(
        array $param
    ): array {
        try {
            return $this->after($param);
        } catch (TExceptionAbstract $e) {
            //ADICIONA FALHA VIA HASPREPARERETORNO
            $this->newFail(strtoupper($e->getMessage()));
            return [
                'success' => false,
                'message' => strtoupper($e->getMessage())
            ];
        } catch (\Exception $e) {
            //ADICIONA FALHA VIA HASPREPARERETORNO
            $this->newFail(strtoupper($e->getMessage()));
            return [
                'success' => false,
                'message' => strtoupper($e->getMessage())
            ];
        }
    }

    /**
     * Metodo que inicia a execucao da acao
     * @return bool
     */
    public function beginAction(): bool
    {
        return true;
    }

    /**
     * Metodo que inicia a execucao da acao
     * @return bool
     */
    public function endAction(): bool
    {
        return true;
    }
}
