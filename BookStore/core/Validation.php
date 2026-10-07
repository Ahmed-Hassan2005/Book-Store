<?php

require_once __DIR__ . '/../app/helpers/Helpers.php';
require_once __DIR__ . '/../core/Database.php';

class Validation{
    private array $data;
    /** 
     * [
     *    email' => "ahmed@gmail.com",
     *    'password' => "123456",
     * 
     * ]
     */

    private array $rules;
    /** 
     * [
     *   'email' => ['required', 'email', ['exists', 'users', 'id']],
     *   'password' => ['required', ['min', 6]],
     * ] 
     */

    private array $errors = [];
    /** 
     * [
     *       'email' => [
     *          'required' => 'email is required',
     *           'email' => 'email is not valid'
     *       ],
     *      'password' => [
     *           'required' => 'password is required',
     *           'min' => 'password must be at least 6 characters'
     *      ]
     *  ];  
     */

    public function __construct(array $data, array $rules){
        $this->data = $data;
        $this->rules = $rules;
    } //__construct()

    public function validate(): array{
        // pr($this->data, true);
        foreach($this->rules as $key => $rules){
            $value = $this->data[$key] ?? null;

            foreach($rules as $rule){

                if(is_string($rule)){
                    if($rule === 'required'){
                        $this->required($key, $value);
                    }
                    if($rule === 'email'){
                        $this->email($key, $value);
                    }
                    if($rule === "egPhone"){
                        $this->egPhone($key, $value);
                    }

                }
                else if(is_array($rule)){

                    if($rule[0] === "min"){
                        $this->min($key, $value, $rule[1]);
                    }
                    else if($rule[0] === "max"){
                        $this->max($key, $value, $rule[1]);
                    }
                    else if($rule[0] === "unique"){
                        $this->unique($key, $value, $rule[1]);
                    }
                    else if($rule[0] === "exists"){
                        $this->exists($key, $value, $rule[1], $rule[2]);
                    } 

                }//else if rule is array

            }//for each rules 

        }//for each keys

        return $this->errors;

    }//validate()

    private function addError(string $field, string $msg){
        $this->errors[$field][] = $msg;
    }//addError()

    private function required(string $key, mixed $value): void {
        if($value === null || trim($value) === ""){
            $this->addError($key, "$key is required");
        }
    }//required()
    
    private function email(string $key, mixed $value): void {
        if(empty($value)){
            return;
        }

        $end = "$";
        $domains = implode("|", ["gmail", "yahoo", "outlook", "hotmail"]);
        $tlds = implode("|", ["com", "net", "org", "gov"]);
        $regex = "/^[a-zA-Z]{1}[a-zA-Z0-9._%+-]{2,35}@($domains)\.($tlds)$end/i";
        if(!preg_match($regex, $value)){
            $this->addError($key, "$key is not valid");
        }


    }//email()

    private function min(string $key, mixed $value, int $min): void {
        if(empty($value)){
            return;
        }
        if(strlen($value) < $min){
            $this->addError($key, "$key must be at least $min characters long");
        }
    }//min()

    private function max(string $key, mixed $value, int $max): void {
        if(empty($value)){
            return;
        }

        if(strlen($value) > $max){
            $this->addError($key, "$key must be at most $max characters long");
        }
    }//max()

    private function unique(string $key, mixed $value, string $table): void {
        $DB = DataBase::connect();
        $sql = "SELECT COUNT(*) as n FROM $table WHERE $key = :_value";
        $stmt = $DB->prepare($sql);
        $stmt->execute([
            '_value' => $value
        ]);
        $count = $stmt->fetch();
        // pr($count, true);
        if($count['n'] > 0){
            $this->addError($key, "$key already exists");
        }

    }//unique()

    private function exists(string $key, mixed $value, string $table, string $colName): void {
        $DB = DataBase::connect();
        $sql = "SELECT COUNT(*) as n FROM $table WHERE $colName = :_value";
        $stmt = $DB->prepare($sql);
        $stmt->execute([
            '_value' => $value
        ]);
        $count = $stmt->fetch();
        if($count['n'] === 0){
            $this->addError($key, "$key does not exists");
        }

    }//unique()

    private function egPhone(string $key, mixed $value): void {
        // pr($value, true);
        if(empty($value)){
            return;
        }
        $regex = '/^(?:0|\+20)(?:1[0125]\d{8}|2\d{8}|3\d{8}|(?:40|45|46|47|48|50|55|57|62|64|66|68|82|84|86|88|92|93|95|96|97|98)\d{7})$/';
        if(!preg_match($regex, $value)){
            $this->addError($key, "$key must be valid Egyptian phone number");
        }
    }//egPhone()

}//class Validation
    

    
