<?php
namespace  App\Exceptions;
use Exception;
use Throwable;

class MonException extends Exception{
    protected $message = 'Unkown exception';
    private $string;
    protected $code = 0;
    /*
     * protected $file;
     * protected $line;
    */
    private $trade;

    public function __construct($message, $code = 0, Exception $previous = null){
        if(!$message){
            throw new $this('Unkown '.get_class($this));
        }
        parent::__construct($message,$code);
    }

    public function __toString()
    {
        return get_class($this) . " '{$this->message}' in {$this->file} ({$this->line})\n"
            . "{$this->getTraceAsString()}";
    }

}
