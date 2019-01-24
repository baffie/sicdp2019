<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class News_model extends CI_Model
{

    public $table = 'news';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    function get_news_list($channel=null, $offset=0, $records=0,$exceptions=null)
    {
        $this->load->database();

        if(!is_null($channel)){$category = $this->db->where_in('news_channel.slug',$channel);}

        if($exceptions>0) {$exceptions = $this->db->where_not_in('news.id',$exceptions);}

        $this->db->select('news.id, created, title, news.slug, news_channel.slug as channel, news.images_content, news.images_caption, summary');
        $this->db->from($this->table);
        $this->db->join('news_channel', 'news_channel.id = news.channel_id', 'left');
        $this->db->where('news.status', '1');
        $category;
        $exceptions;
        $this->db->order_by('created', 'DESC');
        $this->db->limit($records,$offset);
        $query = $this->db->get();
        $array = $query->result_array();
        $query->free_result();
        return $array;
    }

    public function get_by_slug($slug)
    {
        $this->load->database();
        $this->db->select('news.id,
        created,
        subtitle,
        title,
        summary,
        content,
        images_content,
        images_caption,
        keyword,
        source,
        news_channel.id,
        news_channel.slug as channel
			');
        $this->db->from($this->table);
        $this->db->join('news_channel', 'news_channel.id = news.channel_id', 'left');
        $this->db->where('news.slug', $slug);
        $query = $this->db->get();
        $array = $query->row_array();
        $query->free_result();
        return $array;
    }

    public function get_news_by_channel($slug, $limit, $offset = 0)
    {
        $this->load->database();
        $this->db->select('news.id, created, title, news.slug, news.images_content, summary, name');
        $this->db->from('news');
        $this->db->join('news_channel', 'news_channel.id = news.channel_id', 'left');
        $this->db->where('news.status', '1');
        $this->db->where('news_channel.slug', $slug);
        $this->db->order_by('news.created', $this->order);

        if ($limit) {
            $this->db->limit($limit, $offset);
        }

        return $this->db->get();
    }

    public function get_news_index($limit, $offset = 0)
    {
        $this->load->database();
        $this->db->select('news.id, created, title, news.slug, news.images_content, summary, name');
        $this->db->from('news');
        $this->db->join('news_channel', 'news_channel.id = news.channel_id', 'left');
        $this->db->where('news.status', '1');
        $this->db->order_by('news.created', $this->order);

        if ($limit) {
            $this->db->limit($limit, $offset);
        }

        return $this->db->get();
    }


    public function insert_hits($data)
    {
        $this->load->database();
        $sql = "INSERT INTO  news_hits (news_id, category, hits, last_viewed)
				VALUES ('".$data['news_id']."', '".$data['category']."', '".$data['hits']."', '".$data['last_viewed']."')
				 ON DUPLICATE KEY UPDATE hits=hits+1, last_viewed='".$data['last_viewed']."'
		";
        $this->db->query($sql);
    }

    function get_list_popular($limit=10)
    {
        $this->load->database();
        $this->db->select('news.id, created_time, title, news.slug, news.images_content, summary, hits');
        $this->db->from('news_hits');
        $this->db->join($this->table, 'news.id = news_hits.news_id', 'left');
        $this->db->where('news.status', '1');
        $this->db->group_by('news.id');
        $this->db->order_by('news_hits.hits', $this->order);
        $this->db->limit($limit);
        $query = $this->db->get();
        $array = $query->result_array();
        $query->free_result();
        return $array;
    }

    function get_search_total_rows($keyword = NULL)
    {
        $this->load->database();
        $this->db->like('title', $keyword, 'both');
        $this->db->or_like('summary', $keyword, 'both');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_by_search($keyword, $offset, $limit)
    {
        $this->load->database();
        $this->db->escape($keyword);
        $this->db->select('news.id, created_time, title, news.slug, news.images_content, summary, name');
        $this->db->from('news_categories');
        $this->db->join($this->table, 'news.id = news_categories.news_id', 'left');
        $this->db->join('news_channel', 'news_channel.id = news_categories.channel_id', 'left');
        $this->db->where('news.status', '1');
        $this->db->like('title', $keyword, 'both');
        $this->db->or_like('summary', $keyword, 'both');
        $this->db->order_by('news.created_time', $this->order);
        $this->db->limit($limit,$offset);
        $query = $this->db->get();
        $result = $query->result_array();
        $query->free_result();
        return $result;
    }



}