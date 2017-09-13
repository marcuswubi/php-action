<?php
namespace PHPAction\Contracts;

//texception
use Solis\Breaker\TException;

/**
 * Interface ActionContract
 * @package MsNFSe\Modules\NFSe\Actions\Contracts
 */
interface ActionContract
{

    /**
     * @param $param
     * @return mixed
     */
    public function prepareDo(
        $param
    );

    /**
     * @param $param
     * @return bool
     */
    public function canDo (
        $param
    ): bool;

    /**
     * @param $param
     * @return bool
     */
    public function canDoNow(
        $param
    ): bool;

    /**
     * @param array $param
     * @return array
     */
    public function beforeDo (
        array $param
    ): array;

    /**
     * @param array $param
     * @return mixed
     */
    public function afterDo (
        array $param
    );

    /**
     * @return bool
     */
    public function beginAction(): bool;

    /**
     * Método que executa a função que implementa a acao
     * Escreva dentro desse metodo a sua implementacao da rotina
     * @param $param
     */
    public function doWhat (
        $param
    );

    /**
     * Metodo responsavel por controlar o fluxo da execucao da acao
     * @param $param
     * @return bool|void
     */
    public function doOne(
        $param
    );

    /**
     * Metodo que Executa 1 ou N Acoes atraves do metodo doOne
     * @param array $params
     * @return mixed
     * @throws TException
     */
    public function doMany(
        array $params
    );

    /**
     * @return bool
     */
    public function endAction(): bool;

    /**
     * Metodo responsavel por executar o callback|closure quando a acao falha
     * @param array $param
     * @return array
     */
    public function whenDoFail (
        $param
    );

    /**
     * Metodo responsavel por executar o callback|closure quando a acao tem sucesso
     * @param array $param
     * @return array
     */
    public function whenDoSuccess (
        $param
    );
}
