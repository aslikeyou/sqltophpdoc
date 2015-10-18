<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$app->get('/', function () use ($app) {
    $sqlcode = '';
    return view('wellcome', [
        'sqlcode' => $sqlcode,
    ]);
});

function getValidTypeFromSql($type) {
    $type = strtolower($type);

    $a = [
        'varchar' => 'string',
        'timestamp' => 'string',
        'int' => 'integer'
    ];

    if(isset($a[$type])) {
        return $a[$type];
    }

    return $type;
}

$app->post('/', function (\Illuminate\Http\Request $request) use ($app) {
    $sqlcode = $request->input('sqlcode');
    $parsed = '';
    if($sqlcode !== null) {
        $parser  = new \PHPSQLParser\PHPSQLParser($sqlcode);
        if(isset($parser->parsed['TABLE']['create-def']['base_expr'])) {
            $p = $parser->parsed['TABLE']['create-def']['base_expr'];

            preg_match_all('/`(\w+)`\s+(\w+)/',$p, $matches);

            $p = array_combine($matches[1],$matches[2]);
            $c = [];
            foreach($p as $k => $v) {
                $c[] = new \Saxulum\PhpDocGenerator\PropertyRow(getValidTypeFromSql($v), $k);

            }
            $document = new \Saxulum\PhpDocGenerator\Documentor($c);
            $parsed = ((string)$document);
        }
    }
    return view('wellcome', [
        'sqlcode' => $sqlcode,
        'parsed' => $parsed
    ]);
});