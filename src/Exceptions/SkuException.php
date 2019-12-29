<?php

namespace BinaryCats\Sku\Exceptions;

use Exception;

class SkuException extends Exception
{
    /**
     * Invalid Argument.
     *
     * @param  string $message
     * @return [type]
     */
    public static function invalidArgument(string $message): self
    {
        return new static($message);
    }

    /**
     * Make the Exception renderable.
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function render($request)
    {
        return response(['error' => $this->getMessage()], $this->getCode());
    }
}
