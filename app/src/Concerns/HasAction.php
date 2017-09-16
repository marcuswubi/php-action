<?php
namespace PHPAction\Concerns;

//texception
use Solis\Breaker\Abstractions\TExceptionAbstract;
use Solis\Breaker\TException;

/**
 * Trait HasAction
 * @package PHPAction\Concerns
 */
trait HasAction
{
    //action traits
    use HasModel;
    use HasRetorno;
    use HasActionValidate;
    use HasActionSteps;
    use HasActionClosure;

    //Propriedades de referencia da Acao
    protected $doAction;
    protected $params;

    /**
     * This is the real method able to run action is doWhat
     * @param $param
     * @return bool
     */
    public function doWhat(
        $param
    ): bool {
        //ESCREVA DENTRO DESSE METODO A SUA IMPLEMENTACAO DA ROTINA
        return true;
    }

    /**
     * This method encapsule a singular action. The real method able to run action is doWhat
     * @param $param
     * @return bool
     */
    public function doOne(
        $param
    ) {
        try {
            // ANTES DE EXECUTAR A ACAO
            $beforeDo = $this->beforeDo($param);
            if (empty($beforeDo['success']) ||
                $beforeDo['success'] !== true
            ) {
                return false;
            }

            //VALIDA A EXECUCAO DA ACAO
            if ($this->canDo($beforeDo['param']) !== true) {
                return false;
            }

            //VALIDA A EXECUCAO DA ACAO
            if ($this->canDoNow($beforeDo['param']) !== true) {
                return false;
            }

            //METODO QUE INICIA A EXECUCAO DA ACAO
            if ($this->beginAction() !== true) {
                return false;
            }

            //EXECUTA O METODO QUE IMPLEMENTA A ACAO
            //PARA RESPEITAR O CONTRATO DEVE SER ESCRITO NA CLASSE QUE EXECUTA A ACTION
            if ($this->doWhat($param) !== true) {
                return false;
            }

            // DEPOIS DE EXECUTAR A ACAO
            $afterDo = $this->afterDo($param);
            if (empty($afterDo['success']) ||
                $afterDo['success'] !== true
            ) {
                return false;
            }

            //METODO QUE INICIA A EXECUCAO DA ACAO
            if ($this->endAction() !== true) {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Run many of same action...
     * @param array $params
     * @return mixed
     * @throws TException
     */
    public function doMany(
        array $params
    ) {
        try {
            //CHECK PARAM
            if (empty($params)) {
                throw new TException(
                    __CLASS__,
                    __METHOD__,
                    'METHOD: [ ' . __METHOD__ . ' ], OF CLASS: [ ' . __CLASS__ . ' ], CANNOT BE EMPTY.',
                    400
                );
            }

            //EXECUTA O METODO QUE INTERCEPTA OS PARAMETROS ANTES DE EXECUTAR A ROTINA
            $params = $this->prepareDoMany($params);

            // Retorna sempre um array de parametros, independente de fornecer 1 ou N
            $this->simpleArraytoMulti($params);

            // Inicia o retorno a partir do Trait HasPrepareRetorno
            $this->prepareRetorno($params);

            // Itera sobre os parametros e executa a Autorizacao Individualmente
            foreach ($params as $param) {
                $doOne = $this->doOne($param);
                if ($doOne === true) {
                    //SUCESS
                    $this->whenDoSuccess($doOne);
                } else {
                    //FAIL
                    $this->whenDoFail($param);
                }
            }

            //RETURN
            return $this->getRetornoProcessamento();
        } catch (TExceptionAbstract $e) {
            return $e->toJson();
        }
    }
}
