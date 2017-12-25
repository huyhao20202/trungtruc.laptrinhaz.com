<?php

class Helper
{
//Success
    public static function success($message)
    {
        $xhtml = '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                ' . $message . '
              </div>';
        return $xhtml;
    }

    public static function showErrors($message)
    {
        $xhtml = '<div class="alert alert-warning alert-dismissible">';
        $xhtml .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
        $xhtml .= '<h4><i class="icon fa fa-warning"></i> Oops!</h4>';
        $xhtml .= '<ul class="list-unstyled">';
        $xhtml .= '<li>' . $message . ' </li>';
        $xhtml .= '</ul></div>';
        return $xhtml;
    }

    public static function cutCharacter($string, $pattern, $num = 0)
    {
        $pos = mb_stripos($string, $pattern);
        if ($num > 0) {
            $pos += $num;
        }
        return mb_substr($string, $pos);
    }

    public static function cmsSelecbox($listItem, $name = null, $class = null, $selected = null)
    {
        $xhtml = "<select name='$name' class='$class''>";
        $xhtml .= "<option value='0'>-- Select  --</option>";
        foreach ($listItem as $key => $item) {
            if ($selected == $item['id'])
                $xhtml .= "<option value='" . $item['id'] . "' selected>" . $item['name'] . "</option>";
            else
                $xhtml .= "<option value='" . $item['id'] . "'>" . $item['name'] . "</option>";
        }
        $xhtml .= '</select>';
        return $xhtml;
    }

    public function cmsCategory($itemCategory)
    {
        $xhtml = '<section id="mc-section-3" class="mc-section-3 section">';
        $xhtml .= '<div class="container">';

        foreach ($itemCategory as $key => $valueCategory) {
            if (empty($valueCategory))
                return '';
            $categoryURL = URL::filterURL($key);
            $id_category = $valueCategory[0]['category_id'];
            $urlCategory = URL::createLink('default', 'category', 'showCourse', ['id' => $id_category], "$categoryURL-$id_category.html");

            $xhtml .= '<div class="feature-course">';
            $xhtml .= '<h4 class="title-box text-uppercase">' . $key . '</h4>';
            $xhtml .= '<a href="' . $urlCategory . '"';
            $xhtml .= 'class="all-course mc-btn btn-style-1">';
            $xhtml .= 'View all';
            $xhtml .= '</a>';
            $xhtml .= '<div class="row">';
            $xhtml .= '<div class="feature-slider">';

            foreach ($valueCategory as $value) {
                $name_category = URL::filterURL($value['category_name']);
                $id_category = $value['category_id'];
                $name_course = URL::filterURL($value['course_name']);
                $id_course = $value['course_id'];
                $urlCourse = URL::createLink('default', 'course', 'index', array('id_course' => $id_course, 'id_category' => $id_category), "$name_category/$name_course-$id_category-$id_course.html");

                $nameAuthor = URL::filterURL($value['author_name']);
                $authorID = URL::filterURL($value['author_id']);
                $urlFindAuthor = URL::createLink('default', 'index', 'findAuthor', ['author' => $nameAuthor, 'author_id' => $authorID], "tac-gia-$nameAuthor/$authorID.html");
                $xhtml .= '<div class="mc-item mc-item-1">';
                $xhtml .= '<div class="image-heading">';
                $xhtml .= '<img src="' . TEMPLATE_URL . '/default/main/images/course/' . $value['course_image'] . '" alt="">';
                $xhtml .= '</div>';
                $xhtml .= '<div class="meta-categories"><a href="#">Web design</a></div>';
                $xhtml .= '<div class="content-item">';
                $xhtml .= '<div class="image-author">';
                $xhtml .= '<img src="' . TEMPLATE_URL . '/default/main/images/author/' . $value['author_avatar'] . '" alt="">';
                $xhtml .= '</div>';
                $xhtml .= '<h4><a href="' . $urlCourse . '" class="nameCategory">' . $value['course_name'] . '</a></h4>';
                $xhtml .= '<div class="name-author"> By <a href="' . $urlFindAuthor . '">' . $value['author_name'] . '</a></div>';
                $xhtml .= '</div>';
                $xhtml .= '<div class="ft-item">';
                $xhtml .= '<div class="rating">';
                $xhtml .= '<a href="#" class="active"></a>';
                $xhtml .= '<a href="#" class="active"></a>';
                $xhtml .= '<a href="#" class="active"></a>';
                $xhtml .= '<a href="#" class="active"></a>';
                $xhtml .= '<a href="#"></a>';
                $xhtml .= '</div>';
                $xhtml .= '<div class="price">Free</div>';
                $xhtml .= '</div>';
                $xhtml .= '</div>';
            }
            $xhtml .= '</div>';
            $xhtml .= '</div>';
            $xhtml .= '</div>';
        }
        $xhtml .= '</div>';
        $xhtml .= '</section>';
        return $xhtml;
    }
}