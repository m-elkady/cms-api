<?php

namespace App\Core\Base;

use Dingo\Api\Http\Response\Factory;
use Dingo\Api\Http\FormRequest;
use Validator;


/**
 * Class BaseRequest
 *
 * @package App\Core\Base
 * @method attributes()
 *
 * @author  Mohammed Elkady <m.elkady365@gmail.com>
 */
class Request extends FormRequest
{
    public $thisAttributes = [];

    public $messages = [];

    /**
     * @param array $data
     *
     * @return $this
     * @author Mohammed Elkady <m.elkady365@gmail.com>
     */
    public function load(array $data)
    {
        $attributes = (array)$this->attributes();
        foreach ($attributes as $attribute) {
            if (isset($data[$attribute])) {
                $this->thisAttributes[$attribute] = $data[$attribute];
            } else {
                $this->thisAttributes[$attribute] = null;
            }
        }

        return $this;
    }
//

    /**
     * @return \Illuminate\Foundation\Application|mixed
     * @author Mohammed Elkady <m.elkady365@gmail.com>
     */
    public function response()
    {
        return app(Factory::class);
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return (array)$this->thisAttributes;
    }

    /**
     * @param array $attributes attributes
     *
     * @return $this
     */
    public function setAttributes(array $attributes)
    {
        foreach ($attributes as $attribute => $value) {
            $this->setAttribute($attribute, $value);
        }

        return $this;
    }

    /**
     * @param string $attribute attribute
     * @param string $value     attribute value
     *
     * @return $this
     */
    public function setAttribute(string $attribute, $value)
    {
        if (in_array($attribute, $this->attributes())) {
            $this->thisAttributes[$attribute] = $value;
        }

        return $this;
    }

    /**
     * @param string $attribute attribute name
     *
     * @return mixed|null
     */
    public function getAttribute(string $attribute)
    {
        $value = $this->thisAttributes[$attribute] ?? null;

        return $value;
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return $this->messages;
    }

    /**
     * @param string $property property name
     *
     * @return mixed
     */
    public function __get($property)
    {
        $method = 'get' . ucfirst($property);
        if (method_exists($this, $method)) {
            $reflection = new \ReflectionMethod($this, $method);
            if (!$reflection->isPublic()) {
                throw new \RuntimeException("The called method is not public");
            }
        }

        if (in_array($property, $this->attributes())) {
            return $this->thisAttributes[$property];
        }
    }

    /**
     * @param string $property property name
     * @param mixed  $value    value
     *
     * @return $this
     */
    public function __set($property, $value)
    {
        $method = 'set' . ucfirst($property);
        if (method_exists($this, $method)) {
            $reflection = new \ReflectionMethod($this, $method);
            if (!$reflection->isPublic()) {
                throw new \RuntimeException("The called method is not public");
            }
        }

        if (in_array($property, $this->attributes())) {
            $this->thisAttributes[$property] = $value;
        }

        return $this;
    }


}