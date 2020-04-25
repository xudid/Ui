<?php

namespace Ui\Handler;

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

    /**
     * @param Model $model
     * @param $prefix
     */
    private function parseRequestFields(Model $model, $prefix)
    {
        $modelFields = $model::getColumns();
        $modelFieldsName = array_keys($modelFields);
        foreach ($this->request->getParsedBody() as $name => $value) {
            $name = str_replace($prefix . '_', '', $name);
            if (in_array($name, $modelFieldsName)) {
                $method = 'set' . ucfirst($name);
                $model->$method($value);
            }
        }
    }
}
