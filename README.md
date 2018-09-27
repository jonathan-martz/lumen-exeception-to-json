### Installations


update App/Execption/Handler
```php
public function render($request, Exception $e){
    return $this->ExceptionHandler
    ->toJson($request, $e);
}
```
