<?php

class PaginationPageBuilder
{

    private $numberElementOnPage;

    private $size;

    private $page;

    private $url;


    public function __construct($numberElementOnPage, $size, $page, $url)
    {

        $this->numberElementOnPage = $numberElementOnPage;

        $this->size = $size;

        $this->page = $page;

        $this->url = $url;
    }

    public function getLinks()
    {

        if($this->numberElementOnPage >= $this->size){
            return false;
        }

        $total = intval(($this->size - 1) / $this->numberElementOnPage) + 1;

        $this->page = intval($this->page);

        if(empty($this->page) or $this->page < 0) $this->page = 1;

        if($this->page > $total) $this->page = $total;

        $prevPage='';

        $page2Left ='';

        $page1Left = '';

        $page2Right='';

        $page1Right='';

        $nextPage='';

        if ($this->page != 1) $prevPage = '<a href='.$this->url.'1><<</a> <a href= ' . $this->url . ($this->page - 1) .'><</a> ';

        if ($this->page != $total) $nextPage = ' <a href='.$this->url.($this->page + 1) .'>></a> <a href= ' . $this->url . $total. '>>></a>';


        if($this->page - 2 > 0) $page2Left = ' <a href= '.$this->url. ($this->page - 2) .'>'. ($this->page- 2) .'</a> | ';
        if($this->page - 1 > 0) $page1Left = '<a href= '.$this->url.($this->page - 1) .'>'. ($this->page - 1) .'</a> | ';
        if($this->page + 2 <= $total) $page2Right = ' | <a href= '.$this->url. ($this->page + 2) .'>'. ($this->page + 2) .'</a>';
        if($this->page + 1 <= $total) $page1Right = ' | <a href= '.$this->url. ($this->page + 1) .'>'. ($this->page + 1) .'</a>';

       return $prevPage.$page2Left.$page1Left.'<b>'.$this->page.'</b>'.$page1Right.$page2Right.$nextPage;
    }

}