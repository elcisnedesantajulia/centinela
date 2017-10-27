<?php namespace Centinela;

use Phalcon\Paginator\Adapter\Model;

/**
 * Extends class Phalcon\Paginator\Adapter\Model to display adjacent page 
 * numbers to the current page.
 * <code>
 *  $paginator = new PaginatorModel([
 *      'data'      => Robots::find(),
 *      'limit'     => 25,
 *      'page'      => $currentPage,
 *      'adjacents' => 3,
 *  ]);
 *  $paginate = $paginator->getPaginate();
 * </code>
 * ------------------------------------------
 * @author Roman Cisneros romancc9@gmail.com
 * Impossible only means that you haven't found the solution yet.
 */
class PaginatorModel extends Model
{
    private $adjacents;

    // @override
    public function __construct($config){
        parent::__construct($config);
        $adjacents=1;
        if(isset($config['adjacents']) && ( ((int) $config['adjacents']) > 1)){
            $adjacents = (int) $config['adjacents'];
        }
        $this->adjacents = $adjacents;
    }

    // @override
    public function getPaginate(){
        $page = parent::getPaginate();
        $ext['items']       =$page->items;
        $ext['current']     =$page->current;
        $ext['total_pages'] =$page->total_pages;
        $ext['total_items'] =$page->total_items;
        $ext['limit']       =$page->limit;
        if( $page->current > 1 ){
            $ext['first']=1;
        }
        if( $page->current > ($this->adjacents * 22) ){
            $ext['long_back']=$page->current-$this->adjacents*20;
        }
        if( $page->current > ($this->adjacents +2) ){
            $ext['short_back']=max(2,$page->current-$this->adjacents*2-1);
        }
        $ext['before']=array();
        for($i=0;$i<$this->adjacents;$i++){
            $offset=$i+$page->current-$this->adjacents;
            if($offset>1){
                $ext['before'][]=$offset;
            }
        }
        $ext['next']=array();
        for($i=0;$i<$this->adjacents;$i++){
            $offset=$i+$page->current+1;
            if($offset<$page->total_pages){
                $ext['next'][]=$offset;
            }
        }
        if( ($page->current+$this->adjacents+1) < $page->total_pages ){
            $ext['short_front']=min(
                $page->total_pages-1,
                $page->current+$this->adjacents*2+1
            );
        }
        if( ($page->current+$this->adjacents*22) < $page->total_pages ){
            $ext['long_front']=$page->current+$this->adjacents*20;
        }
        if( $page->current < $page->total_pages ){
            $ext['last']=$page->last;
        }

        return (object) $ext;
    }
}

