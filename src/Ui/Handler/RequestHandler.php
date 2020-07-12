<?php

namespace Ui\Handler;

use App\Security\Password;
use Entity\Model\Model;
use GuzzleHttp\Psr7\ServerRequest;
use Psr\Http\Message\ServerRequestInterface;

class RequestHandler
{
    /**
     * @var ServerRequestInterface
     */
    private ServerRequest $request;

    /**
     * RequestHandler constructor.
     * @param ServerRequestInterface $request
     */
    public function __construct(ServerRequestInterface $request)
    {
        $this->request = $request;
    }

    /**
     * @param Model $model
     * @param string $withprefix
     * @return Model
     */
    public function handle(Model $model, string $withprefix = '')
    {
        $prefix = strlen($withprefix) > 0 ? $withprefix : $model::getShortClass();
        $this->parseRequestFields($model, strtolower($prefix));
        return $model;
    }

    public function get(string $field)
    {
        $requestDatas = $this->request->getParsedBody() ?? [];
        return $requestDatas[$field];
    }

    /**
     * @param Model $model
     * @param $prefix
     */
    private function parseRequestFields(Model $model, $prefix)
    {
        $modelFields = $model::getColumns();
        $fields = $model::getColumns();
        $requestDatas = $this->request->getParsedBody() ?? [];
        foreach ($fields as $field) {
            $baseFieldName = $field->getName();
            $fieldName = $prefix . '_' . $baseFieldName;
            if (array_key_exists($fieldName, $requestDatas)) {
                $value = $requestDatas[$fieldName];
                if ($field->getType() == 'password' && $value) {
                    $value = Password::hash($value);
                }
                $method = 'set' . ucfirst($baseFieldName);
                if(in_array($method, $model::getSetters())) {
                    $model->$method($value);
                }
            }
        }
    }
}
