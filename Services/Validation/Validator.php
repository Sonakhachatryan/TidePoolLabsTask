<?php
namespace FileManager\Services\Validation;

class Validator
{
    use Rules;

    /**
     * Validate data according to rules
     *
     * @param array $validationConditions
     * @return bool|array
     */
    public function validate(array $validationConditions) : bool|array
    {
        $errors = [];
        foreach ($validationConditions as $key => $rules){
            foreach ($rules as $rule){
                $ruleName = $this->getName($rule);
                $ruleParams = $this->getParams($rule);

                $validationRes = $this->$ruleName($key, $ruleParams);
                if($validationRes !== true){
                    $errors[$key][$ruleName] = $validationRes;
                }
            }
        }

        return count($errors) ? $errors : true;
    }

    /**
     * Get rule name
     *
     * @param  string  $rule
     * @return string
     */
    public function getName(string $rule) : string
    {
        return  explode(':', $rule)[0];
    }

    /**
     * Get rule params
     *
     * @param  string  $rule
     * @return array
     */
    public function getParams(string $rule) : array
    {
        $params = [];

        $rulesPart = explode(':', $rule);
        if(isset($rulesPart[1]) && $rulesPart[1]){
            $params = explode(',', $rulesPart[1]);
        }

        return $params;
    }
}