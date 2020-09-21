<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation 
{
    protected $CI;

	public function __construct()
    {
        parent::__construct();
        $this->CI =& get_instance();
    }

    public function valid_date($data)
    {
        $this->CI->form_validation->set_message('valid_date', 'A <b> %s </b> informada é inválida');
        $padrao = explode('/', $data);
        return checkdate($padrao[1], $padrao[0], $padrao[2]);
    }

    public function valid_cpf($cpf)
    {
        $this->CI->form_validation->set_message('valid_cpf', 'O <b> %s </b> informado não é válido.');

        $cpf = preg_replace('/[^0-9]/','',$cpf);

        if(strlen($cpf) != 11 || preg_match('/^([0-9])\1+$/', $cpf))
        {
            return false;
        }

        $digit = substr($cpf, 0, 9);

        for($j=10; $j <= 11; $j++)
        {
            $sum = 0;

            for($i=0; $i< $j-1; $i++)
            {
                $sum += ($j-$i) * ((int) $digit[$i]);
            }

            $summod11 = $sum % 11;
            $digit[$j-1] = $summod11 < 2 ? 0 : 11 - $summod11;
        }
        
        return $digit[9] == ((int)$cpf[9]) && $digit[10] == ((int)$cpf[10]);
    }

    public function valid_cep($cep)
    {
        $this->CI->form_validation->set_message('valid_cep', 'O campo <b> %s </b> não contém um CEP válido.');

        $cep = str_replace('.', '', $cep);
        $cep = str_replace('-', '', $cep);

        $url = 'http://republicavirtual.com.br/web_cep.php?cep='.urlencode($cep).'&formato=query_string';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 0);

        $resultado = curl_exec($ch);
        curl_close($ch);

        if( ! $resultado)
            $resultado = "&resultado=0&resultado_txt=erro+ao+buscar+cep";

        $resultado = urldecode($resultado);
        $resultado = utf8_encode($resultado);
        parse_str( $resultado, $retorno);

        if($retorno['resultado'] == 1 || $retorno['resultado'] == 2) {
            return true;
        } else {
            return false;
        }  
    }

    public function valid_cns($cns)
    {
        $this->CI->form_validation->set_message('valid_cns', 'O campo <b> %s </b> não contém um valor válido.');

        switch (substr($cns,0,1)) {
            case 1:
            case 2:
                return $this->validaCns12($cns);
            break;
            case 7:
            case 8:
            case 9:
                return $this->validaCns789($cns);
            break;
            case 3:
            case 4:
            case 5:
            case 6:
                return false;
            break;
            default:
                return false;
            break;
        }
    }

    private function validaCns12($cns)
    {
        if (strlen($cns) != 15) return false;
        
        $soma      = 0;
        $resto     = 0;
        $dv        = 0;
        
        $resultado = "";

        $pis = substr($cns,0,11);
        
        $soma = ((int)substr($pis, 0,1)  * 15) +
                ((int)substr($pis, 1,1)  * 14) +
                ((int)substr($pis, 2,1)  * 13) +
                ((int)substr($pis, 3,1)  * 12) +
                ((int)substr($pis, 4,1)  * 11) +
                ((int)substr($pis, 5,1)  * 10) +
                ((int)substr($pis, 6,1)  * 9)  +
                ((int)substr($pis, 7,1)  * 8)  +
                ((int)substr($pis, 8,1)  * 7)  +
                ((int)substr($pis, 9,1) * 6)   +
                ((int)substr($pis,10,1) * 5);
                
        $resto = $soma % 11;
        $dv = 11 - $resto;
        
        if ($dv == 11) $dv = 0;
        
        if ($dv == 10) {
            $soma = ((int)substr($pis, 0,1)  * 15) +
                    ((int)substr($pis, 1,1)  * 14) +
                    ((int)substr($pis, 2,1)  * 13) +
                    ((int)substr($pis, 3,1)  * 12) +
                    ((int)substr($pis, 4,1)  * 11) +
                    ((int)substr($pis, 5,1)  * 10) +
                    ((int)substr($pis, 6,1)  * 9)  +
                    ((int)substr($pis, 7,1)  * 8)  +
                    ((int)substr($pis, 8,1)  * 7)  +
                    ((int)substr($pis, 9,1)  * 6)  +
                    ((int)substr($pis,10,1)  * 5) + 2;
        
            $resto = $soma % 11;
            $dv = 11 - $resto;
            
            $resultado = $pis . "001" . $dv;
    
        } else {
        
            $resultado = $pis . "000" . $dv;
        }
        
        if ($cns != $resultado) {
            return false;
        }
    
        return true;
    }

    private function validaCns789($cns)
    {
        if (strlen($cns) != 15) return false;
            
        $resto = 0;
        $soma = 0;
            
        $soma = ((int)substr($cns,0,1)   * 15) +
                ((int)substr($cns,1,1)   * 14) +
                ((int)substr($cns,2,1)   * 13) +
                ((int)substr($cns,3,1)   * 12) +
                ((int)substr($cns,4,1)   * 11) +
                ((int)substr($cns,5,1)   * 10) +
                ((int)substr($cns,6,1)   * 9)  +
                ((int)substr($cns,7,1)   * 8)  +
                ((int)substr($cns,8,1)   * 7)  +
                ((int)substr($cns,9,1)   * 6)  +
                ((int)substr($cns,10,1)  * 5)  +
                ((int)substr($cns,11,1)  * 4)  +
                ((int)substr($cns,12,1)  * 3)  +
                ((int)substr($cns,13,1)  * 2)  +
                ((int)substr($cns,14,1)  * 1);
            
        $resto = $soma % 11;
            
        if ($resto != 0) {
            return false;
        } else {
            return true;
        }
    }
}