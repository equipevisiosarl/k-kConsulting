<?php

namespace phpFx\SqlFx;

trait Validate

{
    use SqlBuilder;
    public $errors         = [];

    public function getError($key)
    {
        if (!empty($this->errors[$key]))
            return $this->errors[$key];

        return "";
    }

    protected function getPrimaryKey()
    {

        return $this->primaryKey ?? 'id';
    }

    public function validate($data, $validationRules, $primaryKey = null)
    {

        $this->errors = [];

        /*if (!empty($this->primaryKey) && !empty($data[$this->primaryKey])) {
			$validationRules = $this->updateValidationRules;
		} else if( isset($this->insertValidationRules)){

			$validationRules = $this->insertValidationRules;
		}else {
			$this->errors['error'] = "Invalid validation rules";
			return false;
			exit;
		}*/

        if (!empty($validationRules)) {
            foreach ($validationRules as $column => $rules) {

                if (!isset($data[$column]))
                    continue;

                foreach ($rules as $rule) {

                    switch (explode(':', $rule)[0]) {
                        case 'required':

                            if (empty($data[$column]))
                                $this->errors[$column] = ucfirst($column) . " is required";
                            break;
                        case 'email':

                            if (!filter_var(trim($data[$column]), FILTER_VALIDATE_EMAIL))
                                $this->errors[$column] = "Invalid email address";
                            break;
                        case 'alpha':

                            if (!preg_match("/^[a-zA-Z]+$/", trim($data[$column])))
                                $this->errors[$column] = ucfirst($column) . " should only have aphabetical letters without spaces";
                            break;
                        case 'numeric':

                            if (!preg_match("/^[0-9]+$/", trim($data[$column])))
                                $this->errors[$column] = ucfirst($column) . " should only have numbers";
                            break;
                        case 'alpha_space':

                            if (!preg_match("/^[a-zA-Z ]+$/", trim($data[$column])))
                                $this->errors[$column] = ucfirst($column) . " should only have aphabetical letters & spaces";
                            break;
                        case 'alpha_numeric':

                            if (!preg_match("/^[a-zA-Z0-9]+$/", trim($data[$column])))
                                $this->errors[$column] = ucfirst($column) . " should only have aphabetical letters & spaces";
                            break;
                        case 'alpha_numeric_symbol':

                            if (!preg_match("/^[a-zA-Z0-9\-\_\$\%\*\[\]\(\)\& ]+$/", trim($data[$column])))
                                $this->errors[$column] = ucfirst($column) . " should only have aphabetical letters & spaces";
                            break;
                        case 'alpha_symbol':

                            if (!preg_match("/^[a-zA-Z\-\_\$\%\*\[\]\(\)\& ]+$/", trim($data[$column])))
                                $this->errors[$column] = ucfirst($column) . " should only have aphabetical letters & spaces";
                            break;

                        case 'min':

                            if (is_numeric(explode(':', $rule)[1]) && strlen(trim($data[$column])) <= explode(':', $rule)[1])
                                $this->errors[$column] = ucfirst($column) . " should not be less than " . explode(':', $rule)[1] . " characters";
                            break;

                        case 'max':

                            if (is_numeric(explode(':', $rule)[1]) && strlen(trim($data[$column])) >= explode(':', $rule)[1])
                                $this->errors[$column] = ucfirst($column) . " should not be more than " . explode(':', $rule)[1] . " characters";
                            break;

                        case 'equal':

                            if (is_numeric(explode(':', $rule)[1]) && strlen(trim($data[$column])) != explode(':', $rule)[1])
                                $this->errors[$column] = ucfirst($column) . " should be equal to " . explode(':', $rule)[1] . " characters";
                            break;

                        case 'unique':

                            if ($primaryKey == null) {
                                $nameClass =  get_called_class();
                                $model = new $nameClass();
                                $key = $model::$primary_Key ?? $this->getPrimaryKey();

                            } else {
                                $key = $primaryKey;
                            }


                            
                            if (!empty($data[$key])) {
                                //edit mode
                                if ($this->where([$column => $data[$column]])->from(explode(':', $rule)[1])->where($key, '!=', $data[$key])->find(1)) {
                                    $this->errors[$column] = ucfirst($column) . " should be unique";
                                }
                            } else {
                                //insert mode
                                if ($this->where([$column => $data[$column]])->from(explode(':', $rule)[1])->find(1)) {
                                    $this->errors[$column] = ucfirst($column) . " should be unique";
                                }
                            }
                            break;

                        default:
                            $this->errors['rules'] = "The rule " . explode(':', $rule)[0] . " was not found!";
                            break;
                    }
                }
            }
        }

        if (empty($this->errors)) {
            return true;
        }

        return false;
    }
}
