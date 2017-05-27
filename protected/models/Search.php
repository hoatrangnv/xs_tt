<?php
    class Search extends CActiveRecord
    {
        public function createSearch(){
            $search_type=1;
            $start=time(); 
            Yii::import('application.extensions.*');
            require_once('solr/Service.php');
            $host = Yii::app()->params['hostSolr'];
            $port = '8983';
            $path ='/solr/xoso';

            $solr = new Apache_Solr_Service($host,$port,$path);
            if(!$solr->ping(2))
            {
                echo 'Error Connected :'.$host.' - '.$port.' - '.$path;
                die();
            }

            $connect =Yii::app()->db;
            $sql="SELECT id,category_id,content_id,title,alias,picture,introtext,hit,create_date,position FROM news WHERE status=1";
            $command=$connect->createCommand($sql);
            $docs= $command->queryAll();
            $document = array();
            //$solr->deleteByQuery('*:*');
            $solr->deleteByQuery('search_type:'.$search_type);
            $last_id=0;
            if($docs)
                foreach($docs as $item =>$fields){   

                    $fields['title_en']=Common::change($fields['title']);
                    $fields['search_type'] = $search_type; //tin tuc ketquaveso
                    $fields['post_id'] = $fields['id']; 
                    $fields['id'] = $search_type.'_'.$fields['id']; 
                    $part = new Apache_Solr_Document();
                    foreach($fields as $key =>$value)
                    {
                        if(is_array($value))
                        {
                            foreach($value as $data)
                            {
                                $part->setMultiValue($key,$data);
                            }
                        }else{
                            $part->$key = $value;
                        }
                    }
                    $document[]=$part;
                    $last_id=$fields['id'];
            }
            try{
                /*  $part->addField('id',uniqid());
                $part->addField('title',$post['title']);
                $part->addField('content',$post['content']);
                $part->addField('url',$post['url']);
                */
                //$solr->setCreateDocuments($document);
                $solr->addDocuments($document);
                #$solr->_documentToXmlFragment($document);
                $solr->commit();
                $solr->optimize();
                echo time()-$start;
            }catch(Exception $e){
                echo 'Error :'.$e->getMessage();
            }
            echo '<br> Apache_Solr_Document is Created: '.count($document);
            echo '<br> Last_id: '.$last_id;
            die();
        } 

        public function createSearchXoso999(){
            $search_type=2;
            $start=time(); 
            Yii::import('application.extensions.*');
            require_once('solr/Service.php');
            $host = Yii::app()->params['hostSolr'];
            $port = '8983';
            $path ='/solr/xoso';

            $solr = new Apache_Solr_Service($host,$port,$path);
            if(!$solr->ping(2))
            {
                echo 'Error Connected :'.$host.' - '.$port.' - '.$path;
                die();
            }

            $connect =Yii::app()->db;
            $sql="SELECT id,category_id,content_id,title,alias,picture,introtext,hit,create_date,position FROM news_xoso999 WHERE status=1";
            $command=$connect->createCommand($sql);
            $docs= $command->queryAll();
            $document = array();
            $solr->deleteByQuery('search_type:'.$search_type);
            $last_id=0;
            if($docs)
                foreach($docs as $item =>$fields){   

                    $fields['title_en']=Common::change($fields['title']);
                    $fields['search_type'] = $search_type; //tin tuc xoso999
                    $fields['post_id'] = $fields['id']; 
                    $fields['id'] = $search_type.'_'.$fields['id'];
                    $part = new Apache_Solr_Document();
                    foreach($fields as $key =>$value)
                    {
                        if(is_array($value))
                        {
                            foreach($value as $data)
                            {
                                $part->setMultiValue($key,$data);
                            }
                        }else{
                            $part->$key = $value;
                        }
                    }
                    $document[]=$part;
                    $last_id=$fields['id'];
            }
            try{
                /*  $part->addField('id',uniqid());
                $part->addField('title',$post['title']);
                $part->addField('content',$post['content']);
                $part->addField('url',$post['url']);
                */
                //$solr->setCreateDocuments($document);
                $solr->addDocuments($document);
                #$solr->_documentToXmlFragment($document);
                $solr->commit();
                $solr->optimize();
                echo time()-$start;
            }catch(Exception $e){
                echo 'Error :'.$e->getMessage();
            }
            echo '<br> Apache_Solr_Document is Created: '.count($document);
            echo '<br> Last_id: '.$last_id;
            die();
        }  

        public function createSearchDreambook(){
            $search_type=3;
            $start=time(); 
            Yii::import('application.extensions.*');
            require_once('solr/Service.php');
            $host = Yii::app()->params['hostSolr'];
            $port = '8983';
            $path ='/solr/xoso';

            $solr = new Apache_Solr_Service($host,$port,$path);
            if(!$solr->ping(2))
            {
                echo 'Error Connected :'.$host.' - '.$port.' - '.$path;
                die();
            }

            $connect =Yii::app()->db;
            $sql="SELECT id,title,alias,result as introtext FROM dream_book";
            $command=$connect->createCommand($sql);
            $docs= $command->queryAll();
            $document = array();
            //$solr->deleteByQuery('*:*');
            $solr->deleteByQuery('search_type:'.$search_type);
            $last_id=0;
            if($docs)
                foreach($docs as $item =>$fields){   

                    $fields['title_en']=Common::change($fields['title']);
                    $fields['search_type'] = $search_type; //tin tuc ketquaveso
                    $fields['post_id'] = $fields['id']; 
                    $fields['id'] = $search_type.'_'.$fields['id']; 
                    $part = new Apache_Solr_Document();
                    foreach($fields as $key =>$value)
                    {
                        if(is_array($value))
                        {
                            foreach($value as $data)
                            {
                                $part->setMultiValue($key,$data);
                            }
                        }else{
                            $part->$key = $value;
                        }
                    }
                    $document[]=$part;
                    $last_id=$fields['id'];
            }
            try{
                /*  $part->addField('id',uniqid());
                $part->addField('title',$post['title']);
                $part->addField('content',$post['content']);
                $part->addField('url',$post['url']);
                */
                //$solr->setCreateDocuments($document);
                $solr->addDocuments($document);
                #$solr->_documentToXmlFragment($document);
                $solr->commit();
                $solr->optimize();
                echo time()-$start;
            }catch(Exception $e){
                echo 'Error :'.$e->getMessage();
            }
            echo '<br> Apache_Solr_Document is Created: '.count($document);
            echo '<br> Last_id: '.$last_id;
            die();
        }    

        public function getDataSearch($keyword,$category_id,$content_id,$page,$num_per_page,$search_type=1)
        {
            $cacheService = new CacheService("Search","getDataSearch",$search_type.$keyword.$category_id.$content_id.$page.$num_per_page);
            $key = $cacheService->createKey();
            $cache = Yii::app()->cache->get($key);
            $cache=false;
            if ($cache == false) 
            {
                //Ket qua search        
                $output=array();
                $total=0;
                $paging='';

                Yii::import('application.extensions.*');
                require_once('solr/Service.php');

                $query='(title:"'.$keyword.'" OR title_en:"'.$keyword.'" OR title:'.$keyword.' OR title_en:'.$keyword.')';
                $query .= ' AND search_type:'.$search_type;  
                if($category_id==0){
                    $query .= ' AND (category_id:1 OR category_id:3 OR category_id:4)';
                }else{
                    $query .= ' AND category_id:"'.$category_id.'"';
                }
                if($content_id >0){
                    $query .= ' AND content_id:'.$content_id;
                }
                //echo $query;die;
                $host = Yii::app()->params['hostSolr'];
                $port = '8983';
                $path ='/solr/xoso';

                $solr = new Apache_Solr_Service($host,$port,$path);
                if(!$solr->ping(5))
                {
                    echo 'Khong connect Solr Server: '.$host.' - '.$port.' - '.$path;
                    die();
                }

                if(get_magic_quotes_gpc() == 1)
                {
                    $query = stripcslashes($query);
                }

                try
                {
                    $start=($page-1)*$num_per_page;
                    $params=array("sort" =>"position desc");
                    $results = $solr->search($query,$start,$num_per_page,$params);
                    //Phan trang
                    $total=$results->response->numFound;

                    $max_page=ceil($total/$num_per_page);

                    //End
                    $results = $results->response->docs;
                    if($results) {
                        foreach($results as $row){
                            $output[]=array('id'=>$row->post_id,'category_id'=>$row->category_id,'content_id'=>$row->content_id,'title'=>$row->title,'alias'=>$row->alias,'picture'=>$row->picture,'introtext'=>$row->introtext,'hit'=>$row->hit,'create_date'=>$row->create_date,'position'=>$row->position);
                        }
                    }

                }catch(exception $e){
                    exit();
                }
                $a=array($output,$max_page,$total);
                Yii::app()->cache->set($key, $a, ConstantsUtil::TIME_CACHE_900);
            }
            else
            {
                $a=$cache;
            }
            return $a;
        }

        public function getDataSearchDreambook($keyword,$page,$num_per_page)
        {      
            $keyword = str_replace(":","",$keyword);
            $keyword = str_replace("(","",$keyword);
            $keyword = str_replace(")","",$keyword); 
            $cacheService = new CacheService("Search","getDataSearchDreambook",$keyword.$page.$num_per_page);
            $key = $cacheService->createKey();
            $cache = Yii::app()->cache->get($key);
            $cache=false;
            if ($cache == false) 
            {
                //Ket qua search        
                $output=array();
                $total=0;
                $paging='';

                Yii::import('application.extensions.*');
                require_once('solr/Service.php');

                $query='(title:"'.$keyword.'" OR title_en:"'.$keyword.'" OR title:'.$keyword.' OR title_en:'.$keyword.')';
                $query .= ' AND search_type:3';
                $host = Yii::app()->params['hostSolr'];
                $port = '8983';
                $path ='/solr/xoso';

                $solr = new Apache_Solr_Service($host,$port,$path);
                if(!$solr->ping(5))
                {
                    echo 'Khong connect Solr Server: '.$host.' - '.$port.' - '.$path;
                    die();
                }

                if(get_magic_quotes_gpc() == 1)
                {
                    $query = stripcslashes($query);
                }

                try
                {
                    $start=($page-1)*$num_per_page;
                    $params=array("sort" =>"id desc");
                    $results = $solr->search($query,$start,$num_per_page,$params);
                    //Phan trang
                    $total=$results->response->numFound;

                    $max_page=ceil($total/$num_per_page);

                    //End
                    $results = $results->response->docs;
                    if($results) {
                        foreach($results as $row){
                            $output[]=array('id'=>$row->post_id,'title'=>$row->title,'alias'=>$row->alias,'result'=>$row->introtext);
                        }
                    }

                }catch(exception $e){
                    exit();
                }
                $a=array($output,$max_page,$total);
                Yii::app()->cache->set($key, $a, ConstantsUtil::TIME_CACHE_900);
            }
            else
            {
                $a=$cache;
            }
            return $a;
        }
    }
