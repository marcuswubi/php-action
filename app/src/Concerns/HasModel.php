<?php
namespace PHPAction\Concerns;

/**
 * Trait HasModel
 *
 * @package ActiveRest\Concerns
 */
trait HasModel
{
    /**
     * @var Model que implementa as funções
     */
    protected $Model;

    /**
     * @param $Model
     */
    public function setModel($Model)
    {
        $this->Model = $Model;
    }

    /**
     * @return $Model
     */
    public function getModel()
    {
        return $this->Model;
    }

    /**
     * Método abstrato com o retorno padrao de BEFORE
     * @param array $param
     * @return array
     */
    public function before(
        array $param
    ): array {
        return [
            'success' => true,
            'param' => $param
        ];
    }

    /**
     * Método abstrato com o retorno padrao de AFTER
     * @param array $param
     * @return array
     */
    public function after(
        $param
    ): array {
        return [
            'success' => true,
            'param' => $param
        ];
    }

}