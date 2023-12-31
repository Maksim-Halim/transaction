<?php


namespace App\Context;

use App\Context\FormatStrategy;
use App\Context\FirstStrategy;
use App\Context\SecondStrategy;


class Context {
    private $strategy;

    public function __construct(...$strategy) {
        $this->strategy = $strategy;
    }

    public function executeStrategy($strategy, array $objects): array {
        return $strategy->formatData($objects);
    }

    public function index(){
        $data = [
            (object) [
                'brandName' => 'Ford',
                'model' => 'Mustang',
                'modelDetails' => 'GT rest 2',
                'modelYear' => 2014,
                'productionYear' => 2013,
                'color' => 'Oxford White',
            ],
            (object) [
                'brandName' => 'BMW',
                'model' => '520i',
                'modelDetails' => 'rest',
                'modelYear' => 2001,
                'productionYear' => 2001,
                'color' => 'Green',
            ],
        ];

        $firstStrategy = new FirstStrategy();
        $context1 = new Context($firstStrategy);
        $result1 = $context1->executeStrategy($firstStrategy,$data);

        $secondStrategy = new SecondStrategy();
        $context2 = new Context($secondStrategy);
        $result2 = $context2->executeStrategy($secondStrategy,$data);
        echo "<pre>";
        var_dump($result1);
        var_dump($result2);
        echo "</pre>";

    }


}


