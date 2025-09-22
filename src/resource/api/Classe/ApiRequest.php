<?php 

namespace Src\resource\api\Classe;

class ApiRequest{
    private $method_avaliable = ['POST'];
    private $data;

    public function __construct(){
        $this->data = [];
    }

    public function SetMethod($m){
        $this->data['method'] = $m;
    }
    public function GetMethod(){
        return $this->data['method'];
    }

    public function SetEndPoint($p){
        $this->data['endpoint'] = $p;
    }
    public function GetEndPoint(){
        return $this->data['endpoint'];
    }

    public function CheckMethod(){
        return in_array($this->GetMethod(), $this->method_avaliable);
    }

    public function SendResponse(){
        header('Content-Type: application/json');
        echo json_encode($this->data);
        exit;
    }

    public function SendData($result, $status, $msg = ''){
        $this->data =[
            'result' => $result,
            'status' => $status,
            'message' => $msg
        ];

        $this->SendResponse();
    }
}