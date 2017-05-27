<?php

    class Paging {

        public static function showPageNavigation($currentPage,$maxPage,$path = '') {

            $url = new Url();
            $nav = array(
                // bao nhiêu trang bên trái currentPage
                'left' => 1,
                // bao nhiêu trang bên phải currentPage
                'right' => 1,
            );
            // nếu maxPage < currentPage thì cho currentPage = maxPage
            if ($maxPage < $currentPage) {
                $currentPage = $maxPage;
            }

            // số trang hiển thị
            $max = $nav['left'] + $nav['right'];

            // phân tích cách hiển thị
            if ($max >= $maxPage) {
                $start = 1;
                $end = $maxPage;
            } elseif ($currentPage - $nav['left'] <= 0) {
                $start = 1;
                $end = $max + 1;
            } elseif (($right = $maxPage - ($currentPage + $nav['right'])) <= 0) {
                $start = $maxPage - $max;
                $end = $maxPage;
            } else {
                $start = $currentPage - $nav['left'];
                if ($start == 2) {
                    $start = 1;
                }

                $end = $start + $max;
                if ($end == $maxPage - 1) {
                    ++$end;
                }
            }

            $navig = '';
            if ($currentPage >= 2) {
                // thêm nút "Trước"
                $navig .= '<a href="' . $path . '' . ceil($currentPage - 1) . '.html"><strong>&lt;&lt;</strong></a>';
                if ($currentPage >= $nav['left']) {
                    if ($currentPage - $nav['left'] > 2 && $max < $maxPage) {
                        // thêm nút "1"
                        $navig .= '<a href="' . $path . '1' . '.html"><strong>1</strong></a>';
                        $navig .= '<span><strong>...</strong></span>';
                    }
                }
            }

            for ($i = $start; $i <= $end; $i++) {
                // trang hiện tại
                if ($i == $currentPage) {
                    $navig .= '<a class="active" href="' . $path . '' . $i . '.html"><strong>' . $i . '</strong></a>';
                }
                // trang khác
                else {
                    //     $pg_link = $path.''.$i;
                    $navig .= '<a href="' . $path . '' . $i . '.html"><strong>' . $i . '</strong></a>';
                }
            }

            if ($currentPage <= $maxPage - 1) {
                if ($currentPage + $nav['right'] < $maxPage - 1 && $max + 1 < $maxPage) {
                    // trang cuoi
                    $navig .= '<span><strong>...</strong></span>';
                    $navig .= '<a href="' . $path . '' . $maxPage . '.html"><strong>' . $maxPage . '</strong></a>';
                }
                $navig .= '<a href="' . $path . '' . ($currentPage + 1) . '.html"><strong>&gt;&gt;</strong></a>';
            }

            // hiển thị kết quả
            return $navig;
        }
        
        public static function showPageNavigationNoRewrite($currentPage,$maxPage,$path = '') {

            $url = new Url();
            $nav = array(
                // bao nhiêu trang bên trái currentPage
                'left' => 1,
                // bao nhiêu trang bên phải currentPage
                'right' => 1,
            );
            // nếu maxPage < currentPage thì cho currentPage = maxPage
            if ($maxPage < $currentPage) {
                $currentPage = $maxPage;
            }

            // số trang hiển thị
            $max = $nav['left'] + $nav['right'];

            // phân tích cách hiển thị
            if ($max >= $maxPage) {
                $start = 1;
                $end = $maxPage;
            } elseif ($currentPage - $nav['left'] <= 0) {
                $start = 1;
                $end = $max + 1;
            } elseif (($right = $maxPage - ($currentPage + $nav['right'])) <= 0) {
                $start = $maxPage - $max;
                $end = $maxPage;
            } else {
                $start = $currentPage - $nav['left'];
                if ($start == 2) {
                    $start = 1;
                }

                $end = $start + $max;
                if ($end == $maxPage - 1) {
                    ++$end;
                }
            }

            $navig = '';
            if ($currentPage >= 2) {
                // thêm nút "Trước"
                $navig .= '<a href="' . $path . 'page=' . ceil($currentPage - 1) . '"><strong>&lt;&lt;</strong></a>';
                if ($currentPage >= $nav['left']) {
                    if ($currentPage - $nav['left'] > 2 && $max < $maxPage) {
                        // thêm nút "1"
                        $navig .= '<a href="' . $path . 'page=1' . '"><strong>1</strong></a>';
                        $navig .= '<span><strong>...</strong></span>';
                    }
                }
            }

            for ($i = $start; $i <= $end; $i++) {
                // trang hiện tại
                if ($i == $currentPage) {
                    $navig .= '<a class="active" href="' . $path . 'page=' . $i . '"><strong>' . $i . '</strong></a>';
                }
                // trang khác
                else {
                    //     $pg_link = $path.''.$i;
                    $navig .= '<a href="' . $path . 'page=' . $i . '"><strong>' . $i . '</strong></a>';
                }
            }

            if ($currentPage <= $maxPage - 1) {
                if ($currentPage + $nav['right'] < $maxPage - 1 && $max + 1 < $maxPage) {
                    // trang cuoi
                    $navig .= '<span><strong>...</strong></span>';
                    $navig .= '<a href="' . $path . 'page=' . $maxPage . '"><strong>' . $maxPage . '</strong></a>';
                }
                $navig .= '<a href="' . $path . 'page=' . ($currentPage + 1) . '"><strong>&gt;&gt;</strong></a>';
            }

            // hiển thị kết quả
            return $navig;
        }

        public static function show_paging_cp($maxPage,$currentPage, $path = '',$object = '',$first = '',$last = '') {
            $url = new Url();        
            if($maxPage <=1){
                $html = "";return $html;
            }
            $nav = array(
                // bao nhiêu trang bên trái currentPage
                'left' => 2,
                // bao nhiêu trang bên phải currentPage
                'right' => 2,
            );

            // nếu maxPage < currentPage thì cho currentPage = maxPage
            if ($maxPage < $currentPage) {
                $currentPage = $maxPage;
            }

            // số trang hiển thị
            $max = $nav['left'] + $nav['right'];

            // phân tích cách hiển thị
            if ($max >= $maxPage) {
                $start = 1;
                $end = $maxPage;
            } elseif ($currentPage - $nav['left'] <= 0) {
                $start = 1;
                $end = $max + 1;
            } elseif (($right = $maxPage - ($currentPage + $nav['right'])) <= 0) {
                $start = $maxPage - $max;
                $end = $maxPage;
            } else {
                $start = $currentPage - $nav['left'];
                if ($start == 2) {
                    $start = 1;
                }

                $end = $start + $max;
                if ($end == $maxPage - 1) {
                    ++$end;
                }
            }
            $navig = '';
            if ($currentPage >= 2) {
                // thêm nút "Trước"
                $navig .= '<li class="fl"><a href="' . $path . 'page'.$object.'=' . ceil($currentPage - 1) . '"><strong>Trước</strong></a></li>';
                if ($currentPage >= $nav['left']) {
                    if ($currentPage - $nav['left'] > 2 && $max < $maxPage) {
                        // thêm nút "1"
                        $navig .= '<li class="fl"><a href="' . $path . 'page'.$object.'=1' . '"><strong>'. $first .'1'. $last .'</strong></a></li>';
                        $navig .= '<li class="fl">...</li>';
                    }
                }
            }

            for ($i = $start; $i <= $end; $i++) {
                // trang hiện tại
                if ($i == $currentPage) {
                    $navig .= '<li class="fl active"><a href="' . $path . 'page'.$object.'=' . $i . '"><strong>'. $first . $i . $last .'</strong></a></li>';
                }
                // trang khác
                else {
                    //     $pg_link = $path.'page='.$i;
                    $navig .= '<li class="fl"><a href="' . $path . 'page'.$object.'=' . $i . '"><strong>'. $first . $i . $last .'</strong></a></li>';
                }
            }

            if ($currentPage <= $maxPage - 1) {
                if ($currentPage + $nav['right'] < $maxPage - 1 && $max + 1 < $maxPage) {
                    // trang cuoi
                    $navig .= '<li class="fl">...</li>';
                    $navig .= '<li class="fl"><a href="' . $path . 'page'.$object.'=' . $maxPage . '"><strong>'. $first . $maxPage . $last .'</strong></a></li>';
                }
                $navig .= '<li class="fl"><a href="' . $path . 'page'.$object.'=' . ($currentPage + 1) . '"><strong>Sau</strong></a></li>';
            }

            // hiển thị kết quả
            return $navig;
        }

}