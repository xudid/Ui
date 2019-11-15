<?php


namespace Ui\Views\Generator;


interface AssociationViewGenerator
{
    public function __construct(string $className);

    public function getView($datas,bool $clickable = false,string $baseURL="");
}