<?php

namespace Its\Config;

class ComponentAbstract implements ComponentInterface
{
    /**
     * @var array
     */
    protected $parameters;
    /**
     * @var array
     */
    public $arParentParams;

    /**
     * @var array
     */
    public $arParentResult;

    public function __construct(string $iblockType, int $iblockId, array $arParentParams = [], array $arParentResult = [])
    {
        $customParameters = [
            'IBLOCK_TYPE' => $iblockType,
            'IBLOCK_ID' => $iblockId
        ];

        $this->arParentParams = $arParentParams;
        $this->arParentResult = $arParentResult;

        $this->parameters = array_merge($this->getInitialParameters(), $customParameters);
    }

    public function getParentParams(array $arParentParams): array
    {
        return $this->arParentParams;
    }

    public function getParentResult(array $arParentResult): array
    {
        return $this->arParentResult;
    }

    public function getInitialParametersArray(): array
    {
        return [];
    }

    public function getInitialParameters(): array
    {
        return $this->getInitialParametersArray();
    }

    public function addParameters(array $parameters, bool $addArrays = false): void
    {
        foreach($parameters as $parameter => $value){
            if(
                array_key_exists($parameter, $this->parameters)
                && is_array($this->parameters[$parameter])
                && $addArrays
            ) {
                $this->parameters[$parameter] = array_merge(
                    $this->parameters[$parameter],
                    is_array($value) ? $value : [$value]
                );
            } else {
                $this->parameters[$parameter] = $value;
            }
        }
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function getParameter(string $name)
    {
        return array_key_exists($name, $this->parameters) ? $this->parameters[$name] : null;
    }

    public function removeParameter(string $name): void
    {
        if($this->getParameter($name)) {
            unset($this->parameters[$name]);
        }
    }

    public function removeChild(string $componentName): void
    {
        if(!array_key_exists('child_components', $this->parameters)) return;

        if(
            is_array($this->parameters['child_components'])
            && array_key_exists($componentName, $this->parameters['child_components'])
        ) {
            unset($this->parameters['child_components'][$componentName]);
        }
    }
}