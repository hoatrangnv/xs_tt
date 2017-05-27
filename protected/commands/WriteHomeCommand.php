<?php
    class WriteHomeCommand extends CConsoleCommand{ 
        public function run($args){   


            $path = '/data/website/ketquaveso/xoso.me';
            
            $html = file_get_contents("http://xoso.me/index.php"); 
            $log_file = $path.'/desktop_index.html';
            $file = fopen($log_file,"w");
            $result = fwrite($file,$html);
            if($result){
                echo date('d-m-Y H:i:s')." | Write file desktop_index.html\n";
            }else{
                echo date('d-m-Y H:i:s')." | Ko Write file desktop_index.html\n";
            }
            
            $html = file_get_contents("http://xoso.me/index.php?detect_mobile=1"); 
            $log_file = $path.'/mobile_index.html';
            $file = fopen($log_file,"w");
            $result = fwrite($file,$html);
            if($result){
                echo date('d-m-Y H:i:s')." | Write file mobile_index.html\n";
            }else{
                echo date('d-m-Y H:i:s')." | Ko Write file mobile_index.html\n";  
            }
            
            $html = file_get_contents("http://xoso.me/result/kqMienbac");      
            $log_file = $path.'/kqxsmb-mien-bac.html';
            $file = fopen($log_file,"w");
            $result = fwrite($file,$html);
            if($result){
                echo date('d-m-Y H:i:s')." | Write file mien-bac.html\n";
            }else{
                echo date('d-m-Y H:i:s')." | Ko Write file mien-bac.html\n";
            }
            $html = file_get_contents("http://xoso.me/result/kqMiennam");       
            $log_file = $path.'/kqxsmn-mien-nam.html';
            $file = fopen($log_file,"w");
            $result = fwrite($file,$html);
            if($result){
                echo date('d-m-Y H:i:s')." | Write file mien-nam.html\n";
            }else{
                echo date('d-m-Y H:i:s')." | Ko Write file mien-nam.html\n";
            }
            $html = file_get_contents("http://xoso.me/result/kqMientrung");       
            $log_file = $path.'/kqxsmt-mien-trung.html';
            $file = fopen($log_file,"w");
            $result = fwrite($file,$html);
            if($result){
                echo date('d-m-Y H:i:s')." | Write file mien-trung.html\n";
            }else{
                echo date('d-m-Y H:i:s')." | Ko Write file mien-trung.html\n";
            }
        }
    }
