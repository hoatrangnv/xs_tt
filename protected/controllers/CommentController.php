<?php
    class CommentController extends Controller{
        public function actionAjaxSaveComment(){
            $fullname = isset($_POST["fullname"]) ? StringUtils::removeHTML($_POST["fullname"]):"";
            $email = isset($_POST["email"]) ? StringUtils::removeHTML($_POST["email"]):"";
            $comment = isset($_POST["comment"]) ? StringUtils::removeHTML($_POST["comment"]):"";
            $reply_id = isset($_POST["reply_id"]) ? intval($_POST["reply_id"]):0;
            $content_id = isset($_POST["content_id"]) ? intval($_POST["content_id"]):0;
            $table = isset($_POST["table"]) ? trim($_POST["table"]) : "";
            $error = "";
            $error .= intval($content_id) <=0 ? '<p>Nội dung bài viết đã bị xóa! Vui lòng F5</p>' : "";

            if(!isset($_SESSION["user"])){
                $error .= $fullname=="" ? '<p>Bạn chưa nhập họ tên</p>' : "";
                $error .= Common::validateEmail($email) =="" ? '<p>Không đúng định dạng email</p>' : "";
            }
            $error .= (strlen($comment) <3 || strlen($comment) > 300) ? '<p>Comment phải từ 3 đến 300 ký tự và không có thẻ html</p>' : "";
            if(!empty($error)){ echo $error;exit;}
            $user_id = isset($_SESSION["user"]) ? $_SESSION["user"]["id"] : 0;
            $create_user = isset($_SESSION["user"]) ? $_SESSION["user"]["username"] : $fullname ;
            $data = array(
                "content_id"=>array("value"=>$content_id,"type"=>1),
                "reply_id"=>array("value"=>$reply_id,"type"=>1),
                "user_id"=>array("value"=>$user_id,"type"=>1),
                "fullname"=>array("value"=>$fullname,"type"=>2),
                "email"=>array("value"=>$email,"type"=>2),
                "comment"=>array("value"=>$comment,"type"=>2),
                "status"=>array("value"=>0,"type"=>1),
                "create_user"=>array("value"=>$create_user,"type"=>1),
                "create_date"=>array("value"=>time(),"type"=>1),
            );
            if($table==""){
                echo "<p>CHưa biết comment vào phần nào</p>"; exit;
            }
            $comment_id = CommonDB::insertRow($table,$data);
            if($comment_id >0){
                echo 1;
            }else{
                echo "<p>Hệ thống đang quá tải. Vui lòng F5 để thử lại</p>";
            }
        }

        public function actionAjaxLoadComment(){
            $per_page = isset($_POST["per_page"]) ? intval($_POST["per_page"]):5;
            $content_id = isset($_POST["content_id"]) ? intval($_POST["content_id"]):1;
            $table = isset($_POST["table"]) ? trim($_POST["table"]):"news_comment";

            list($comment,$reply) = Comment::getDataByContentId($table,$content_id,$per_page);
            $this->renderPartial("application.views.comment.load_comment",
                array(
                    "table"=>$table
                    ,"comment"=>$comment
                    ,"reply"=>$reply
                    ,"content_id"=>$content_id
                    ,"per_page"=>$per_page
                )
            );
        }
    }
