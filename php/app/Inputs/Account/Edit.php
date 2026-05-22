<?php
namespace App\Inputs\Account;

use Mxs\Exceptions\Runtimes\{
    InvalidInput,
    RouteNotFound
};

readonly class Edit
{
    public const array ALLOWED_COLUMNS = [
        'nickname' => null,
        'password' => null,
    ];

    public function __construct(\Mxs\Inputs\HttpRequest $in)
    {
        $column = $in->route('column');
        array_key_exists($column, self::ALLOWED_COLUMNS) or throw new RouteNotFound($in->route_method, $in->route);
        $this->column = $column;

        $value = $in->input('value');
        $validate = self::ALLOWED_COLUMNS[$column];
        if (!is_null($validate)) {
            $validate($value) or throw new InvalidInput('value');
        }
        $this->value = $value;
    }

    public string $column;
    public mixed $value;
}
