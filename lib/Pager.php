<?php 
class Pager
 {

 /* Prtected Properties */	 
 protected $_total_pages;
 protected $_adjacents=1;
 protected $_targetpage;
 protected $_limit=50;
 protected $_start=0;
 protected $_page=1;
 protected $_pagination;
 protected $__extraprama;
 
 /* Setting And Getting Protected Preperties */
 public function setTotalPage($total_page)
  {
   $this->_total_pages=$total_page;
   return $this;	  
  }
 
 public function getTotalPage()
  {
   return $this->_total_pages;	  
  }
  
 public function setAdjacents($adjacents)
  {
   $this->_adjacents=$adjacents;
   return $this;	 	  
  }
  
 public function getAdjacents()
  {
   return $this->_adjacents;
  }
  
 public function setTargetpage($targetpage)
  {
   $this->_targetpage=$targetpage;
   return $this;	 	  
  }
  
 public function getTargetpage()
  {
  return $this->_targetpage;
  }
  
 public function setLimit($limit)
  {
   $this->_limit=$limit;
   return $this;	 	  
  }
  
 public function getLimit()
  {
   return $this->_limit;
  }
  
 public function setStart($start)
  {
   $this->_start=$start;
   return $this;	 	  
  }
  
 public function getStart()
  {
   if(empty($this->_start))
    {
	$this->_start=$this->_limit*($this->getPage()-1);	
    }
   return $this->_start;
  }
  
 public function setPage($page)
  {
   $page=($page == 0)? 1 : $page;
   $this->_page=$page;
   return $this;	 	  
  }
  
 public function getPage()
  {
   return $this->_page;
  }
  
 public function getNextPage()
  {
   return $this->_page + 1;
  }
  
 public function getPrevPage()
  {
   return $this->_page - 1;
  }

 public function getLastPage()
  {
   return  ceil($this->getTotalPage()/$this->getLimit());		
  }
  
 /* Setting And Getting Extraparameter */ public function setExtraPrama($extraprama)
{
    $this->__extraprama = $extraprama;
    return $this;    
}

public function getExtraPrama()
{
    return $this->__extraprama;
}

  
 public function getPagination()
  {
   if(empty($this->_pagination))
     {
	 $this->_pagination=$this->_pagination();	
	 }
	
	echo $this->_pagination; 
  }
 
 /* Private Function Creating Pagination */ 
 private function _pagination()
  {
	$lpm1 = $this->getLastPage() - 1;	
	$exp  = $this->getExtraPrama();
	$targetpage=$this->getTargetpage();
						
	$pagination = "";
	if($this->getLastPage() > 1)
	{	
		$pagination .= "<div class=\"pagination\">";
		if ($this->getPage() > 1) 
		$pagination .= "<a href=\"$targetpage?page=".$this->getPrevPage()."$exp\" class='page-link' data-page=\"".$this->getPrevPage()."\"><< </a>";


		else
			$pagination.= "<span class=\"disabled\"><< </span>";	
		
		if ($this->getLastPage() < 7 + ($this->getAdjacents() * 2))	
		{	
			for ($counter = 1; $counter <= $this->getLastPage(); $counter++)
			{
				if ($counter == $this->getPage())
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$targetpage?page=$counter$exp\" class='page-link' data-page=\"$counter\">$counter</a>";					
			}
		}
		elseif($this->getLastPage() > 5 + ($this->getAdjacents() * 2))	
		{
			if($this->getPage() < 1 + ($this->getAdjacents() * 2))		
			{
				for ($counter = 1; $counter < 4 + ($this->getAdjacents() * 2); $counter++)
				{
					if ($counter == $this->getPage())
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter$exp\" class='page-link'  data-page=\"$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1$exp\" class='page-link' data-page=\"$lpm1\">$lpm1</a>";
				$pagination.= '<a href="'.$targetpage.'?page='.$this->getLastPage().$exp.'"  class="page-link" data-page="'.$this->getLastPage().'">'.$this->getLastPage().'</a>';		
			}
			elseif($this->getLastPage() - ($this->getAdjacents() * 2) > $this->getPage() && $this->getPage() > ($this->getAdjacents() * 2))
			{
				$pagination.= "<a href=\"$targetpage?page=1$exp\"  class='page-link' data-page=\"1\" >1</a>";
				$pagination.= "<a href=\"$targetpage?page=2$exp\"  class='page-link' data-page=\"2\" >2</a>";
				$pagination.= "...";
				for ($counter = $this->getPage() - $this->getAdjacents(); $counter <= $this->getPage() + $this->getAdjacents(); $counter++)
				{
					if ($counter == $this->getPage())
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter$exp\" class='page-link' data-page=\"$counter\" >$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1$exp\" class='page-link' data-page=\"$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?page=$this->getLastPage()$exp\" class='page-link'  data-page=\"$this->getLastPage()\"  >$this->getLastPage()</a>";		
			}
			else
			{
				$pagination.= "<a href=\"$targetpage?page=1$exp\" class='page-link' data-page=\"1\">1</a>";
				$pagination.= "<a href=\"$targetpage?page=2$exp\" class='page-link' data-page=\"2\">2</a>";
				$pagination.= "...";
				for ($counter = $this->getLastPage() - (2 + ($this->getAdjacents() * 2)); $counter <= $this->getLastPage(); $counter++)
				{
					if ($counter == $this->getPage())
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter$exp\" class='page-link' data-page=\"$counter\" >$counter</a>";					
				}
			}
		}
		
		if ($this->getPage() < $counter - 1) 
			$pagination.= '<a href="'.$targetpage.'?page='.$this->getNextPage().$exp.'" class="page-link" data-page="'.$this->getNextPage().'"> >></a>';
		else
			$pagination.= "<span class=\"disabled\"> >></span>";
		$pagination.= "</div>\n";		
	}
	
	return $pagination;
  }
  
  
 }
