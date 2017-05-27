<?php   
    $connect = @mysql_connect('localhost', 'xosothantai', 'hF6CRVFmDUWH3P8n');
    if (!$connect) die('Could not connect: ' . mysql_error());    
    @mysql_select_db('xosothantai', $connect);
    @mysql_query("SET NAMES 'utf8'");          
    
    function baseUrl(){
        return "http://xosothantai.com/";
    }
?>