<?php
    class SynCache{    

        public function setPredictUser($date){
            $search["date"] = $date;
            $str_key = implode("_",$search);
            $cacheService = new CacheService("Dudoan","getDataSearch",$str_key);
            $key_cache = $cacheService->createKey();
            Yii::app()->cache->set($key_cache,false);
        }

        public function setPredictGeneral($data){
            $cacheService = new CacheService("News","getDataDudoanByContent",intval($data["content_id"]),1,20);
            $key_cache = $cacheService->createKey();
            Yii::app()->cache->set($key_cache,false);

            $str_key = implode("_",$data["contents"]);

            $cacheService = new CacheService("News","getDataDudoanByManyContents",$str_key,1,20);
            $key_cache = $cacheService->createKey();
            Yii::app()->cache->set($key_cache,false);
            $cacheService = new CacheService("News","getDataDudoanByManyContentsAndDate",$str_key);
            $key_cache = $cacheService->createKey();
            Yii::app()->cache->set($key_cache,false);

            $cacheService = new CacheService("News","getDataById",$data["id"]);    
            $key_cache = $cacheService->createKey();
            Yii::app()->cache->set($key_cache,false);
        }

        public function setNews($data){   
            if(isset($_SERVER["HTTP_HOST"]) && $_SERVER["HTTP_HOST"]=="xoso999.com"){
                $domain = $_SERVER["HTTP_HOST"];
            }else{
                $domain = "ketquaveso.com";
            } 
            if($data["category_id"]==5){
                $cacheService = new CacheService("News","getDataVideoPaging",$domain.'_1',5);
                $key_cache = $cacheService->createKey();
                Yii::app()->cache->set($key_cache,false);
            }elseif($data["category_id"]==6){
                $cacheService = new CacheService("News","getDataTuviByContent",$domain.'_'.intval($data["content_id"]),1,20);
                $key_cache = $cacheService->createKey();
                Yii::app()->cache->set($key_cache,false);
            }elseif($data["category_id"]==7){
                $cacheService = new CacheService("News","getDataXemTuongByContent",$domain.'_'.intval($data["content_id"]),1,20);
                $key_cache = $cacheService->createKey();
                Yii::app()->cache->set($key_cache,false);
            }elseif($data["category_id"]==8){
                $cacheService = new CacheService("News","getDataBongdaByContent",$domain.'_'.intval($data["content_id"]),1,20);
                $key_cache = $cacheService->createKey();
                Yii::app()->cache->set($key_cache,false);
            }else{
                $cacheService = new CacheService("News","getDataByCatAndContent",$domain.'_'."0_0",1,20);
                $key_cache = $cacheService->createKey();
                Yii::app()->cache->set($key_cache,false);
                $cacheService = new CacheService("News","getDataByCatAndContent",$domain.'_'.intval($data["category_id"])."_".intval($data["content_id"]),1,20);
                $key_cache = $cacheService->createKey();
                Yii::app()->cache->set($key_cache,false);
            }
            $cacheService = new CacheService("News","getDataById",$domain.'_'.$data["id"]);    
            $key_cache = $cacheService->createKey(); 
            Yii::app()->cache->set($key_cache,false);
        }

        public function setResultMB($data){
            $cacheService = new CacheService("KetquaMienbac","getDataByDate","");
            $key_cache = $cacheService->createKey();
            Yii::app()->cache->set($key_cache,false);

            $cacheService = new CacheService("KetquaMienbac","getDataByDate",$data["date"]."");
            $key_cache = $cacheService->createKey();
            Yii::app()->cache->set($key_cache,false);

            $date = getdate(strtotime($data["date"]));
            $day = Common::getWeekDay($date["wday"]); 
            foreach(LoadConfig::$province_mb as $value){
                if(in_array($day["id"],$value["live"])){
                    $data["live"] = $value["live"];
                }
            }
            $str_key = implode("_",$data["live"]);
            $cacheService = new CacheService("KetquaMienbac","getDataByDate",$data["date"].$str_key);
            $key_cache = $cacheService->createKey();
            Yii::app()->cache->set($key_cache,false);


            $cacheService = new CacheService("KetquaMienbac","getDataByWeekday",$day["id"],1,4);
            $key_cache = $cacheService->createKey();
            Yii::app()->cache->set($key_cache,false);

            $cacheService = new CacheService("KetquaMienbac","getDataList",1,4);
            $key_cache = $cacheService->createKey();
            Yii::app()->cache->set($key_cache,false);
        }

        public function setResultMT($data){

        }
        
        public function setProvince($data){
            $cacheService = new CacheService("Provinces","getDataById",$data["id"]);
            $key_cache = $cacheService->createKey();
            Yii::app()->cache->set($key_cache,false);
            
            $cacheService = new CacheService("Provinces","getDataInDay",date('Y-m-d',time()));
            $key_cache = $cacheService->createKey();
            Yii::app()->cache->set($key_cache,false);
            
            $cacheService = new CacheService("Provinces","getDataInDay",date('d-m-Y',time()));
            $key_cache = $cacheService->createKey();
            Yii::app()->cache->set($key_cache,false);
            
            $cacheService = new CacheService("Provinces","getAllData");
            $key_cache = $cacheService->createKey();
            Yii::app()->cache->set($key_cache,false);
        }
    }
